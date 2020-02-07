<?php namespace Admin\Controllers\Rest;

use Admin\Classes\AdminController;
use Admin\Models\Banners;
use AdminMenu;
use Firebase\JWT\JWT;
use Response;
class BannersApi extends AdminController
{

    function getList(){
        // $token = apache_request_headers()['Authorization'];
        // $decodetoken = JWT::decode($token, $this->key, array('HS256'));
        // $customer = $decodetoken[0];
        // $data = Request::post();

        // if(isset($customer->customer_id)){
            $menu = Banners::get();
            return Response::make($menu, 200);
        // }

        // return Response::make(['Tidak bisa melihat data'], 403);
    }
}