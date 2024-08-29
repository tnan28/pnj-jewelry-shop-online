<?php
class ControllerBase
{

    public function Model($model)
    {
        require_once "./Models/" . $model . ".php";
        return new $model;
    }

    public function View($view, $folder, $data = [])
    {
        require_once "./Views/" . $folder . "/" . $view . ".php";
    }
}
