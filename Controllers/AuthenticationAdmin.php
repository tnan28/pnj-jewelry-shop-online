<?php
class AuthenticationAdmin extends ControllerBase
{
    public function AdminLogin()
    {
        $postData = file_get_contents("php://input");
        $jsonData = json_decode($postData, true);
        $model = $this->Model("Authentication");
        $result = $model->LoginAdmin($jsonData['username'], $jsonData['password']);
        if ($result) {
            setcookie('AuthenticationAdmin', $result, time() + (86400 * 30), '/');
            header('Content-Type: application/json; charset=utf8');
            echo json_encode(['data' => "thành công", 'status' => 200]);
        }
    }
    public function AdminLogout()
    {
        setcookie('AuthenticationAdmin', '', time() - (86400 * 30), '/');
        header('Content-Type: application/json; charset=utf8');
        echo json_encode(['data' => "thành công", 'status' => 200]);
    }
}
