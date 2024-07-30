<?php
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>
<?php if(ISLOGIN && empty($authflg)): ?>
    <a href="admin">
        <button id="adminbtn" class="btn btn-icon-only rounded-circle btn-primary admin-btn">
            <span class="btn-inner--icon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
        </button>
    </a>
<?php endif; ?>
</main>
<!-- Footer -->
<footer class="footer">
    <div class="container">
        <?php include View::getView('side') ?>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                <div class="copyright">
                    <?= $footer_info ?>
                    <?php doAction('index_footer') ?>
                </div>
            </div>
            <div class="col-md-6">
                <ul class="nav nav-footer justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BLOG_URL ?>">首页</a>
                    </li>
                    <?php if (ISLOGIN): ?>
                        <li class="nav-item"><a class="nav-link" href="/admin">进入后台(<?= getUser(UID)['nickname'] ?>)</a></li>
                        <li class="nav-item"><a class="nav-link" href="/admin/account.php?action=logout">退出</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/admin">登录</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</footer>
<?php if (_g('Pjax')) echo '</div>'; ?>
<a id="scrollup" href="#" style="display: none;">
    <button id="scrollbtn" class="btn btn-icon-only rounded-circle btn-secondary scrollup-btn">
        <span class="btn-inner--icon"><i class="fa fa-arrow-up" aria-hidden="true"></i></span>
    </button>
</a>
<!-- Core -->
<script src="https://cdn.bootcdn.net/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
<!-- Optional plugins -->
<script src="https://cdn.bootcdn.net/ajax/libs/headroom/0.11.0/headroom.min.js"></script>
<!-- Theme JS -->
<script src="<?= TEMPLATE_URL ?>assets/js/argon.min.js"></script>
<script src="<?= TEMPLATE_URL ?>assets/js/bbrender.js"></script>
<!-- scrollup -->
<script>
    $(function () {
        let scrollBottom = parseInt($("#adminbtn").css("bottom")) + parseInt($("#adminbtn").css("height")) + 25;
        $("#scrollbtn").css("bottom", scrollBottom);
        let resizeTimer;
        $(window).resize(function () {
            if ($("#adminbtn").length > 0) {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(function () {
                    scrollBottom = parseInt($("#adminbtn").css("bottom")) + parseInt($("#adminbtn").css("height")) + 25;
                    $("#scrollbtn").css("bottom", scrollBottom);
                }, 250);
            }
        });
        let scrollLock = 0;
        if ($(window).scrollTop() > 500) $("#scrollup").fadeIn(400);
        $(window).scroll(function () {
            if (!scrollLock) {
                if ($(window).scrollTop() > 500) $("#scrollup").fadeIn(400);
                else $("#scrollup").fadeOut(400);
            }
        });
        $("#scrollup").click(function () {
            scrollLock = 1;
            $("#scrollup").fadeOut(400);
            $("html,body").animate({scrollTop: "0px"}, 500, function () {
                scrollLock = 0;
            });
        });
    });
</script>
<!-- Pjax -->

<script>
    function init() {
        <?php if(_g('prismjs') and _g('prismLine')): ?>
        let pres = document.querySelectorAll('pre');
        let lineNumberClassName = 'line-numbers';
        pres.forEach(function (item) {
            item.className = item.className === '' ? lineNumberClassName : item.className + ' ' + lineNumberClassName;
        });
        Prism.highlightAll(false, null);
        <?php endif; ?>
        $("img").Lazy({
            threshold: 700,
            effect: 'fadeIn',
            effectTime: 1000,
            defaultImage: "<?= TEMPLATE_URL ?>images/Loading.gif"
        });
        $("div[data-src]").Lazy({
            threshold: 700,
            effect: 'fadeIn',
            placeholder: "<?= TEMPLATE_URL ?>images/Loading.gif",
            effectTime: 1000
        });
        <?php if(_g('katex')): ?>
        try {
            renderMathInElement(document.body, {
                delimiters: [
                    {left: "$$", right: "$$", display: true},
                    {left: "$", right: "$", display: false}
                ]
            })
        } catch (e) {
        }
        <?php endif; ?>

        parseBbcode()
        parseBblink()

        <?php if(_g('Pjax')): ?>
        <?php echo _g('pjaxcomp'); ?>

        try {
            window.onload()
        } catch (e) {
        }
        <?php endif; ?>
    }
