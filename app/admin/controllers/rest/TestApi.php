<?php namespace Admin\Controllers\Rest;

// use Admin\Classes\AdminController;
use Admin\Controllers\Rest\BaseApi;
use Admin\Models\Coupons_model;
use Admin\Models\Customers_model;
use Admin\Models\Menus_points_model;
use Admin\Models\Order_menus_model;
use Admin\Models\Order_options_model;
use Admin\Models\Order_totals_model;
use Admin\Models\Orders_model;
use Admin\Models\Point_users_model;
use Admin\Models\Points_model;
use Admin\Models\Users_model;
// use AdminMenu;
use Response;
use Request;
use \Firebase\JWT\JWT;
use System\Models\Settings_model;

class TestApi extends BaseApi
{
    function test(){
        foreach(Order_menus_model::where('order_id','=', 92 )->get() as $orop){
            $userpoint = Point_users_model::where('customer_id', '=', 1)->first();
            if($userpoint){
                $menupoint = Menus_points_model::where('menu_id', '=', $orop->menu_id)->first();
                // if($menupoint){
                    return Response::make($orop, 200);
                    $userpoint->point -= $menupoint->point_price;
                    // $userpoint->save();
                // }
               
            } else {
                
            }
        }
    }
}