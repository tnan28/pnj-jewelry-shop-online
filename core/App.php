<?php
class App
{
    protected $controller = "Home";
    protected $action = "index";
    protected $params = [];
    public function __construct()
    {
        $arr = $this->URLProcess();
        // Config Controller
        if (file_exists("./Controllers/" . $arr[0] . ".php")) {
            $this->controller = $arr[0];
            unset($arr[0]);
        };

        require_once './Controllers/' . $this->controller . ".php";
        $this->controller = new $this->controller;

        // Config Action
        if (isset($arr[1])) {
            if (method_exists($this->controller, $arr[1])) {
                $this->action = $arr[1];
            }
            unset($arr[1]);
        }
        // Config Params
        $this->params = $arr ? array_values($arr) : [];

        call_user_func_array([$this->controller, $this->action], $this->params);
    }

    public function URLProcess()
    {
        if (isset($_GET["url"])) {
            return explode("/", filter_var(trim($_GET["url"], "/"), FILTER_SANITIZE_URL));
        } else {
            header("Location: Home/Index/");
            exit();
        }
    }
}
