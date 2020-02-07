<?php namespace Admin\Controllers\Rest;

use Admin\Classes\AdminController;
use Admin\Models\Menus_model;
use Admin\Models\Menus_points_model;
use AdminMenu;
use Response;
use Request;
class MenusApi extends AdminController
{

    function getList(){
        // $params = [];

        $cat = !empty(Request::get('category')) ? Request::get('category') : null;
        $name = !empty(Request::get('name')) ? Request::get('name') : null;
        
        $menus = Menus_model::where(null);
        if(isset($cat)){
            $menus->where(['menu_category_id' => $cat]);
        }
            
        if(isset($name))
            $menus->where(('menu_name'), 'like', ("%$name%"));
            
        
        $menu = $menus->get();
        return Response::make($menu, 200);
    }
    function abc(){
        $menus = Menus_points_model::get();
      
        $menu = [];
        foreach($menus as $m){
            $m->menu->pointprice = $m->point_price;
            $menu[] = $m->menu;

        }
        return Response::make($menu, 200);
    }
    function menupoint(){
        
        // $menus = Menus_points_model::get();
      
        // $menu = [];
        // // foreach($menus as $m){
        // //     // $menu[] = $m->menu();
        // // }
        // return Response::make(['a'], 200);
    }
}