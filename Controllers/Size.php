<?php
class Size extends ControllerBase
{
    public function GetSize()
    {
        $model = $this->Model("Product");
        $result = $model->GetSize_API();
        $jsonResult = json_encode(['data' => $result]);
        header('Content-Type: application/json');
        echo $jsonResult;
    }
}
