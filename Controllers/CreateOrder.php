<?php
require_once './Middlewares/Authentication.php';

class CreateOrder extends ControllerBase
{
    private $OrderModel;
    private $AuthModel;
    private $Middleware;
    public function __construct()
    {
        $this->AuthModel  = $this->Model("Authentication");
        $this->Middleware = new Middleware();
        $this->OrderModel = $this->Model("OrderModel");
    }
    public function index()
    {
        $this->Middleware->AuthenticationAdmin($this->AuthModel);
        $customerName = $_POST['customer_name'];
        $phoneNumber = $_POST['phone_number'];
        $email = $_POST['email'];
        $selectedProducts = [];
        foreach (unserialize($_POST['data']) as $index => $product) {
            if (isset($_POST['size_' . $index]) && !empty($_POST['size_' . $index])) {
                $selectedProducts[] = [
                    'product_size_id' => $_POST['size_' . $index],
                    'quantity' => $_POST['quantity_' . $index]
                ];
            }
        }
        $id = $this->Model("CustomerModel")->UpdateCustomer($customerName, $phoneNumber, $email);
        $idOrder = $this->Model("OrderModel")->AddOrder($id);
        $this->Model("OrderDetailModel")->AddOrderDetail($selectedProducts, $idOrder);
        $this->Model("PaymentOrder")->CreatePaymentOrder($idOrder, 2);
        $result = $this->OrderModel->GetAll();
        session_start();
        unset($_SESSION['products']);
        $this->View("index", "Admin", [
            "Page" => "OrderManager",
            "Orders" => $result,
        ]);
    }
    public function CreateOrderAPI()
    {

        $postData = file_get_contents("php://input");
        $jsonData = json_decode($postData, true);
        $jsonData = $jsonData['ORDER'];
        $order = [
            'CUSTOMERNAME' => $jsonData['CUSTOMERNAME'],
            'PHONENUMBER' => $jsonData['PHONENUMBER'],
            'EMAIL' => $jsonData['EMAIL'],
            'ADDRESS' => $jsonData['ADDRESS'],
            'SHIPPINGMETHOD' => $jsonData['SHIPPINGMETHOD']
        ];
        $modelAuth = $this->Model("Authentication");
        $checkUser = $modelAuth->CheckUser($jsonData['PHONENUMBER']);
        if (!$checkUser) {
            $modelUser = $this->Model("CustomerModel");
            $customerID =  $modelUser->AddCustomer(
                $order['CUSTOMERNAME'],
                $order['PHONENUMBER'],
                $order['EMAIL']
            );
        } else {
            $customerID = $checkUser['CUSTOMERID'];
        }
        session_start();
        $modelOrder = $this->Model("OrderModel");
        $OrderID = $modelOrder->AddOrder($customerID, $order['SHIPPINGMETHOD'], $order["ADDRESS"]);
        $products = [];
        foreach ($_SESSION['cart'] as $productKey => $productValue) {
            array_push($products, [
                'product_size_id' => $productKey,
                'quantity' => $productValue
            ]);
        }
        $modeDetail = $this->Model('OrderDetailModel');
        $modeDetail->AddOrderDetail($products, $OrderID);
        unset($_SESSION['cart']);
        header("application/json");
        echo  json_encode(["data" => "Tạo thành công", "status" => 200, "OrderID" =>  $OrderID]);
    }
}
