<?php namespace Admin\Controllers\Rest;

use Admin\Classes\AdminController;
use Admin\Models\Pages_model;
use Response;
class PagesApi extends AdminController
{

    function getList(){
        $menu = Pages_model::get();
        return Response::make($menu, 200);
    }
}
