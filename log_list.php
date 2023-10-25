<?php

if (!defined('EMLOG_ROOT')) {
    exit('error!');
}

?>

    <main>
<?php if (blog_tool_ishome()): ?>
    <section class="section section-lg section-hero section-shaped" style="height: 100vh;">
        <?php printBackground(getRandomImage(_g('indexImage')), _g('bubbleShow')); ?>
        <div class="container shape-container d-flex align-items-center py-lg">
            <div class="col px-0">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-6 text-center">
                        <?php if(_g('avatarEnable')): ?>
                            <div class="index-avatar-container">
                                <img src="<?php
                                if (_g('avatarUrl') == '') {
                                    echo TEMPLATE_URL . "images/avatar.png";
                                } else {
                                    echo _g('avatarUrl');
                                }
                                ?>" class="index-avatar" alt="avatar">
                            </div>
                        <?php endif; ?>
                        <h1 class="text-white"><?= $blogname ?></h1>
                        <hr/>
                        <p class="lead text-white"><?= $bloginfo ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php else: ?>
    <section class="section section-lg section-hero section-shaped">
        <?php printBackground(getRandomImage(_g('randomImage')), _g('bubbleShow')); ?>
        <div class="container shape-container d-flex align-items-center py-lg">
            <div class="col px-0 text-center">
                <div class="row align-items-center justify-content-center">
                    <h1 class="text-white">
                        <!-- 分类页面 -->
                        <?php if(isset($sort)): ?>分类 <?= $sort['sortname']?> 下的文章
                        <?php elseif (isset($tag)):?>包含标签 <?= $tag ?> 的文章
                        <?php elseif (isset($author)):?><?= getUser($author)['nickname'] ?> 的文章
                        <?php elseif (isset($keyword)):?><?php $lognum = count($logs); ?>包含关键字 <?= $keyword ?> 的文章 ( <?= $lognum ?> )
                        <?php elseif (isset($record)):?><?= substr($record, 0, 4) . '年' . substr($record, 4) . '月' ?>的文章
                        <?php else: ?>所有文章
                        <?php endif; ?>
                    </h1>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php doAction('index_loglist_top'); ?>
    <section class="section section-components bg-secondary content-card-container">
        <div class="container container-lg py-5 align-items-center content-card-container">
            <!-- Article list -->
            <?php if (!empty($logs)): ?>
                <?php $first_flag = true; ?>
                <?php foreach ($logs as $value): ?>
                    <?php printAricle($value, $first_flag);
                    $first_flag = false; ?>
                <?php endforeach; ?>
                <!-- Toggle page -->
                <section class="section" style="padding-bottom: 1rem; padding-top: 6rem">
                    <div class="container">
                        <nav class="page-nav">
                            <ul class="pagination justify-content-center">
                                <?php pageList($page_url); ?>
                            </ul>
                        </nav>
                    </div>
                </section>
            <?php else: ?>
                <div class="card shadow content-card list-card content-card-head">
                    <section class="section">
                        <div class="container">
                            <div class="content">
                                <h1>这里空空如也</h1>
                                <hr/>
                                <p>不如换个地方看看吧？</p>
                            </div>
                        </div>
                    </section>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php if (!blog_tool_ishome() && strpos(Dispatcher::setPath(), '_pjax=%23pjax-container')) echo("<script>$('html,body').animate({ scrollTop: $('.card.shadow.content-card.list-card.content-card-head, .card.shadow.content-card.list-image-card.content-card-head').offset().top}, 500)</script>") ?>

<?php

require_once View::getView('footer');
