<?php namespace Admin\Controllers\Rest;

use Admin\Classes\AdminController;
use Admin\Models\Mealtimes_model;
use AdminMenu;
use Response;
use Request;
class MealtimesApi extends AdminController
{

    function getList(){
        // $params = [];

     
        

        $enak = Mealtimes_model::get();
        return Response::make($enak, 200);
    }
    
}