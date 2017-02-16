<?php
require_once('includes/dbConn.php');

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
		$sql_date = $date['year'].'-'.str_pad($date['mon'],2,'0',STR_PAD_LEFT).'-'.str_pad($date['mday'],2,'0',STR_PAD_LEFT);
		return $sql_date;
	}
	
	public function SetRegistrationRate() {
		$result = $this->GetRegistrationRateRecords();
		
		if(mysql_num_rows($result)>0) {
			while($row = mysql_fetch_assoc($result)) {
			// By this point, if Coupon is not empty, assume it is valid
				if(strtoupper($this->Coupon)==strtoupper($row['coupon'])) {
					$this->RegistrationRate = number_format($row['price'],2,'.','');
				}
			};
		}
		else
			// If no rows found, registration date is not within allowable range.
			// Set to -1 as a flag
			$this->RegistrationRate = -1;
			
		mysql_free_result($result);
	}
	
	public function ValidateCoupon() {
		$valid = false;
		$result = $this->GetRegistrationRateRecords();
		
		if(mysql_num_rows($result)>0) {
			while($row = mysql_fetch_assoc($result)) {
				if(strtoupper($this->Coupon)==strtoupper($row['coupon'])) {
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
		return (mysql_num_rows($result)>0);
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
}

?>