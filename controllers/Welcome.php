<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

require_once("C:/xampp/htdocs/fire_work_project/application/libraries/lib/config_paytm.php");
require_once("C:/xampp/htdocs/fire_work_project/application/libraries/lib/encdec_paytm.php");

class Welcome extends CI_Controller {  	

	public function index()
	{
		$Order_id = 105;
		$this->startpayment($Order_id);
	}

	public function startpayment($Order_id)
	{

		$checkSum = "";
		$paramList = array();

		// Create an array having all required parameters for creating checksum.
		$paramList["MID"] = PAYTM_MERCHANT_MID;
		$paramList["ORDER_ID"] = $Order_id;
		$paramList["CUST_ID"] = "CUST_ID_0001";
		$paramList["INDUSTRY_TYPE_ID"] = 'RETIAL';
		$paramList["CHANNEL_ID"] = 'WEB';
		$paramList["TXN_AMOUNT"] = 100;
		$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;

		

		$paramList["CALLBACK_URL"] = "http://127.0.0.1/fire_work_project/PaytmResponce";
		$paramList["MSISDN"] = '77777777'; //Mobile number of customer
		$paramList["EMAIL"] = 'test@test.com'; //Email ID of customer
		$paramList["VERIFIED_BY"] = "EMAIL"; //
		$paramList["IS_USER_VERIFIED"] = "YES"; //

//print_r($paramList);
		//Here checksum string will return by getChecksumFromArray() function.
		$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);
		//print_r($checkSum);
		?>

		<form method="post" action="<?php echo PAYTM_TXN_URL ?>" name="f1">
		<table border="1">
			<tbody>
			<?php
			foreach($paramList as $name => $value) {
				echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
			}
			?>
			<input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
			</tbody>
		</table>
		<script type="text/javascript">
			document.f1.submit();
		</script>
	</form>
 	<?php
	}

	public function PaytmResponce()
	{
		$paytmChecksum = "";
        $paramList = array();
        $isValidChecksum = "FALSE";

        $paramList = $_POST;
        echo "<pre>";
        print_r($paramList);
	}
	
}
