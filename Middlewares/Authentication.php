<?php

class Middleware
{
    public function AuthenticationAdmin($model)
    {
        $check = $model->GenerateTokenAdmin($_COOKIE['AuthenticationAdmin'] ?? "");
        if (!$check) {
            header("Location: /PNJSHOP/LoginManager/index/");
            exit();
        }
    }
}
