<?php
/*
 * This is the page that PayPal posts an IPN message to when a transaction is completed
 * The session variable txn_id is pulled from the IPN message and later saved to the registration record
 * 
 * A CURL script processes PayPal's response and if the response is VERIFIED 
 */
session_start();

$ipn_post_data = $_POST;

file_put_contents('/ipn_data.txt', $ipn_post_data, FILE_APPEND);

// Choose url
if(array_key_exists('test_ipn', $ipn_post_data) && 1 === (int) $ipn_post_data['test_ipn'])
    $url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
else
    $url = 'https://www.paypal.com/cgi-bin/webscr';

$_SESSION['txn_id'] = $ipn_post_data['txn_id'];

// Set up request to PayPal
$request = curl_init();
curl_setopt_array($request, array
(
    CURLOPT_URL => $url,
    CURLOPT_POST => TRUE,
    CURLOPT_POSTFIELDS => http_build_query(array('cmd' => '_notify-validate') + $ipn_post_data),
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HEADER => FALSE,
    CURLOPT_SSL_VERIFYPEER => TRUE,
    CURLOPT_CAINFO => 'cacert.pem',
));

// Execute request and get response and status code
$response = curl_exec($request);
$status   = curl_getinfo($request, CURLINFO_HTTP_CODE);

// Close connection
curl_close($request);

file_put_contents('/ipn_data.txt', $ipn_post_data, FILE_APPEND);

if($status == 200 && $response == 'VERIFIED')
{
    // All good! Proceed...
    $ipn_post_data = fixCharSet($ipn_post_data);
    header('Location:5k-save.php');
}
else
{
    // Not good. Ignore, or log for investigation...
}

function fixCharSet($ipn_data) {
    if(array_key_exists('charset', $ipn_data) && ($charset = $ipn_data['charset']))
    {
        // Ignore if same as our default
        if($charset == 'utf-8')
            return;

        // Otherwise convert all the values
        foreach($ipn_data as $key => &$value)
        {
            $value = mb_convert_encoding($value, 'utf-8', $charset);
        }

        // And store the charset values for future reference
        $ipn_data['charset'] = 'utf-8';
        $ipn_data['charset_original'] = $charset;
    }
    
    return $ipn_data;
}
?>