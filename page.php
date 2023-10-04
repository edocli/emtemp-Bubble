<?php
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>
    <main>
    <section class="section section-lg section-hero section-shaped">
        <!-- Background circles -->
        <?php printBackground(getRandomImage(_g('randomImage')), _g('bubbleShow')); ?>
        <div class="container shape-container d-flex align-items-center py-lg">
            <div class="col px-0 text-center">
                <div class="row align-items-center justify-content-center">
                    <h1 class="text-white"><?= $log_title ?></h1>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-components bg-secondary content-card-container">
        <div class="container container-lg py-5 align-items-center content-card-container">
            <div class="card shadow content-card content-card-head">
                <!-- Page content -->
                <section class="section">
                    <div class="container">
                        <div class="content">
                            <?= $log_content ?>
                        </div>
                    </div>
                </section>
            </div>
            <!-- Comment -->
            <div class="card shadow content-card">
                <?php viewComment($comnum, $comments, $logid, $ckname, $ckmail, $ckurl, $verifyCode, $allow_remark); ?>
            </div>
        </div>
    </section>
<?php include View::getView('footer') ?>