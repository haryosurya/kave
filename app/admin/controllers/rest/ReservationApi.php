<?php namespace Admin\Controllers\Rest;

use Admin\Controllers\Rest\BaseApi;
use Admin\Classes\AdminController;
use Admin\Models\Orders_model;
use Admin\Models\Reservations_model;
use Admin\Models\Tables_model;
use Admin\Models\Customers_model;
use Admin\Models\Customer_groups_model;
use AdminMenu;
use Response;
use Auth;
use Request;
use \Firebase\JWT\JWT;

class ReservationApi extends BaseApi

{
   public function getlist(){
            $token = apache_request_headers()['Authorization'];
            $decodetoken = JWT::decode($token, $this->key, array('HS256'));
            $customerid = $decodetoken[0]->customer_id;
            
            $address  = Reservations_model::where(['customer_id'=>$customerid])->get();
            return Response::make($address, 200);
        }


    public function booking(){

        $token = apache_request_headers()['Authorization'];
        $decodetoken = JWT::decode($token, $this->key, array('HS256'));
        $customer = $decodetoken[0];
        $data = Request::post();
        

        $model = new Reservations_model();

        $model->location_id = $data['location_id'];

        $model->customer_id = $customer->customer_id;
        $model->first_name = $customer->first_name;
        $model->last_name = $customer->last_name;
        $model->email = $customer->email;
        $model->telephone = $customer->telephone;
        


        $model->status_id = (setting('default_reservation_status'));

        $model->table_id = $data['table_id'];
        $model->guest_num = $data['guest_num'];
        $model->comment = $data['comment'];
        $model->reserve_date = $data['reserve_date'];
        $model->reserve_time = $data['reserve_time'];
        $model->duration = $data['duration'];

        $model->save();

        $result = [
            'status' => 'OK',
            'pesan' => 'Berhasil Simpan Reservasi'
        ];
        return Response::make($result, 200);


    }
}

// $reservation->guest_num = array_get($data, 'guest');
//         $reservation->first_name = array_get($data, 'first_name', $reservation->first_name);
//         $reservation->last_name = array_get($data, 'last_name', $reservation->last_name);
//         $reservation->email = array_get($data, 'email', $reservation->email);
//         $reservation->telephone = array_get($data, 'telephone', $reservation->telephone);
//         $reservation->comment = array_get($data, 'comment');

//         $dateTime = Carbon::createFromFormat('Y-m-d H:i', array_get($data, 'sdateTime'));
//         $reservation->reserve_date = $dateTime->format('Y-m-d');
//         $reservation->reserve_time = $dateTime->format('H:i:s');
//         $reservation->duration = $this->location->getReservationStayTime();
//         $reservation->save();