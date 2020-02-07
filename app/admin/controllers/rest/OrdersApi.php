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

class OrdersApi extends BaseApi
{

        function getList(){
            $token = apache_request_headers()['Authorization'];
            $decodetoken = JWT::decode($token, $this->key, array('HS256'));
            $customer = $decodetoken[0];
            $data = Request::post();

            $menu = Orders_model::where(['customer_id'=>$customer->customer_id])->get();

            return Response::make($menu, 200);
        }
        function postData(){

            $ordermenu = [];
            $orderoption = [];
            $subtotal = 0.00;
            $total = 0.00;
            $totalitem = 0;

            $token = apache_request_headers()['Authorization'];
            $decodetoken = JWT::decode($token, $this->key, array('HS256'));
            $customer = $decodetoken[0];
            $data = Request::post();
            $usepoint = !empty(Request::get('usepoint')) ? true : false;

            if($usepoint){
                $userpoint = Point_users_model::where('customer_id', '=', $customer->customer_id)->first();
                $menupointtotal = 0;
                if(!empty($userpoint)){
                    foreach($data['orders'] as $d){
                        $menupoint = Menus_points_model::where('menu_id', '=', $d['id'])->first();
                        if(!empty($menupoint)){
                            $menupointtotal += $menupoint->point_price;
                        }
                    }
                    if($userpoint->point < $menupointtotal)
                        return Response::make(['Poin Anda Tidak Cukup'], 200);
                } else {
                    return Response::make(['Poin Anda Tidak Cukup'], 200);
                }
                    
            }
            
            // $data = Request::post();
            $orders  = new Orders_model();
            $orders->customer_id = $customer->customer_id;
            $orders->first_name = $customer->first_name;
            $orders->last_name = $customer->last_name;
            $orders->email = $customer->email;
            $orders->telephone = $customer->telephone;
            $orders->address_id = $data['address'];
            $orders->processed = 1;
            $orders->comment = "";
            $orders->status_id = 1;
            $orders->payment = $usepoint == true ? "poin" : "cod";
            $orders->order_type = "delivery";
            $orders->location_id = $data['location'];
            $orders->order_time = date_create('now')->format('H:i:s');

            // $orders->customer_id = "1";
            // $orders->first_name = "ahmad";

            $orders->order_date = date_create();
            $orders->save();

            $totalitem = 0;

            $total = 0.00;
            foreach($data['orders'] as $d){
                $om = new Order_menus_model();
                $om->order_id = $orders->order_id;
                $om->menu_id = $d['id'];
                $om->name = $d['name'];
                $om->quantity = $d['qty'];
                $om->price = $d['price'];
                $om->subtotal = $d['qty'] * $d['price'];

                $om->save();
                $totalitem += $d['qty'];
                $total += $d['subtotal'];
                $ordermenu[] = $om;
                foreach($d['options'] as $op){

                    foreach($op['values'] as $v){
                        $orop = new Order_options_model();
                        $orop->order_id = $orders->order_id;
                        $orop->menu_id = $d['id'];
                        $orop->order_option_name = $v['name'];
                        $orop->order_option_price = $v['price'];
                        $orop->order_menu_id = $om->order_menu_id;
                        $orop->order_menu_option_id = $op['id'];
                        $orop->menu_option_value_id = $v['id'];
                        $orop->save();
                        $orderoption[] = $orop;
                    }

                }

               
            }
           
            $orders->order_total = $total ;
            $orders->total_items =$totalitem;
            $orders->save();


          

            //save subtotal price
            $oto = new Order_totals_model();
            $oto->order_id = $orders->order_id;
            $oto->code = "subtotal";
            $oto->title = "Sub Total";
            $oto->value = $total;
            $oto->save();




            //cek tax
            $setting = Settings_model::where("item" , 'tax_percentage')->orwhere('item', 'tax_mode')->get();

            $tax = 0.00;
            $taxpercentage = 0;

            if($setting[0]['value'] == 1){
                $tax = $total * $setting[1]['value'] / 100;
                $taxpercentage  = $setting[1]['value'];
            }
            
            if($tax > 0.00){
                $oto = new Order_totals_model();
                $oto->order_id = $orders->order_id;
                $oto->code = "tax";
                $oto->title = "VAT[{$taxpercentage}%]";
                $oto->value = $tax;
                $oto->priority = 127;
                $oto->save();
            }

            // cek diskon

            $disc = 0;
            $totaldiskon = 0.00;

            if(!empty($data['coupon'])){
                $diskon = Coupons_model::where("code" , $data['coupon'])->first();
                $user = Customers_model::where('customer_id', $customer->customer_id)->first();
                // $locationId = Location::getId();
                // $orderType = Location::orderType();
                
                $valid = true;

                
                if ($diskon->isExpired())
                    $valid = false;
                
                // if ($diskon->hasRestriction($orderType))
                //     $valid = false;

                // if ($diskon->hasLocationRestriction($locationId))
                //     $valid = false;

                if ($diskon->hasReachedMaxRedemption())
                    $valid = false;

                if ($user AND $diskon->customerHasMaxRedemption($user))
                    $valid = false;

                if($valid)
                    $disc = $diskon->getFormattedDiscountAttribute("");


                if($diskon->type == "F")
                    $totaldiskon = $disc;
                else 
                    $totaldiskon = $total * str_replace('%', '', $disc) / 100.00;
            }
            //save total 
            $oto = new Order_totals_model();
            $oto->order_id = $orders->order_id;
            $oto->code = "total";
            $oto->title = "Order Total";
            $oto->value = $total + $tax - $totaldiskon;
            $oto->priority = 127;
            $oto->save();

            

            $array = [
                'orders' => $orders,
                'ordermenu' => $ordermenu,
                'orderoption' => $orderoption,
                'tax' => $tax,
                'coupon' => $disc
                
            ];

            return Response::make($array, 200);

        }
    
}
