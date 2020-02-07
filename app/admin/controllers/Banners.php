<?php namespace Admin\Controllers;

use AdminMenu;

class Banners extends \Admin\Classes\AdminController
{
    public $implement = [
        'Admin\Actions\ListController',
        'Admin\Actions\FormController',
    ];

    public $listConfig = [
        'list' => [
            'model' => 'Admin\Models\Banners',
            'title' => 'lang:admin::lang.banners.text_title',
            'emptyMessage' => 'lang:admin::lang.banners.text_empty',
            'defaultSort' => ['banner_id', 'DESC'],
            'configFile' => 'banners',
        ],
    ];

    public $formConfig = [
        'name' => 'lang:admin::lang.banners.text_form_name',
        'model' => 'Admin\Models\Banners',
        'create' => [
            'title' => 'lang:admin::lang.form.create_title',
            'redirect' => 'banners/edit/{banner_id}',
            'redirectClose' => 'banners',
        ],
        'edit' => [
            'title' => 'lang:admin::lang.form.edit_title',
            'redirect' => 'banners/edit/{banner_id}',
            'redirectClose' => 'banners',
        ],
        'preview' => [
            'title' => 'lang:admin::lang.form.preview_title',
            'redirect' => 'banners',
        ],
        'delete' => [
            'redirect' => 'banners',
        ],
        'configFile' => 'banners',
    ];

    protected $requiredPermissions = 'Admin.Banners';

    public function __construct()
    {
        parent::__construct();

        AdminMenu::setContext('banners', 'design');
    }

    public function formValidate($model, $form)
    {
        $namedRules = [
            ['name', 'lang:admin::lang.label_name', 'required|min:2|max:255'],
            ['type', 'lang:admin::lang.banners.label_type', 'required|alpha|max:8'],
            ['click_url', 'lang:admin::lang.banners.label_click_url', 'required|min:2|max:255'],
            ['custom_code', 'lang:admin::lang.banners.label_custom_code', 'required_if:type,custom'],
            ['alt_text', 'lang:admin::lang.banners.label_alt_text', 'required_if:type,image|min:2|max:255'],
            ['image_code', 'lang:admin::lang.banners.label_image', 'required_if:type,image'],
            ['language_id', 'lang:admin::lang.banners.label_language', 'required|integer'],
            ['status', 'lang:admin::lang.label_status', 'required|integer'],
        ];

        return $this->validatePasses(post($form->arrayName), $namedRules);
    }
}
