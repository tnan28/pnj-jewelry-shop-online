<?php

class Payment extends ControllerBase
{
    public function index($id)
    {
        $model  = $this->Model("OrderModel");
        $result = $model->CheckOrder($id);
        $orderModel = $this->Model("OrderModel");
        $infoUser = $orderModel->DetailOrder_GetInfoUser($id);
        $orderDetail = $orderModel->DetailOrder_GetDetailProduct($id);
        $this->View("index", "Home", [
            "Page" => "Payment",
            "Payment" => $result,
            "OrderDetail" => $orderDetail,
            "Customer" => $infoUser,
            "ID" => $id,
        ]);
    }
    private function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    public function PaymentOnlineATM($OrderID)
    {
        $modelPayment = $this->Model("PaymentOrder");
        $result = $modelPayment->CreatePaymentOrder($OrderID, 2);
        if ($result > 0) {
            header('Content-type: text/html; charset=utf-8');
            $modelOrder = $this->Model("OrderModel");
            $result = $modelOrder->GetOrderByID($OrderID);
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
            $orderInfo = "Thanh toán qua MoMo";
            $amount = (int)$result['TOTAL'];
            $orderId = $OrderID;
            $redirectUrl = "http://localhost:8080/PNJSHOP/StatusPayment/index";
            $ipnUrl = "http://localhost:8080/PNJSHOP/StatusPayment/index";
            $extraData = "";
            $requestId = time() . "";
            $requestType = "payWithATM";
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
            $data = array(
                'partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            );
            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);
            header("Location: " . $jsonResult['payUrl']);
        }
    }
}
