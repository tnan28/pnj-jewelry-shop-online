<?php
require_once "vendor\autoload.php";

use Infobip\Api\SmsApi;
use Infobip\Configuration;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;

session_start();
class VerifyPhoneNumber extends ControllerBase
{

    private function SendOTP($PhoneNumber)
    {
        $generateNumber = $PhoneNumber;
        if (substr($PhoneNumber, 0, 1) === '0') {
            $PhoneNumber = '+84' . substr($PhoneNumber, 1);
        }
        $num_str = sprintf("%06d", mt_rand(1, 999999));
        $message = "Mã OTP của bạn là:  $num_str";
        $apiBaseURL = "l3ylyj.api.infobip.com";
        $apiKey = "6ae99bb8ca3815650d08b3eedc0e7b7d-7232250b-11c6-4853-885e-1965a5e9763b";
        $configuration = new Configuration(host: $apiBaseURL, apiKey: $apiKey);

        $api = new SmsApi(config: $configuration);
        $destination = new SmsDestination(to: $PhoneNumber);
        $theMessage = new SmsTextualMessage(
            destinations: [$destination],
            text: $message,
            from: "ServiceSMS",
        );

        $_SESSION['OTP'] = $num_str;
        $_SESSION['phoneNumber'] = $generateNumber;
        $request = new SmsAdvancedTextualRequest(messages: [$theMessage]);
        $response = $api->sendSmsMessage($request);
    }
    public function index()
    {
        $PhoneNumber = $_POST["phoneNumber"];
        $this->SendOTP($PhoneNumber);
        $this->View(
            "Verify",
            "Customer"
        );
    }
    public function VerificationOTPApi()
    {
        $postData = file_get_contents("php://input");
        $jsonData = json_decode($postData, true);
        header('Content-Type: application/json');
        if ($jsonData['OTP'] === $_SESSION['OTP']) {
            unset($_SESSION['OTP']);
            $model = $this->Model("Authentication");
            $result =  $model->CheckUser($_SESSION['phoneNumber']);
            if (!$result) {
                echo json_encode(['data' => "Thành công", 'status' => 201, 'message' => "Chưa có tài khoản"]);
            } else {
                $token =  $model->LoginUser($result['PHONENUMBER']);
                setcookie('AuthenticationUser', $token, time() + (86400 * 30), '/');
                echo json_encode(['data' => "Thành công", 'status' => 200]);
            }
        } else {
            echo json_encode(['data' => "Không đúng", 'status' => 403]);
        }
    }
}
