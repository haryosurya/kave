<?php namespace Admin\Controllers\Rest;

use Admin\Classes\AdminController;
use Admin\Models\Locations_model;
use Response;
class LocationsApi extends AdminController
{

    function getList(){
        $menu = Locations_model::get();
        return Response::make($menu, 200);
    }
}