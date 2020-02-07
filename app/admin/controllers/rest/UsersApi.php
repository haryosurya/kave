<?php namespace Admin\Controllers\Rest;

use Admin\Controllers\Rest\BaseApi;
use Admin\Classes\AdminController;
use Admin\Models\Orders_model;
use Admin\Models\Addresses_model;
use Admin\Models\Customers_model;
use Admin\Models\Customer_groups_model;
use AdminMenu;
use Response;
use Auth;
use Request;
use \Firebase\JWT\JWT;

class UsersApi extends BaseApi
{

    function login(){
        $credentials = [
            'email' => Request::post('email'),
            'password' => Request::post('password'),
        ];

        if (Auth::authenticate($credentials, NULL, TRUE)){
            $token = "";
            $customer = Customers_model::where(['email' => Request::post('email')])->get();
            
            $payload = $customer;

            /**
             * IMPORTANT:
             * You must specify supported algorithms for your application. See
             * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
             * for a list of spec-compliant algorithms.
             */
            $token = JWT::encode($payload, $this->key);
            // $decodetoken = JWT::decode($token, $key, array('HS256'));
            $result = [
                'token' => $token
            ];
            return Response::make($result, 200);
        }
        return Response::make($credentials, 400);
    }

    function decode(){
        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.W3siY3VzdG9tZXJfaWQiOjEsImZpcnN0X25hbWUiOiJhaG1hZCIsImxhc3RfbmFtZSI6Im11cm5pIiwiZW1haWwiOiJ1c2VyQHVzZXIuY29tIiwic2FsdCI6bnVsbCwidGVsZXBob25lIjoiMjM0NzEzNzE1NyIsImFkZHJlc3NfaWQiOjEsInNlY3VyaXR5X3F1ZXN0aW9uX2lkIjpudWxsLCJzZWN1cml0eV9hbnN3ZXIiOm51bGwsIm5ld3NsZXR0ZXIiOm51bGwsImN1c3RvbWVyX2dyb3VwX2lkIjoxLCJpcF9hZGRyZXNzIjpudWxsLCJkYXRlX2FkZGVkIjoiWWVzdGVyZGF5Iiwic3RhdHVzIjp0cnVlLCJjYXJ0IjpudWxsLCJyZXNldF9jb2RlIjpudWxsLCJyZXNldF90aW1lIjpudWxsLCJhY3RpdmF0aW9uX2NvZGUiOm51bGwsInJlbWVtYmVyX3Rva2VuIjpudWxsLCJpc19hY3RpdmF0ZWQiOnRydWUsImRhdGVfYWN0aXZhdGVkIjoiMjAyMC0wMS0yMSAxNTowNDowOCIsImxhc3RfbG9naW4iOm51bGwsImZ1bGxfbmFtZSI6ImFobWFkIG11cm5pIn1d.Komh6CcFMJdIXy07RCZIX8Q43izTDPU8fMXWEwP0udQ";
        $decodetoken = JWT::decode($token, $this->key, array('HS256'));
        $result = $decodetoken;

        
        return Response::make($result, 200);
    }

    public function register(){
        $data = Request::post();

        $data['customer_group_id'] = $defaultCustomerGroupId = setting('customer_group_id');
            $customerGroup = Customer_groups_model::find($defaultCustomerGroupId);
            $requireActivation = ($customerGroup AND $customerGroup->requiresApproval());
            $autoActivation = !$requireActivation;

        $customer = Auth::register(
            array_except($data, ['password_confirm', 'terms']), $autoActivation
        );

        if($customer){
            $result = [
                'status' => 'OK',
                'pesan' => 'Register Berhasil'
            ];
            return Response::make($result, 200);
        }

        $result = [
            'status' => 'GAGAL',
            'pesan' => 'Register Gagal'
        ];

        return Response::make($result, 200);
    }

    public function setaddress(){
        $token = apache_request_headers()['Authorization'];
        $decodetoken = JWT::decode($token, $this->key, array('HS256'));
        $customerid = $decodetoken[0]->customer_id;
        $data = Request::post();

        $address  = new Addresses_model();
        $address->customer_id = $customerid;
        $address->address_1 = $data['address_1'];
        $address->address_2 = $data['address_2'];
        $address->city = $data['city'];
        $address->state = $data['state'];
        $address->postcode = $data['postcode'];
        $address->country_id = $data['country_id'];
        $address->save();

        $result = [
            'status' => 'OK',
            'pesan' => 'Berhasil Simpan Alamat'
        ];
        return Response::make($result, 200);
    }


        //return bio berdasarkan ID customer
    public function getaddress(){
        $token = apache_request_headers()['Authorization'];
        $decodetoken = JWT::decode($token, $this->key, array('HS256'));
        $customerid = $decodetoken[0]->customer_id;
        
        $address  = Addresses_model::where(['customer_id'=>$customerid])->get();
        return Response::make($address, 200);
    }

    public function getlistcus(){
        $token = apache_request_headers()['Authorization'];
        $decodetoken = JWT::decode($token, $this->key, array('HS256'));
        $customerid = $decodetoken[0]->customer_id;
        
        $address  = Customers_model::where(['customer_id'=>$customerid])->get();
        return Response::make($address, 200);
    }

    

    
}