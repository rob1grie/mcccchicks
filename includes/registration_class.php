<?php

require_once('includes/dbConn.php');
require_once 'includes/email_tools.php';

// Defines a Registration object
class Registration {

    public $ID;
    public $Conference;
    public $RegistrationDate;
    public $RegistrationRate;
    public $Name;
    public $Address;
    public $City;
    public $State;
    public $Zip;
    public $PhoneAC;
    public $PhoneExchange;
    public $PhoneNumber;
    public $Email;
    public $Ages;
    public $Count;
    public $Price;
    public $GroupName;
    public $ChurchName;
    public $ChurchAddress;
    public $ChurchCity;
    public $ChurchState;
    public $ChurchZip;
    public $ChurchWeb;
    public $WomenLeader;
    public $PastorWife;
    public $SpecialNeeds;
    public $Coupon;
    public $PaypalFee;

    public function __construct() {
        $this->ID = -1;
        $this->Conference = "";
        $this->RegistrationDate = time();
        $this->RegistrationRate = 0;
        $this->Name = "";
        $this->Address = "";
        $this->City = "";
        $this->State = "";
        $this->Zip = "";
        $this->PhoneAC = "";
        $this->PhoneExchange = "";
        $this->PhoneNumber = "";
        $this->Email = "";
        $this->Ages = "";
        $this->Count = 1;
        $this->Price = 0;
        $this->GroupName = "";
        $this->ChurchName = "";
        $this->ChurchAddress = "";
        $this->ChurchCity = "";
        $this->ChurchState = "";
        $this->ChurchZip = "";
        $this->ChurchWeb = "";
        $this->WomenLeader = 0;
        $this->PastorWife = 0;
        $this->SpecialNeeds = "";
        $this->Coupon = "";
        $this->PaypalFee = 0;
    }

    public function SetConference($conference) {
        $this->Conference = $conference;
    }

    public function GetRegistrationDate() {
        $date = getdate($this->RegistrationDate);
        $sql_date = $date['year'] . '-' . str_pad($date['mon'], 2, '0', STR_PAD_LEFT) . '-' . str_pad($date['mday'], 2, '0', STR_PAD_LEFT);
        return $sql_date;
    }

    public function SetRegistrationRate() {
        $result = $this->GetRegistrationRateRecords();

        if (mysql_num_rows($result) > 0) {
            while ($row = mysql_fetch_assoc($result)) {
                // By this point, if Coupon is not empty, assume it is valid
                if (strtoupper($this->Coupon) == strtoupper($row['coupon'])) {
                    $this->RegistrationRate = number_format($row['price'], 2, '.', '');
                }
            };
        } else
        // If no rows found, registration date is not within allowable range.
        // Set to -1 as a flag
            $this->RegistrationRate = -1;

        mysql_free_result($result);
    }

    public function ValidateCoupon() {
        $valid = false;
        $result = $this->GetRegistrationRateRecords();

        if (mysql_num_rows($result) > 0) {
            while ($row = mysql_fetch_assoc($result)) {
                if (strtoupper($this->Coupon) == strtoupper($row['coupon'])) {
                    $valid = true;
                    $this->Coupon = strtoupper($this->Coupon);
                }
            };
        }

        mysql_free_result($result);
        return $valid;
    }

    public function ValidConference() {
        $result = $this->GetRegistrationRateRecords();
        return (mysql_num_rows($result) > 0);
    }

    private function GetEmailInfo() {
        $womenLeader = (($this->WomenLeader == 1) ? "Yes" : "No");
        $pastorWife = (($this->PastorWife == 1) ? "Yes" : "No");

        $body = "
		<table>
			<tr><td>Name:</td><td>$this->Name</td></tr>
			<tr><td>Address:</td><td>$this->Address</td></tr>
			<tr><td>&nbsp;</td><td>$this->City, $this->State $this->Zip</td></tr>
			<tr><td>Phone:</td><td>$this->PhoneAC - $this->PhoneExchange - $this->PhoneNumber</td></tr>
			<tr><td>Email:</td><td>$this->Email</td></tr>
			<tr><td>Women Leader:</td><td>$womenLeader</td></tr>
			<tr><td>Pastor's Wife:</td><td>$pastorWife</td></tr>
			<tr><td>Special Needs:</td><td>$this->SpecialNeeds</td></tr>
			<tr><td>Ages:</td><td>$this->Ages</td></tr>
			<tr><td>Registered Count:</td><td>$this->Count</td></tr>
			<tr><td>Coupon:</td><td>$this->Coupon</td></tr>
			<tr><td>Total Fee:</td><td>$this->Price</td></tr>
			<tr><td>Group Name:</td><td>$this->GroupName</td></tr>
			<tr><td>Church:</td><td>$this->ChurchName</td></tr>
			<tr><td>Church Address:</td><td>$this->ChurchAddress</td></tr>
			<tr><td>&nbsp;</td><td>$this->ChurchCity, $this->ChurchState $this->ChurchZip</td></tr>
			<tr><td>Church web:</td><td>$this->ChurchWeb</td></tr>
		</table>
	";
        return $body;
    }

