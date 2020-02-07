<?php namespace Admin\Controllers;

use AdminMenu;

class Pages extends \Admin\Classes\AdminController
{
    public $implement = [
        'Admin\Actions\ListController',
        'Admin\Actions\FormController',
    ];

    public $listConfig = [
        'list' => [
            'model' => 'Admin\Models\Pages_model',
            'title' => 'Pages',
            'emptyMessage' => 'lang:admin::lang.text_empty',
            'defaultSort' => ['page_id', 'DESC'],
            'configFile' => 'pages_model',
        ],
    ];

    public $formConfig = [
        'name' => 'pages',
        'model' => 'Admin\Models\Pages_model',
        'create' => [
            'title' => 'lang:admin::lang.form.create_title',
            'redirect' => 'pages/edit/{page_id}',
            'redirectClose' => 'pages',
        ],
        'edit' => [
            'title' => 'lang:admin::lang.form.edit_title',
            'redirect' => 'pages/edit/{page_id}',
            'redirectClose' => 'pages',
        ],
        'delete' => [
            'redirect' => 'pages',
        ],
        'configFile' => 'pages_model',
    ];

    protected $requiredPermissions = 'Site.Pages';

    public function __construct()
    {
        parent::__construct();

        AdminMenu::setContext('pages', 'marketing');
    }

    public function formValidate($model, $form)
    {
        $rules[] = ['language_id', 'lang:admin::lang.label_language', 'required|integer'];
        $rules[] = ['title', 'lang:admin::lang.label_title', 'required|min:2|max:255'];
        $rules[] = ['permalink_slug', 'lang:admin::lang.label_permalink_slug', 'alpha_dash|max:255'];
        $rules[] = ['content', 'lang:admin::lang.label_content', 'required|min:2'];
        $rules[] = ['navigation.*', 'lang:admin::lang.label_navigation', 'required'];
        $rules[] = ['status', 'lang:admin::lang.label_status', 'required|integer'];

        return $this->validatePasses($form->getSaveData(), $rules);
    }

    
}