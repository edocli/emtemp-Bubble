<?php
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>
<?php
$log_content = preg_replace_callback(
    '/<img\s+src="([^"]+)"(?:\s+alt="([^"]*)")?(?:\s+title="([^"]*)")?\s*\/?>/i',
    function ($matches) {
        // 构建 data-caption 属性
        $caption = !empty($matches[2]) ? $matches[2] : (!empty($matches[3]) ? $matches[3] : '');

        // 返回更新后的 <img> 标签
        return '<a href="' . $matches[1] . '" data-fancybox="gallery"' . ($caption ? ' data-caption="' . $caption . '"' : '') . '><img src="' . $matches[1] . '" /></a>';
    },
    $log_content
);
?>

    <main>
<?php if (_g('toc')) : ?>
    <div class="card shadow border-0 bg-secondary toc-container">
        <a class="carousel-control-prev" id="toc-nomiao">
            <i class="fa fa-chevron-left" aria-hidden="true"></i>
        </a>
        <div class="card-img container container-lg py-5 toc">
            <strong>文章目录</strong>
            <div class="toc-list">
                <?php getCatalog($log_content); ?>
            </div>
        </div>
    </div>
    <script>
        let onshow = false;

        function tocshow() {
            if (onshow) {
                $(".toc-container").css("right", '-175px')
                $(".toc-container i").removeClass("fa-chevron-right").addClass("fa-chevron-left")
            } else {
                $(".toc-container").css("right", '-5px')
                $(".toc-container i").removeClass("fa-chevron-left").addClass("fa-chevron-right")
            }
            onshow = !onshow
        }

        function jumpto(num) {
            $('html,body').animate({
                scrollTop: $('[name="cl-' + num + '"]').offset().top - 120
            }, 500)
        }

        $("#toc-nomiao").click(tocshow)
        let nowtoc = "cl-1";
        $(document).ready(function () {
            <?php if (_g('toc_enable')) : ?>
            tocshow()
            <?php endif; ?>
            $(document).scroll(function () {
                for (const ele of $("*[name*='cl-']").get().reverse()) {
                    if ($(document).scrollTop() + 121 > $(ele).offset().top) {
                        if (nowtoc !== ele.name) {
                            let tocele = $("*[name*='dl-" + nowtoc.replace("cl-", "") + "']");
                            tocele.removeClass("located")
                            tocele = $("*[name*='dl-" + ele.name.replace("cl-", "") + "']")
                            tocele.addClass("located")
                            $(".toc-list").animate({
                                scrollTop: $(".toc-list").scrollTop() - 50 + tocele.position().top
                            }, 80)
                            nowtoc = ele.name
                        }
                        break
                    }
                }
            })
        });
    </script>
<?php endif; ?>
    <section class="section section-lg section-hero section-shaped">
        <?php printBackground(($log_cover ?: getRandomImage(_g('randomImage'))), _g('bubbleShow')); ?>
        <div class="container shape-container d-flex align-items-center py-lg">
            <div class="col px-0 text-center">
                <div class="row align-items-center justify-content-center">
                    <h1 class="text-white"><?= $log_title ?></h1>
                </div>
                <div class="row align-items-center justify-content-center">
                    <h5 class="text-white">于
                        <time datetime="<?= date('c', $date) ?>"><?= date('Y-n-j', $date) ?></time>
                        由 <?= getUser($author)['nickname'] ?> 发布
                    </h5>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-components bg-secondary content-card-container">
        <div class="container container-lg py-5 align-items-center content-card-container">
            <div class="card shadow content-card content-card-head">
                <!-- Article content -->
                <section class="section">
                    <div class="container">
                        <div class="content">
                            <?= $log_content ?>
                            <?php doAction('log_related', $logData) ?>
                            <hr>
                            <ul>
                                <li>分类：<?php printCategory($sortid); ?></li>
                                <li>标签：<?php printTag($logid); ?></li>
                            </ul>
                        </div>
                    </div>
                </section>
            </div>
            <div class="card shadow content-card">
                <!-- Comment -->
                <?php viewComment($comnum, $comments, $logid, $ckname, $ckmail, $ckurl, $verifyCode, $allow_remark); ?>
            </div>
        </div>
    </section>

<?php

$authflg = editflg($logid, $author);

include View::getView('footer');
