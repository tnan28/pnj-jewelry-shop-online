<?php
class LoginManager extends ControllerBase
{
    private $AuthModel;
    public function __construct()
    {
        $this->AuthModel  = $this->Model("Authentication");
    }
    public function index()
    {
        $check = $this->AuthModel->GenerateTokenAdmin($_COOKIE['AuthenticationAdmin'] ?? "");
        if (!$check) {
            $this->View('Login', "Admin");
        } else {
            header("Location: /PNJSHOP/Admin/index/");
            exit();
        }
    }
}
