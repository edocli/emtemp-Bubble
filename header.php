<?php

/**
 * Template Name:Bubble
 * Description:清新风格响应式主题，化繁为简，如沐清风。
 * Version:1.0.1
 * Template Url:https://www.emlog.net/template/detail/1120
 * Author:UTF-X
 * Author Url:https://www.utf-x.cn/
 */

if (!defined('EMLOG_ROOT')) {
    exit('error!');
}

require_once View::getView('module');

if (!function_exists('_g')) {
    emMsg('请先在商店安装并开启：PRO版模版设置插件', BLOG_URL . 'admin/store.php?action=plu');
}

?>
    <!DOCTYPE html>
    <html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="keywords" content="<?= $site_key ?>"/>
        <meta name="description" content="<?= $site_description ?>"/>

        <title><?= $site_title ?></title>

        <!-- Favicon -->
        <link href="<?php
        if (empty(_g('favicon'))) {
            echo 'favicon.ico';
        } else {
            _g('favicon');
        }
        ?>" rel="icon">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

        <!-- FontAwesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
              rel="stylesheet">

        <!-- Main CSS -->
        <link type="text/css" href="<?= TEMPLATE_URL ?>assets/css/main.min.css" rel="stylesheet">

        <!-- KaTeX CSS -->
        <?php if (_g('katex')): ?>
            <link rel="stylesheet" type="text/css"
                  href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.11.1/katex.min.css">
        <?php endif; ?>

        <!-- PrismJS CSS -->
        <?php if (_g('prismjs')): ?>
            <link rel="stylesheet" type="text/css"
                  href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.20.0/themes/<?= _g('prismTheme') ?>.min.css"/>
            <link rel="stylesheet" type="text/css"
                  href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.20.0/plugins/toolbar/prism-toolbar.min.css"/>
            <?php if (_g('prismLine')): ?>
                <link rel="stylesheet" type="text/css"
                      href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.20.0/plugins/line-numbers/prism-line-numbers.min.css"/>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Jquery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- Custom CSS -->
        <?php if (_g('customCss')): ?>
            <style><?= _g('customCss') ?></style>
        <?php endif; ?>

        <!-- MD5 Js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.19.0/js/md5.min.js"></script>

        <!-- LazyLoad Js -->
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.11/jquery.lazy.min.js"></script>
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.11/jquery.lazy.plugins.min.js"></script>

        <!-- fancybox -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancyapps-ui/5.0.32/fancybox/fancybox.umd.js"></script>
        <link
                rel="stylesheet"
                href="https://cdnjs.cloudflare.com/ajax/libs/fancyapps-ui/5.0.32/fancybox/fancybox.min.css"
        />


        <?php doAction('index_head') ?>
    </head>
<body>
<header class="header-global">
    <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light headroom">
        <div class="container">
            <a class="navbar-brand" href="<?= BLOG_URL ?>"><?= $blogname ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-default"
                    aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-default">
                <div class="navbar-collapse-header">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="<?= BLOG_URL ?>"><h5><?= $blogname ?></h5></a>
                        </div>
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse"
                                    data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <ul class="navbar-nav ml-lg-auto navbar-nav-hover align-items-lg-center" id="navbarResponsive">
                    <?php blog_navi(); ?>
                    <?php doAction('index_navi_ext') ?>
                    <li class="navbar_search_container">
                        <form method="post" id="search">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                </div>
                                <input type="text" name="s" class="form-control" placeholder="搜点什么……"
                                       autocomplete="off">
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<?php if (_g('Pjax')) echo '<div id="pjax-container">'; ?>