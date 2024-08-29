<?php
class Category extends ControllerBase
{
    public function GetCategory()
    {
        $model = $this->Model("CategoryModel");
        $result = $model->LoadCategoryAPI();
        $jsonResult = json_encode(['data' => $result]);

        header('Content-Type: application/json');
        echo $jsonResult;
    }
    public function GetCategoryDetail($id)
    {
        $model = $this->Model("CategoryModel");
        $result = $model->LoadCategoryDetailAPI($id);
        $jsonResult = json_encode(['data' => $result]);
        header('Content-Type: application/json');
        echo $jsonResult;
    }
    public function GetCategoryDetail_Product($id)
    {
        $model = $this->Model("CategoryModel");
        $result = $model->LoadCategoryDetailProductAPI($id);
        $jsonResult = json_encode(['data' => $result]);
        header('Content-Type: application/json');
        echo $jsonResult;
    }
}
