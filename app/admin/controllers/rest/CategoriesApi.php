<?php namespace Admin\Controllers\Rest;

use Admin\Classes\AdminController;
use Admin\Models\Categories_model;
use AdminMenu;
use Response;
class CategoriesApi extends AdminController
{

    function getList(){
        $menu = Categories_model::get();
        return Response::make($menu, 200);
    }
}