    public function Save($paid = FALSE) {
        global $database_dbConn, $dbConn;
        $date = $this->GetRegistrationDate();
		$paid = $paid ? 1 : 0;

        $insertSQL = "INSERT INTO registrations (date, conference, name, address, city, state, zip,";
        $insertSQL .= "phone_ac, phone_exchange, phone_number, ages, count, rate, coupon, price, email,";
        $insertSQL .= "church_name, church_address, church_city, church_state, church_zip, church_web,";
        $insertSQL .= "women_leader, pastor_wife, special_needs, paid) VALUES (";
        $insertSQL .= "'$date', '$this->Conference',";
        $insertSQL .= "'$this->Name','$this->Address','$this->City','$this->State','$this->Zip',";
        $insertSQL .= "'$this->PhoneAC','$this->PhoneExchange','$this->PhoneNumber','$this->Ages',$this->Count,";
        $insertSQL .= "$this->RegistrationRate, '$this->Coupon', $this->Price, '$this->Email',";
        $insertSQL .= "'$this->ChurchName','$this->ChurchAddress','$this->ChurchCity','$this->ChurchState','$this->ChurchZip','$this->ChurchWeb',";
        $insertSQL .= "$this->WomenLeader,$this->PastorWife,'$this->SpecialNeeds', $paid)";

        mysql_select_db($database_dbConn, $dbConn);
        $result = @mysql_query($insertSQL, $dbConn) or die(mysql_error());
        
        $data['id'] = mysql_insert_id();
        $data['error'] = mysql_error();

        return $data;
    }

    private function GetRegistrationRateRecords() {
        global $database_dbConn, $dbConn;

        $date = $this->GetRegistrationDate();
        $query = "SELECT * FROM registration_rates WHERE UPPER(conference)='" . strtoupper($this->Conference) .
                "' AND start_date <= '$date' AND end_date >= '$date'";

        mysql_select_db($database_dbConn, $dbConn);
        $result = @mysql_query($query, $dbConn) or die(mysql_error());

        return $result;
    }

    function SendEmailSuccess() {
        $emailFrom = "registration@mcccchicks.org";

        $body = $this->GetEmailInfo();
        $message = "
		<html>
		<head>
			<title>Conference Registration from MCCCChicks.org</title>
		</head>
		<body>
			<p>Greetings! A registration for the 2017 Women's Conference has been submitted with the following information:</p>"
                . $body .
                "</body>
		</html>
	";

        // To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= "From: $emailFrom\r\nReply-To: $emailFrom";

        // Send email to registration admin
        $emailTo = "registration@mcccchicks.org";
		// TODO Development email address
		// $emailTo = "robgrie@gmail.com";
        $subject = "A Registration has been entered at mcccchicks.org";

        SendEmail($emailTo, $emailFrom, $subject, $message, $headers);

        // Send email to registrant
        $emailTo = $this->Email;
        $subject = "Confirming your Registration: $this->Conference";
        SendEmail($emailTo, $emailFrom, $subject, $message, $headers);
    }

    public function SendEmailFailure($error) {
        $emailFrom = "webmaster@mcccchicks.org";
        $body = $this->GetRegistrationEmailInfo();

        $message = '
		<html>
		<head>
			<title>Failed Conference Registration from MCCCChicks.org</title>
		</head>
		<body>
			<p>An attempt to register for the conference on MCCCChicks.org failed with the following error:</p>
			<p>$error</p>
			<p>Please forward this information to the MCCCChicks.org webmaster at webmaster@mcccchicks.org</p>
			<p>Registrant Information</p>'
                . $body .
                '</body>
		</html>
	';
        $emailTo = "registration@mcccchicks.org";
        $subject = "Failed Conference Registration from MCCCChicks.org";

        // To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= "From: $emailFrom\r\nReply-To: $emailFrom";

        //       SendEmail($emailTo, $emailFrom, $subject, $message, $headers);
    }

}

?>