<?php

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

    <title>404</title>

    <!-- Favicon -->
    <link href="<?php
    if (empty(_g('favicon'))) {
        echo 'favicon.ico';
    } else {
        _g('favicon');
    }
    ?>" rel="icon">

    <!-- Fonts -->
    <link href="https://fonts.font.im/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Main CSS -->
    <link type="text/css" href="<?= TEMPLATE_URL ?>assets/css/main.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <?php if (_g('customCss')): ?>
        <style><?= _g('customCss') ?></style>
    <?php endif; ?>

</head>

<body>
<section class="section section-lg section-hero section-shaped" style="height: 100vh;">
    <?php printBackground(_g('indexImage'), _g('bubbleShow')); ?>
    <div class="container shape-container d-flex align-items-center py-lg">
        <div class="col px-0">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 text-center">
                    <h1 class="text-white">这里空空如也</h1>
                    <hr/>
                    <a href="javascript:history.back()" class="btn btn-primary btn-neutral">返回上一页</a>
                </div>
            </div>
        </div>
    </div>
</section>
</body>

</html>
