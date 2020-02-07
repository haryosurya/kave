<?php namespace Admin\Controllers\Rest;

use Admin\Classes\AdminController;
use Admin\Controllers\Rest\BaseApi;
use Admin\Models\Reviews_model;
use Response;
use Request;
use \Firebase\JWT\JWT;
class ReviewsApi extends BaseApi
{

    function getList(){
        $menu = Reviews_model::get();
        return Response::make($menu, 200);
    }


    function postreviews(){
        $token = apache_request_headers()['Authorization'];
        $decodetoken = JWT::decode($token, $this->key, array('HS256'));
        $customer = $decodetoken[0];
        
        $data = Request::post();

        $model = new Reviews_model();
        $model->location_id = $data['location_id'];
        $model->customer_id = $customer->customer_id;
        $model->author = $customer->first_name." ".$customer->last_name;
        $model->sale_id = $data['sale_id']; 
        $model->sale_type = $data['sale_type'];
        $model->quality = array_get($data, 'rating.quality');
        $model->delivery = array_get($data, 'rating.delivery');
        $model->service = array_get($data, 'rating.service');
        $model->review_text = array_get($data, 'review_text');
        $model->review_status = (setting('approve_reviews') === 1) ? 1 : 0;

        $model->save();

        $result = [
            'status' => 'OK',
            'pesan' => 'Berhasil Simpan Review'
        ];
        return Response::make($result, 200);
    }
}