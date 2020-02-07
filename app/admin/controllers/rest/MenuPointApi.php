<?php namespace Admin\Controllers\Rest;

use Admin\Classes\AdminController;
use Admin\Models\Menus_points_model;
use Admin\Models\Points_model;
use AdminMenu;
use Firebase\JWT\JWT;
use Admin\Controllers\Rest\BaseApi;

use Response;
use Request;
class MenuPointApi extends BaseApi
{

    function getList(){
        // $params = [];

        // $token = apache_request_headers()['Authorization'];
        // $decodetoken = JWT::decode($token, $this->key, array('HS256'));
        // $customerid = $decodetoken[0]->customer_id;
        // $data = Request::post();
        
        // $menu  = Addresses_model::where(['customer_id'=>$customerid])->get();

        $menu = Menus_points_model::get();
        return Response::make($menu, 200);
    }
    function pointlist(){

        $token = apache_request_headers()['Authorization'];
        $decodetoken = JWT::decode($token, $this->key, array('HS256'));
        $customer = $decodetoken[0];
        $data = Request::post();

        
        $point = Points_model::where(['customer_id'=>$customer->customer_id])->get();
        return Response::make($point, 200);


    }
    
}