</script>
<?php if (_g('Pjax')): ?>
    <script src="https://cdn.bootcdn.net/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js"></script>
    <script src="<?= TEMPLATE_URL ?>assets/js/progress.js"></script>
    <script>
        let pgid = 0;
        $(document).pjax('a[href^="<?= BLOG_URL ?>"]:not(a[target="_blank"], a[no-pjax], a[href^="<?= BLOG_URL ?>admin"])',
            {
                container: '#pjax-container',
                fragment: '#pjax-container',
                timeout: 8000
            }).on('pjax:send', function () {
            pgid = start_progress()
            $(".black-cover").fadeIn(400)
            $('html,body').animate({scrollTop: $('html').offset().top}, 500)

        }).on('pjax:complete', function () {
            $(".black-cover").fadeOut(400)
            stop_progress(pgid)
            init()

        })
        $("#search").submit(function () {
            let att = $(this).serializeArray();
            for (let i in att) {
                if (att[i].name === "s") {
                    $.pjax({
                        url: "<?= BLOG_URL ?>?keyword=" + att[i].value,
                        container: '#pjax-container',
                        fragment: '#pjax-container',
                        timeout: 8000
                    })
                }
            }
            return false
        })
    </script>
    <div class="black-cover" style="display: none;"></div>
<?php endif; ?>
<!-- KaTeX JS -->
<?php if (_g('katex')): ?>
    <script src="https://cdnjs.loli.net/ajax/libs/KaTeX/0.11.1/katex.min.js"></script>
    <script src="https://cdnjs.loli.net/ajax/libs/KaTeX/0.11.1/contrib/auto-render.min.js"></script>
<?php endif; ?>
<!-- Prism JS -->
<?php if (_g('prismjs')): ?>
    <script src="https://cdnjs.loli.net/ajax/libs/prism/1.20.0/components/prism-core.min.js"></script>
    <script src="https://cdnjs.loli.net/ajax/libs/prism/1.20.0/plugins/autoloader/prism-autoloader.min.js"></script>
    <script src="https://cdnjs.loli.net/ajax/libs/prism/1.20.0/plugins/toolbar/prism-toolbar.min.js"></script>
    <script src="https://cdnjs.loli.net/ajax/libs/prism/1.20.0/plugins/show-language/prism-show-language.min.js"></script>
    <script src="https://cdnjs.loli.net/ajax/libs/prism/1.20.0/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js"></script>
    <?php if (_g('prismLine')): ?>
        <script src="https://cdnjs.loli.net/ajax/libs/prism/1.20.0/plugins/line-numbers/prism-line-numbers.min.js"></script>
    <?php endif; ?>
<?php endif; ?>
<!-- Alert -->
<div id="modal-notification" class="modal fade show" style="z-index: 102;display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="msgMain" class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onclick="$('#modal-notification').hide('normal');">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div id="msgDetail" class="modal-body"></div>
        </div>
    </div>
</div>
<script>
    function alert(main, detail, time=0) {
        $("#msgMain").html(main)
        if (detail) $("#msgDetail").html(detail)
        else $("#msgDetail").html("")
        $("#modal-notification").show("normal");
        if (time===0) return
        setTimeout(function() {
            $("#modal-notification").hide("normal");
        }, time)
    }

    init()
</script>
<?php if(blog_tool_ishome()&&_g('notice')):?>
    <script>alert("<?=_g('noticeTittle')?>","<?=_g('noticeContent')?>",<?=_g('noticeTime')?>);</script>
<?php endif;?>
<script>
    $(document).ready(function(){
        $("a").each(function(){
            var link = $(this);
            var href = link.attr("href");
            if (href && !href.startsWith('#') && !href.includes(window.location.host)) {
                link.click(function(event){
                    var proceed = confirm("您即将离开本站，是否继续？");
                    if(!proceed){
                        event.preventDefault();
                    }
                });
            }
        });
    });
</script>
<script>
    Fancybox.bind("[data-fancybox]", {
    });
</script>
<script>
    <?= _g('customJs') ?>
</script>
</body>
</html>