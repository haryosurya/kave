<?php namespace Admin\Controllers;

use AdminMenu;
use Igniter\Cart\Models\Cart;
use Igniter\Cart\Models\Orders_model;
use Response;
class Coupons extends \Admin\Classes\AdminController
{
    public $implement = [
        'Admin\Actions\ListController',
        'Admin\Actions\FormController',
    ];

    public $listConfig = [
        'list' => [
            'model' => 'Admin\Models\Coupons_model',
            'title' => 'lang:admin::lang.coupons.text_title',
            'emptyMessage' => 'lang:admin::lang.coupons.text_empty',
            'defaultSort' => ['coupon_id', 'DESC'],
            'configFile' => 'coupons_model',
        ],
    ];

    public $formConfig = [
        'name' => 'lang:admin::lang.coupons.text_form_name',
        'model' => 'Admin\Models\Coupons_model',
        'request' => 'Admin\Requests\Coupon',
        'create' => [
            'title' => 'lang:admin::lang.form.create_title',
            'redirect' => 'coupons/edit/{coupon_id}',
            'redirectClose' => 'coupons',
        ],
        'edit' => [
            'title' => 'lang:admin::lang.form.edit_title',
            'redirect' => 'coupons/edit/{coupon_id}',
            'redirectClose' => 'coupons',
        ],
        'preview' => [
            'title' => 'lang:admin::lang.form.preview_title',
            'redirect' => 'coupons',
        ],
        'delete' => [
            'redirect' => 'coupons',
        ],
        'configFile' => 'coupons_model',
    ];

    protected $requiredPermissions = 'Admin.Coupons';

    public function __construct()
    {
        parent::__construct();

        AdminMenu::setContext('coupons', 'marketing');
    }

    public function listOverrideColumnValue($record, $column, $alias = null)
    {
        if ($column->columnName == 'validity') {
            return ucwords($record->validity);
        }
    }

    public function loadApi(){
        $coupons = Orders_model::get();
        return Response::make($coupons, 200);
    }
}