<?php namespace Admin\Controllers;

use AdminMenu;
class Points extends \Admin\Classes\AdminController
{
    public $implement = [
        
        'Admin\Actions\ListController',
        'Admin\Actions\FormController',
    ];

    public $listConfig = [
        'list' => [
            'model' => 'Admin\Models\Points_model',
            'title' => 'lang:admin::lang.Points.text_title',
            'emptyMessage' => 'lang:admin::lang.Points.text_empty',
            'defaultSort' => ['point_customer_id', 'DESC'],
            'configFile' => 'Points_model',
        ],
    ];

    public $formConfig = [
        'name' => 'lang:admin::lang.points.text_form_name',
        'model' => 'Admin\Models\points_model',
        // 'create' => [
        //     'title' => 'lang:admin::lang.form.create_title',
        //     'redirect' => 'points/edit/{point_id}',
        //     'redirectClose' => 'points',
        // ],
        'edit' => [
            'title' => 'lang:admin::lang.form.edit_title',
            'redirect' => 'points/edit/{point_id}',
            'redirectClose' => 'points',
        ],
        'point' => [
            'title' => 'lang:admin::lang.form.point_title',
            'redirect' => 'points',
        ],
        'delete' => [
            'redirect' => 'points',
        ],
        'configFile' => 'points_model',
    ];


    protected $requiredPermissions = 'Admin.Points';

    public function __construct()
    {
        parent::__construct();

        AdminMenu::setContext('points', 'marketing');
    }

}