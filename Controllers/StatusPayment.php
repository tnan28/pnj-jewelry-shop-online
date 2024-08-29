<?php

class StatusPayment extends ControllerBase
{
    public function index()
    {
        $orderId = $_GET['orderId'] ?? null;
        $message = $_GET['message'] ?? null;
        $modelPaymentOrder = $this->Model("PaymentOrder");
        $modelOrder = $this->Model("OrderModel");
        if ($message == "Successful.") {
            $responseTime = "done";
            $modelPaymentOrder->SetPaymentStatus($orderId, $responseTime);
            $modelOrder->AcceptStatusOrder($orderId, 1);
        } else {
            $modelPaymentOrder->SetPaymentStatus($orderId, null);
        }
        $this->View("statusPayment", "Home", [
            "Message" => $message
        ]);
    }
    public function ReceiveStore()
    {
        $this->View("thank", "Home");
    }
}
