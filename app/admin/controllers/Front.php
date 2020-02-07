<?php namespace Admin\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;


class Front extends \Admin\Classes\AdminController{

    public function view(){

        return Response::make(200);
        
    }

}

