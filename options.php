<?php

/*@support tpl_options*/
!defined('EMLOG_ROOT') && exit('access deined!');

$options = [
    'TplOptionsNavi' => [
        'type' => 'radio',
        'name' => '定义设置项标签页名称',
        'values' => [
            'setting' => '设置',
        ],
        'description' => '<p>模板：Bubble <br>化繁为简，如沐清风。</p>'
    ],
    'favicon' => [
        'labels' => 'setting',
        'type' => 'text',
        'name' => '站点 Faxicon 地址',
        'description' => '在这里填入一个图片 URL 地址，以在浏览器标题前加上一个 Favicon，留空则使用默认 Favicon'
    ],
    'avatarEnable' => [
        'labels' => 'setting',
        'type' => 'checkon',
        'name' => '首页头像',
        'values' => [
            '1' => 1,
        ],
        'description' => '选择是否在首页显示头像'
    ],
    'avatarUrl' => [
        'labels' => 'setting',
        'type' => 'text',
        'name' => '首页头像地址',
        'description' => '在这里填入一个图片 URL 地址，以在首页显示一个头像，留空则使用默认头像'
    ],
    'indexImage' => [
        'labels' => 'setting',
        'type' => 'text',
        'name' => '随机首页背景图像地址',
        'multi' => true,
        'description' => '在这里填入一个或多个图片 URL 地址，每行一个，<strong>请勿包含多余字符</strong>，以设定网站首页的头图，留空则使用默认紫色渐变背景'
    ],
    'randomImage' => [
        'labels' => 'setting',
        'type' => 'text',
        'multi' => true,
        'name' => '随机背景图像地址',
        'description' => '在这里填入一个或多个图片 URL 地址，每行一个，<strong>请勿包含多余字符</strong>，以设定网站文章页、独立页面以及其他页面的头图，设定后将随机显示，留空则使用默认紫色渐变背景'
    ],
    'bubbleShow' => [
        'labels' => 'setting',
        'type' => 'checkon',
        'name' => '背景气泡',
        'values' => [
            '1' => 1,
        ],
        'description' => '选择是否在首页以及文章页顶部背景处显示半透明气泡'
    ],
    'customCss' => [
        'labels' => 'setting',
        'type' => 'text',
        'multi' => true,
        'name' => '自定义 CSS',
        'description' => '在这里填入所需要的 css，以实现自定义页面样式，如调整字体大小等'
    ],
    'Pjax' => [
        'labels' => 'setting',
        'type' => 'checkon',
        'name' => 'Pjax 无刷新加载',
        'values' => [
            '1' => 1,
        ],
        'description' => '选择是否启用全站 Pjax 无刷新加载模式提升用户访问体验。<strong>（注意：可能会导致部分插件失效，可设置回调函数解决问题）</strong>'
    ],
    'pjaxcomp' => [
        'labels' => 'setting',
        'type' => 'text',
        'multi' => true,
        'name' => 'Pjax 回调函数',
        'description' => '在这里填入所需要的 js，以实现 Pjax 无刷新加载后的回调函数，如重新加载部分插件等'
    ],
    'katex' => [
        'labels' => 'setting',
        'type' => 'checkon',
        'name' => 'KaTeX 数学公式渲染',
        'values' => [
            '1' => 1,
        ],
        'description' => '选择是否启用 KaTeX 数学公式渲染'
    ],
    'prismjs' => [
        'labels' => 'setting',
        'type' => 'checkon',
        'name' => 'prism.js 代码高亮',
        'values' => [
            '1' => 1,
        ],
        'description' => '选择是否启用 prism.js 代码高亮'
    ],
    'prismLine' => [
        'labels' => 'setting',
        'type' => 'checkon',
        'name' => 'prism.js 代码行号',
        'values' => [
            '1' => 1,
        ],
        'description' => '选择是否启用 prism.js 代码行号'
    ],
    'prismTheme' => [
        'labels' => 'setting',
        'type' => 'radio',
        'name' => 'prism.js 高亮主题',
        'values' => [
            'prism' => 'default',
            'prism-coy' => 'coy',
            'prism-dark' => 'dark',
            'prism-funky' => 'funky',
            'prism-okaidia' => 'okaidia',
            'prism-solarizedlight' => 'solarizedlight',
            'prism-tomorrow' => 'tomorrow',
            'prism-twilight' => 'twilight',
        ],
        'description' => '选择 prism.js 代码高亮的主题配色'
    ],
    'toc' => [
        'labels' => 'setting',
        'type' => 'checkon',
        'name' => 'toc文章目录',
        'values' => [
            '1' => 1,
        ],
        'description' => '选择是否启用toc文章目录'
    ],
    'toc_enable' => [
        'labels' => 'setting',
        'type' => 'checkon',
        'name' => 'toc文章目录默认展开',
        'values' => [
            '1' => 1,
        ],
        'description' => '选择是否启用toc文章目录默认展开'
    ],
    'subContent' => [
        'labels' => 'setting',
        'type' => 'checkon',
        'name' => '自动截取摘要',
        'default' => 0,
        'values' => [
            '1' => 1,
        ],
        'description' => '文章自动截取摘要（关闭后若文章未手动设置摘要则显示全文）,<b>注意：开启后摘要将丢失样式，建议关闭此功能手动设置摘要以获得更好的浏览体验</b>'
    ],
    'subContentLen' => [
        'labels' => 'setting',
        'type' => 'text',
        'name' => '自动摘要截取长度',
        'description' => '在这里填入一个数字，以设定摘要截取长度，留空则默认截取 200 个字符'
    ],
];