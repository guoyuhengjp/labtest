<?php

use App\Models\Link;

return [
    'title'   => 'おすすめ資料',
    'single'  => 'おすすめ資料',

    'model'   => Link::class,

    // 访问权限判断
    'permission'=> function()
    {
        // 只允许站长管理资源推荐链接
        return Auth::user()->hasRole('Founder');
    },

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'title' => [
            'title'    => '名称',
            'sortable' => false,
        ],
        'link' => [
            'title'    => 'URL',
            'sortable' => false,
        ],
        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
        'title' => [
            'title'    => '名称',
        ],
        'link' => [
            'title'    => 'URL',
        ],
    ],
    'filters' => [
        'id' => [
            'title' => ' ID',
        ],
        'title' => [
            'title' => '名称',
        ],
    ],
];
