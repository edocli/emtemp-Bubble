<?php

/*@support tpl_options*/
!defined('EMLOG_ROOT') && exit('access deined!');

$options = [
    'TplOptionsNavi' => [
        'type' => 'radio',
        'name' => '定义设置项标签页名称',
        'values' => [
            'nv-favicon' => 'Favicon',
            'nv-avatar' => '首页头像',
            'nv-background' => '背景',
            'nv-pjax' => 'Pjax 无刷新加载',
            'nv-katex' => 'KaTeX 数学公式渲染',
            'nv-prismjs' => 'Prism.JS 代码高亮',
            'nv-toc' => 'TOC 文章目录树',
            'nv-subcontent' => '摘要截取',
            'nv-notice' => '首页公告',
            'nv-custom' => '自定义代码'
        ],
        'icons' => [
            'nv-favicon' => 'ri-global-line',
            'nv-avatar' => 'ri-account-circle-line',
            'nv-background' => 'ri-picture-in-picture-line',
            'nv-pjax' => 'ri-refresh-line',
            'nv-katex' => 'ri-creative-commons-nd-line',
            'nv-prismjs' => 'ri-lightbulb-line',
            'nv-toc' => 'ri-menu-4-line',
            'nv-subcontent' => 'ri-text-wrap',
            'nv-notice' => 'ri-chat-2-line',
            'nv-custom' => 'ri-code-s-slash-line'
        ],
        'description' => '<p>模板：Bubble <br>化繁为简，如沐清风。</p>'
    ],
    'favicon' => [
        'labels' => 'nv-favicon',
        'type' => 'text',
        'name' => '站点 Favicon 地址',
        'description' => '在这里填入一个图片 URL 地址，以在浏览器标题前加上一个 Favicon，留空则使用默认 Favicon'
    ],
    'avatarEnable' => [
        'labels' => 'nv-avatar',
        'type' => 'checkon',
        'name' => '首页头像',
        'values' => [
            '1' => 1,
        ],
        'description' => '选择是否在首页显示头像'
    ],
    'avatarFrom' =>[
        'labels' => 'nv-avatar',
        'type' => 'radio',
        'name' => '首页头像源',
        'values' => [
            'admin' => '创始人头像',
            'url' => 'URL',
        ],
        'description' => '选择首页头像的来源，选择创始人头像会自动获取后台设置的创始人用户头像，若选择URL请在下方“首页头像URL地址”填入'
    ],
    'avatarUrl' => [
        'labels' => 'nv-avatar',
        'type' => 'text',
        'name' => '首页头像URL地址',
        'description' => '在这里填入一个图片 URL 地址，以在首页显示一个头像，留空则使用默认头像'
    ],
    'indexImage' => [
        'labels' => 'nv-background',
        'type' => 'text',
        'name' => '随机首页背景图像地址',
        'multi' => true,
        'description' => '在这里填入一个或多个图片 URL 地址，每行一个，<strong>请勿包含多余字符</strong>，以设定网站首页的头图，留空则使用默认紫色渐变背景'
    ],
    'randomImage' => [
        'labels' => 'nv-background',
        'type' => 'text',
        'multi' => true,
        'name' => '随机背景图像地址',
        'description' => '在这里填入一个或多个图片 URL 地址，每行一个，<strong>请勿包含多余字符</strong>，以设定网站文章页、独立页面以及其他页面的头图，设定后将随机显示，留空则使用默认紫色渐变背景'
    ],
    'bubbleShow' => [
        'labels' => 'nv-background',
        'type' => 'checkon',
        'name' => '背景气泡',
        'values' => [
            '1' => 1,
        ],
        'description' => '选择是否在首页以及文章页顶部背景处显示半透明气泡'
    ],
    'Pjax' => [
        'labels' => 'nv-pjax',
        'type' => 'checkon',
        'name' => 'Pjax 无刷新加载',
        'values' => [
            '1' => 1,
        ],
        'description' => '选择是否启用全站 Pjax 无刷新加载模式提升用户访问体验。<strong>（注意：可能会导致部分插件失效，可设置回调函数解决问题）</strong>'
    ],
    'pjaxcomp' => [
        'labels' => 'nv-pjax',
        'type' => 'text',
        'multi' => true,
        'name' => 'Pjax 回调函数',
        'description' => '在这里填入所需要的 js，以实现 Pjax 无刷新加载后的回调函数，如重新加载部分插件等'
    ],
    'katex' => [
        'labels' => 'nv-katex',
        'type' => 'checkon',
        'name' => 'KaTeX 数学公式渲染',
        'values' => [
            '1' => 1,
        ],
        'description' => '选择是否启用 KaTeX 数学公式渲染'
    ],
    'prismjs' => [
        'labels' => 'nv-prismjs',
        'type' => 'checkon',
        'name' => 'prism.js 代码高亮',
        'values' => [
            '1' => 1,
        ],
        'description' => '选择是否启用 prism.js 代码高亮'
    ],
    'prismLine' => [
        'labels' => 'nv-prismjs',
        'type' => 'checkon',
        'name' => 'prism.js 代码行号',
        'values' => [
            '1' => 1,
        ],
        'description' => '选择是否启用 prism.js 代码行号'
    ],
    'prismTheme' => [
        'labels' => 'nv-prismjs',
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
        'labels' => 'nv-toc',
        'type' => 'checkon',
        'name' => 'toc文章目录',
        'values' => [
            '1' => 1,
        ],
        'description' => '选择是否启用toc文章目录'
    ],
    'toc_enable' => [
        'labels' => 'nv-toc',
        'type' => 'checkon',
        'name' => 'toc文章目录默认展开',
        'values' => [
            '1' => 1,
        ],
        'description' => '选择是否启用toc文章目录默认展开'
    ],
    'subContent' => [
        'labels' => 'nv-subcontent',
        'type' => 'checkon',
        'name' => '自动截取摘要',
        'default' => 0,
        'values' => [
            '1' => 1,
        ],
        'description' => '文章自动截取摘要（关闭后若文章未手动设置摘要则显示全文）,<b>注意：开启后摘要将丢失样式，建议关闭此功能手动设置摘要以获得更好的浏览体验</b>'
    ],
    'subContentLen' => [
        'labels' => 'nv-subcontent',
        'type' => 'text',
        'name' => '自动摘要截取长度',
        'description' => '在这里填入一个数字，以设定摘要截取长度，留空则默认截取 200 个字符'
    ],
    'notice' => [
        'labels' => 'nv-notice',
        'type' => 'checkon',
        'name' => '公告',
        'default' => 0,
        'values' => [
            '1' => 1,
        ],
        'description' => '选择是否启用公告'
    ],
    'noticeTitle' => [
        'labels' => 'nv-notice',
        'type' => 'text',
        'name' => '公告标题',
        'description' => '在这里填入公告标题'
    ],
    'noticeContent' => [
        'labels' => 'nv-notice',
        'type' => 'text',
        'multi' => true,
        'name' => '公告内容',
        'description' => '在这里填入公告内容，支持 HTML 代码'
    ],
    'noticeTime' => [
        'labels' => 'nv-notice',
        'type' => 'text',
        'name' => '公告展示时间',
        'description' => '在这里填入公告展示时间，单位为毫秒，留空则需手动关闭'
    ],
    'customCss' => [
        'labels' => 'nv-custom',
        'type' => 'text',
        'multi' => true,
        'name' => '自定义 CSS',
        'description' => '在这里填入所需要的 css，以实现自定义页面样式，如调整字体大小等'
    ],
    'customJs' => [
        'labels' => 'nv-custom',
        'type' => 'text',
        'multi' => true,
        'name' => '自定义 JS',
        'description' => '在这里填入所需要的 JS，以实现自定义页面样式，如调整字体大小等'
    ],
];