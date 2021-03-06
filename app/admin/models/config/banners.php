<?php
$config['list']['filter'] = [
    'search' => [
        'prompt' => 'lang:admin::lang.banners.text_filter_search',
        'mode' => 'all' // or any, exact
    ],
    'scopes' => [
        'status' => [
            'label' => 'lang:admin::lang.banners.text_filter_status',
            'type' => 'switch',
            'conditions' => 'status = :filtered',
        ],
    ],
];

$config['list']['toolbar'] = [
    'buttons' => [
        'create' => [
            'label' => 'lang:admin::lang.button_new',
            'class' => 'btn btn-primary',
            'href' => 'banners/create',
        ],
        'delete' => [
            'label' => 'lang:admin::lang.button_delete',
            'class' => 'btn btn-danger',
            'data-request' => 'onDelete',
            'data-request-form' => '#list-form',
            'data-request-confirm' => 'lang:admin::lang.alert_warning_confirm',
        ],
        'filter' => [
            'label' => 'lang:admin::lang.button_icon_filter',
            'class' => 'btn btn-default btn-filter',
            'data-toggle' => 'list-filter',
            'data-target' => '.list-filter',
        ],
    ],
];

$config['list']['columns'] = [
    'edit' => [
        'type' => 'button',
        'iconCssClass' => 'fa fa-pencil',
        'attributes' => [
            'class' => 'btn btn-edit',
            'href' => 'banners/edit/{banner_id}',
        ],
    ],
    'name' => [
        'label' => 'lang:admin::lang.label_name',
        'type' => 'text',
        'searchable' => TRUE,
    ],
    'type_label' => [
        'label' => 'lang:admin::lang.label_type',
        'type' => 'text',
    ],
    'status' => [
        'label' => 'lang:admin::lang.banners.column_status',
        'type' => 'switch',
        'searchable' => TRUE,
    ],
    'banner_id' => [
        'label' => 'lang:admin::lang.column_id',
        'invisible' => TRUE,
    ],

];

$config['form']['toolbar'] = [
    'buttons' => [
        'save' => [
            'label' => 'lang:admin::lang.button_save',
            'context' => ['create', 'edit'],
            'class' => 'btn btn-primary',
            'data-request' => 'onSave',
            'data-request-submit' => 'true',
        ],
        'saveClose' => [
            'label' => 'lang:admin::lang.button_save_close',
            'context' => ['create', 'edit'],
            'class' => 'btn btn-default',
            'data-request' => 'onSave',
            'data-request-submit' => 'true',
            'data-request-data' => 'close:1',
        ],
        'delete' => [
            'label' => 'lang:admin::lang.button_icon_delete',
            'context' => ['edit'],
            'class' => 'btn btn-danger',
            'data-request' => 'onDelete',
            'data-request-submit' => 'true',
            'data-request-confirm' => 'lang:admin::lang.alert_warning_confirm',
        ],
    ],
];

$config['form']['fields'] = [
    'name' => [
        'label' => 'lang:admin::lang.label_name',
        'type' => 'text',
    ],
    'type' => [
        'label' => 'lang:admin::lang.banners.label_type',
        'type' => 'radio',
        'default' => 'image',
        'options' => [
            'image' => 'lang:admin::lang.banners.text_image',
            'custom' => 'lang:admin::lang.banners.text_custom',
        ],
    ],
    'image_code' => [
        'label' => 'lang:admin::lang.banners.label_image',
        'type' => 'mediafinder',
        'mode' => 'grid',
        'commentAbove' => 'lang:admin::lang.banners.help_image',
        'isMulti' => TRUE,
        'trigger' => [
            'action' => 'hide',
            'field' => 'type',
            'condition' => 'value[custom]',
        ],
    ],
    'custom_code' => [
        'label' => 'lang:admin::lang.banners.label_custom_code',
        'type' => 'textarea',
        'trigger' => [
            'action' => 'show',
            'field' => 'type',
            'condition' => 'value[custom]',
        ],
    ],
    'alt_text' => [
        'label' => 'lang:admin::lang.banners.label_alt_text',
        'type' => 'text',
    ],
    'click_url' => [
        'label' => 'lang:admin::lang.banners.label_click_url',
        'type' => 'text',
        'comment' => 'lang:admin::lang.banners.help_click_url',
    ],
    'language_id' => [
        'label' => 'lang:admin::lang.banners.label_language',
        'type' => 'relation',
        'relationFrom' => 'language',
        'placeholder' => 'lang:admin::lang.text_please_select',
    ],
    'status' => [
        'label' => 'lang:admin::lang.label_status',
        'type' => 'switch',
        'default' => TRUE,
    ],
];

return $config;