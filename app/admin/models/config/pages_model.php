<?php
$config['list']['filter'] = [
    'search' => [
        'prompt' => 'lang:admin::lang.pages.text_filter_search',
        'mode' => 'all',
    ],
    'scopes' => [
        'status' => [
            'label' => 'lang:admin::lang.text_filter_status',
            'type' => 'switch',
            'conditions' => 'status = :filtered',
        ],
    ],
];

$config['list']['toolbar'] = [
    'buttons' => [
        'create' => ['label' => 'lang:admin::lang.button_new', 'class' => 'btn btn-primary', 'href' => 'pages/create'],
        'delete' => ['label' => 'lang:admin::lang.button_delete', 'class' => 'btn btn-danger', 'data-request-form' => '#list-form', 'data-request' => 'onDelete', 'data-request-data' => "_method:'DELETE'", 'data-request-confirm' => 'lang:admin::lang.alert_warning_confirm'],
        'filter' => ['label' => 'lang:admin::lang.button_icon_filter', 'class' => 'btn btn-default btn-filter', 'data-toggle' => 'list-filter', 'data-target' => '.list-filter'],
    ],
];

$config['list']['columns'] = [
    'edit' => [
        'type' => 'button',
        'iconCssClass' => 'fa fa-pencil',
        'attributes' => [
            'class' => 'btn btn-edit',
            'href' => 'pages/edit/{page_id}',
        ],
    ],
    
    'name' => [
        'label' => 'lang:admin::lang.label_name',
        'type' => 'text',
        'searchable' => TRUE,
    ],
    'language_name' => [
        'label' => 'lang:admin::lang.pages.column_language',
        'relation' => 'language',
        'select' => 'name',
        'searchable' => TRUE,
    ],
    'date_updated' => [
        'label' => 'lang:admin::lang.pages.column_date_updated',
        'type' => 'datesince',
        'searchable' => TRUE,
    ],
    'status' => [
        'label' => 'lang:admin::lang.pages.label_status',
        'type' => 'switch',
    ],
    'page_id' => [
        'label' => 'lang:admin::lang.pages.column_id',
        'invisible' => TRUE,
    ],

];

$config['form']['toolbar'] = [
    'buttons' => [
        'save' => ['label' => 'lang:admin::lang.button_save', 'class' => 'btn btn-primary', 'data-request-submit' => 'true', 'data-request' => 'onSave'],
        'saveClose' => [
            'label' => 'lang:admin::lang.button_save_close',
            'class' => 'btn btn-default',
            'data-request' => 'onSave',
            'data-request-submit' => 'true',
            'data-request-data' => 'close:1',
        ],
        'delete' => [
            'label' => 'lang:admin::lang.button_icon_delete', 'class' => 'btn btn-danger',
            'data-request-submit' => 'true', 'data-request' => 'onDelete', 'data-request-data' => "_method:'DELETE'",
            'data-request-confirm' => 'lang:admin::lang.alert_warning_confirm', 'context' => ['edit'],
        ],
    ],
];

$config['form']['fields'] = [
    'title' => [
        'label' => 'lang:admin::lang.pages.label_title',
        'type' => 'text',
        'span' => 'left',
    ],
    'permalink_slug' => [
        'label' => 'lang:admin::lang.pages.label_permalink_slug',
        'type' => 'text',
//        'comment' => 'lang:admin::lang.help_permalink',
        'span' => 'right',
    ],
];
$config['form']['tabs']['fields'] = [
    'content' => [
        'type' => 'richeditor',
        'tab' => 'lang:admin::lang.pages.text_tab_edit',
        'cssClass' => 'richeditor-fluid',
    ],
    'navigation' => [
        'label' => 'lang:admin::lang.pages.label_navigation',
        'type' => 'checkbox',
        'span' => 'left',
        'default' => 'none',
        'tab' => 'lang:admin::lang.pages.text_tab_manage',
        'comment' => 'lang:admin::lang.pages.help_navigation',
        'options' => [
            'none' => 'lang:admin::lang.text_none',
            'header' => 'lang:admin::lang.pages.text_header',
            'side_bar' => 'lang:admin::lang.pages.text_side_bar',
            'footer' => 'lang:admin::lang.pages.text_footer',
        ],
    ],
    'language_id' => [
        'label' => 'lang:admin::lang.pages.label_language',
        'type' => 'relation',
        'span' => 'right',
        'relationFrom' => 'language',
        'tab' => 'lang:admin::lang.pages.text_tab_manage',
        'placeholder' => 'lang:admin::lang.text_please_select',
    ],
    'meta_description' => [
        'label' => 'lang:admin::lang.pages.label_meta_description',
        'tab' => 'lang:admin::lang.pages.text_tab_manage',
        'type' => 'textarea',
        'span' => 'left',
    ],
    'meta_keywords' => [
        'label' => 'lang:admin::lang.pages.label_meta_keywords',
        'tab' => 'lang:admin::lang.pages.text_tab_manage',
        'type' => 'textarea',
        'span' => 'right',
    ],
    'status' => [
        'label' => 'lang:admin::lang.pages.label_status',
        'tab' => 'lang:admin::lang.pages.text_tab_manage',
        'type' => 'switch',
        'default' => TRUE,
    ],
];

return $config;