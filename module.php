<?php

if (!defined('EMLOG_ROOT')) {
    exit('error!');
}

function printBackground($url, $show)
{
    echo '<div ';
    if ($url == '') echo 'class="shape shape-style-1 shape-primary"';
    else echo 'class="shape shape-style-1 shape-image" style="background-image: url(' . "$url" . ')"';
    echo '>';
    if ($show)
        echo '<span class="span-150"></span>
			<span class="span-50"></span>
			<span class="span-50"></span>
			<span class="span-75"></span>
			<span class="span-100"></span>
			<span class="span-75"></span>
			<span class="span-50"></span>
			<span class="span-100"></span>
			<span class="span-50"></span>
			<span class="span-100"></span>';
    echo '</div>';
}

function getRandomImage($str)
{
    if ($str == '') return '';
    $arr = explode(PHP_EOL, $str);
    return $arr[rand(0, sizeof($arr) - 1)];
}

function printAricle($value, $flag)
{ ?>
    <?php if (!empty($value['log_cover'])) { ?>
    <a class="card shadow content-card list-image-card <?php if ($flag): ?>content-card-head<?php endif; ?>"
       href="<?= $value['log_url'] ?>">
        <div class="list-card-bg" data-src="<?= $value['log_cover'] ?>"></div>
        <object class="list-image-card-section">
            <div class="container">
                <div class="content list-card-content">
                    <h1><?= $value['log_title'] ?></h1>
                    <div class="list-object">
                        <span class="list-tag"><i class="fa fa-calendar-o" aria-hidden="true"></i> <time
                                    datetime="<?= date('c', $value['date']) ?>"><?= date('Y-n-j', $value['date']) ?></time></span>
                        <span class="list-tag"><i class="fa fa-comments-o"
                                                  aria-hidden="true"></i> <?= $value['comnum'] ?> 条评论</span>
                        <?php printCategory($value['sortid'], 1); ?>
                        <?php printTag($value['logid'], 1); ?>
                        <span class="list-tag"><i class="fa fa-user-o"
                                                  aria-hidden="true"></i> <?php blog_author($value['author']); ?></span>
                    </div>
                    <?= $value['log_description'] ?>
                </div>
            </div>
        </object>
    </a>
<?php } else { ?>
    <a class="card shadow content-card list-card <?php if ($flag): ?>content-card-head<?php endif; ?>"
       href="<?= $value['log_url'] ?>">
        <object class="section">
            <div class="container">
                <div class="content list-card-content">
                    <h1><?= $value['log_title'] ?></h1>
                    <div class="list-object">
                        <span class="list-tag"><i class="fa fa-calendar-o" aria-hidden="true"></i> <time
                                    datetime="<?= date('c', $value['date']) ?>"><?= date('Y-n-j', $value['date']) ?></time></span>
                        <span class="list-tag"><i class="fa fa-comments-o"
                                                  aria-hidden="true"></i> <?= $value['comnum'] ?> 条评论</span>
                        <?php printCategory($value['logid'], 1); ?>
                        <?php printTag($value['logid'], 1); ?>
                        <span class="list-tag"><i class="fa fa-user-o"
                                                  aria-hidden="true"></i> <?php blog_author($value['author']); ?></span>
                    </div>
                    <?= $value['log_description'] ?>
                </div>
            </div>
        </object>
    </a>
<?php } ?>
<?php }

function printCategory($sortID, $icon = 0)
{
    $Sort_Model = new Sort_Model();
    $r = $Sort_Model->getOneSortById($sortID);
    $sortName = isset($r['sortname']) ? $r['sortname'] : '';
    ?>
    <span class="list-tag">
		<?php if ($icon) { ?><i class="fa fa-folder-o" aria-hidden="true"></i><?php } ?>
        <?php if (!empty($sortName)): ?>
            <a href="<?= Url::sort($sortID) ?>" class="badge badge-info badge-pill"><?= $sortName ?></a>
        <?php else: ?>
            <a onclick="return false;" class="badge badge-info badge-pill text-white">未分类</a>
        <?php endif; ?>
	</span>
<?php }

function printTag($blogid, $icon = 0)
{
    $tag_model = new Tag_Model();
    $tag_ids = $tag_model->getTagIdsFromBlogId($blogid);
    $tag_names = $tag_model->getNamesFromIds($tag_ids);
    ?>
    <span class="list-tag">
		<?php if ($icon) { ?><i class="fa fa-tags" aria-hidden="true"></i><?php } ?>
        <?php if (!empty($tag_names)): ?>
            <?php foreach ($tag_names as $tags): ?>
                <a href="<?= Url::tag(rawurlencode($tags)) ?>" class="badge badge-success badge-pill"><?= $tags ?></a>
            <?php endforeach; ?>
        <?php else: ?>
            <a onclick="return false;" class="badge badge-default badge-pill text-white">无标签</a>
        <?php endif; ?>
	</span>
<?php }

function pageList($inputString)
{

    $inputString = preg_replace('/<a/', '<li><a', $inputString);

    $inputString = preg_replace('/a>/', 'a></li>', $inputString);

    $inputString = str_replace('<em>', '<li><a>', $inputString);
    $inputString = str_replace('</em>', '</a></li>', $inputString);

    $inputString = str_replace('<span>', '<li class="active"><a href onclick="return false;">', $inputString);
    $inputString = str_replace('</span>', '</a></li>', $inputString);

    echo $inputString;

}

function blog_author($uid)
{
    $user_info = getUser($uid);
    $author = $user_info['nickname'];
    echo '<a class="badge badge-warning badge-pill" href="' . Url::author($uid) . '">' . $author . '</a>';
}


function getUser($uid)
{
    $User_Model = new User_Model();
    return $User_Model->getOneUser($uid);
}

function getCatalog(&$obj)
{
    global $catalog;
    global $catalog_count;
    $catalog = [];
    $catalog_count = 0;
    $obj = preg_replace_callback('/<h([1-6])(.*?)>(.*?)<\/h\1>/i', function ($obj) {
        global $catalog;
        global $catalog_count;
        $catalog_count++;
        $catalog[] = array('text' => trim(strip_tags($obj[3])), 'depth' => $obj[1], 'count' => $catalog_count);
        return '<h' . $obj[1] . $obj[2] . '><a name="cl-' . $catalog_count . '"></a>' . $obj[3] . '</h' . $obj[1] . '>';
    }, $obj);
    $index = '';
    if ($catalog) {
        $index = '<ul>' . "\n";
        $prev_depth = '';
        $to_depth = 0;
        foreach ($catalog as $catalog_item) {
            $catalog_depth = $catalog_item['depth'];
            if ($prev_depth) {
                if ($catalog_depth == $prev_depth) {
                    $index .= '</li>' . "\n";
                } elseif ($catalog_depth > $prev_depth) {
                    $to_depth++;
                    $index .= '<ul>' . "\n";
                } else {
                    $to_depth2 = ($to_depth > ($prev_depth - $catalog_depth)) ? ($prev_depth - $catalog_depth) : $to_depth;
                    if ($to_depth2) {
                        for ($i = 0; $i < $to_depth2; $i++) {
                            $index .= '</li>' . "\n" . '</ul>' . "\n";
                            $to_depth--;
                        }
                    }
                    $index .= '</li>';
                }
            }
            $index .= '<li><a name="dl-' . $catalog_item['count'] . '" href="javascript:jumpto(' . $catalog_item['count'] . ')">' . $catalog_item['text'] . '</a>';
            $prev_depth = $catalog_item['depth'];
        }
        $index .= str_repeat('</li>' . "\n" . '</ul>' . "\n", $to_depth + 1);
    }
    echo $index;
}


function blog_navi()
{
    global $CACHE;
    $navi_cache = $CACHE->readCache('navi');

    foreach ($navi_cache as $value):
        if ($value['pid'] != 0) {
            continue;
        }
        if ($value['url'] == 'admin' && ISLOGIN):
            ?>
            <li class="nav-item"><a href="<?= BLOG_URL ?>admin/" class="nav-link">管理</a></li>
            <li class="nav-item"><a href="<?= BLOG_URL ?>admin/account.php?action=logout" class="nav-link">退出</a></li>
            <?php
            continue;
        endif;
        $newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
        $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
        $current_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'active' : '';
        ?>
        <?php if (!empty($value['children']) || !empty($value['childnavi'])) : ?>
        <?php if (!empty($value['children'])): ?>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" id="nav_link"
                   href="<?= $value['url'] ?>" <?= $newtab ?>><?= $value['naviname'] ?></a>
                <div class="dropdown-menu">
                    <?php foreach ($value['children'] as $row) {
                        echo '<a class="dropdown-item" href="' . Url::sort($row['sid']) . '">' . $row['sortname'] . '</a>';
                    } ?>
                </div>
            </li>
        <?php endif ?>
        <?php if (!empty($value['childnavi'])) : ?>
            <li class="nav-item dropdown">
            <a class='nav-link' data-toggle="dropdown" id="nav_link" <?= $newtab ?> ><?= $value['naviname'] ?></a>
            <div class="dropdown-menu">
                <?php foreach ($value['childnavi'] as $row) {
                    $newtab = $row['newtab'] == 'y' ? 'target="_blank"' : '';
                    echo '<a class="dropdown-item" href="' . $row['url'] . "\" $newtab >" . $row['naviname'] . '</a>';
                } ?>
            </div>
        <?php endif ?>
        </li>
    <?php else: ?>
        <li class="nav-item"><a class="nav-link"
                                href="<?= $value['url'] ?>" <?= $newtab ?>><?= $value['naviname'] ?></a></li>
    <?php endif ?>
    <?php endforeach ?>
<?php } ?>

<?php
function blog_tool_ishome()
{
    if (str_replace('?_pjax=%23pjax-container', '', trim(Dispatcher::setPath(), '/')) == '') {
        return true;
    } else {
        return FALSE;
    }
}

function threadedComments($comments, $children)
{
    ?>
    <ol class="comment-list">
        <?php
        foreach ($children as $cid) {
            $comment = $comments[$cid];
            $indent = true;
            if ($comment['level'] == 0)
                $indent = false;
            ?>
            <li id="li-comment-<?= $comment['cid'] ?>" class="<?= $indent ? 'comment-child-indent' : '' ?>">
                <div id="comment-<?= $comment['cid'] ?>">
                    <div class="comment-item">
                        <div class="<?php
                        if ($comment['level'] > 0) {
                            echo 'comment-child';
                        } else {
                            echo 'comment-parent';
                        }
                        ?>">
                            <img class="avatar" alt="<?= $comment['poster'] ?>"
                                 src="<?= getGravatar($comment['mail'], 80) ?>">
                        </div>
                        <div class="comment-body">
                            <div class="comment-head">
                                <h5><?php if ($comment['url']) { ?><a target="_blank" rel="external nofollow"
                                                                      href="<?= $comment['url'] ?>"><?= $comment['poster'] ?></a><?php } else { ?><?= $comment['poster'] ?><?php } ?>
                                    · <small><?= $comment['date'] ?></small>
                                </h5>
                            </div>
                            <?= $comment['content'] ?>
                            <div style="float: right;">
                                <a href rel="nofollow"
                                   onclick="return EmComment.reply('comment-<?= $comment['cid'] ?>', <?= $comment['cid'] ?>);"><i
                                            class="fa fa-reply" aria-hidden="true"></i> 回复</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($comment['children']) { ?>
                    <div class="comment-children">
                        <?php threadedComments($comments, $comment['children']); ?>
                    </div>
                <?php } ?>
            </li>

        <?php } ?>
    </ol>
    <?php
} ?>

<?php function viewComment($comnum, $comments, $logid, $ckname, $ckmail, $ckurl, $verifyCode, $allow_remark)
{
    extract($comments);
    $isNeedChinese = Option::get('comment_needchinese');
    ?>

    <section class="section">
        <div class="container" id="comments">
            <div class="content">
                <div class="row align-items-center justify-content-center">
                    <h3><?= $comnum ?>条评论</h3>
                </div>
                <?php if ($commentStacks): ?>
                    <?php threadedComments($comments, $commentStacks) ?>
                    <div class="row align-items-center justify-content-center">
                        <nav class="page-nav">
                            <ul class="pagination">
                                <?php pageList($commentPageUrl); ?>
                            </ul>
                        </nav>
                    </div>
                <?php endif; ?>
                <div class="comment-card">
                    <?php if ($allow_remark == 'y'): ?>
                    <div id="respond-post" class="comment-reply">
                        <div class="row align-items-center justify-content-center">
                            <h3 id="response">发表评论</h3>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <a href id="cancel-comment-reply-link" rel="nofollow" style="display: none;"
                               onclick="return EmComment.cancelReply();">取消回复</a>
                        </div>
                        <br/>
                        <form method="post" name="commentform" class="container"
                              action="<?= BLOG_URL ?>index.php?action=addcom" id="comment-form"
                              is-chinese="<?= $isNeedChinese ?>" style="overflow: auto; zoom: 1;"
                              onsubmit="return myBlog.comSubmitTip()">
                            <input type="hidden" name="gid" value="<?= $logid ?>"/>
                            <?php if (ISLOGIN): ?>
                                <p>已登录为 <a no-pjax href="/admin"><?= getUser(UID)['nickname'] ?></a> | <a
                                            href="/admin/account.php?action=logout" title="Logout">注销？</a></p>
                            <?php else: ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
											<span class="input-group-text" style="padding: 0 .5rem;">
            									<div id="author-head" class="icon-shape rounded-circle text-white"
                                                     style="width: 2rem;height: 2rem;background-image: url(//cravatar.cn/avatar/);background-position: center;background-size: cover;background-repeat: no-repeat;"></div>
            								</span>
                                                </div>
                                                <input type="text" name="comname" id="author" class="form-control"
                                                       placeholder="名称"
                                                       value="<?= $ckname ?>"
                                                       required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-envelope-o"
                                                                                          aria-hidden="true"></i></span>
                                                </div>
                                                <input type="email" name="commail" id="mail" class="form-control"
                                                       placeholder="邮箱"
                                                       value="<?= $ckmail ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-globe"
                                                                                      aria-hidden="true"></i></span>
                                                </div>
                                                <input type="url" name="comurl" id="url" class="form-control"
                                                       placeholder="网站"
                                                       value="<?= $ckurl ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <p>
                                <textarea rows="8" cols="50" name="comment" id="textarea" class="form-control"
                                          required></textarea>
                            </p>
                            <?php if ($verifyCode): ?>
                                <div class="input-group">
                                    <img src="http://localhost/include/lib/checkcode.php" id="captcha" alt="验证码">
                                    <input type="text" name="imgcode" class="form-control"
                                           maxlength="5"
                                           placeholder="验证码"
                                           required/>
                                </div>
                            <?php endif; ?>
                            <p>
                                <button type="submit"
                                        class="btn btn-outline-success" id="add-comment-button"
                                        style="float: right;">提交评论
                                </button>
                            </p>
                            <input type="hidden" name="pid" id="comment-pid" value="0" tabindex="1"/>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div class="row align-items-center justify-content-center">
                    <h3 id="response">评论已关闭</h3>
                </div>
            <?php endif; ?>
            </div>
        </div>
    </section>
    <script>
        window.EmComment = {
            dom: function (id) {
                return document.getElementById(id);
            },

            create: function (tag, attr) {
                let el = document.createElement(tag);

                for (let key in attr) {
                    el.setAttribute(key, attr[key]);
                }

                return el;
            },

            reply: function (cid, coid) {
                let comment = this.dom(cid),
                    response = this.dom('respond-post'), input = this.dom('comment-parent'),
                    form = 'form' === response.tagName ? response : response.getElementsByTagName('form')[0],
                    textarea = response.getElementsByTagName('textarea')[0];

                if (null == input) {
                    input = this.create('input', {
                        'type': 'hidden',
                        'name': 'parent',
                        'id': 'comment-parent'
                    });

                    form.appendChild(input);
                }

                input.setAttribute('value', coid);

                if (null == this.dom('comment-form-place-holder')) {
                    let holder = this.create('div', {
                        'id': 'comment-form-place-holder'
                    });

                    response.parentNode.insertBefore(holder, response);
                }

                comment.appendChild(response);
                this.dom('cancel-comment-reply-link').style.display = '';

                if (null != textarea && 'text' === textarea.name) {
                    textarea.focus();
                }

                $("#comment-pid").attr("value", $('#respond-post').parent().attr("id").replace("comment-", ""));

                return false;
            },

            cancelReply: function () {
                $("#comment-pid").attr("value", 0);
                let response = this.dom('respond-post'),
                    holder = this.dom('comment-form-place-holder'), input = this.dom('comment-parent');

                if (null != input) {
                    input.parentNode.removeChild(input);
                }

                if (null == holder) {
                    return true;
                }

                this.dom('cancel-comment-reply-link').style.display = 'none';
                holder.parentNode.insertBefore(response, holder);
                return false;
            }
        };

        $("#mail").on('blur', function () {
            let url = "//cravatar.cn/avatar/" + md5($(this).val()) + "?s=40&d=";
            $("#author-head").css('background-image', 'url(' + url + ')');
        })

        let myBlog = {
            /**
             * 提交评论前对表单的验证
             */
            comTip: '', comSubmitTip: function (value) {
                if (value === 'judge') {
                    let cnReg = /[\u4e00-\u9fa5]/
                    let mailReg = /^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/
                    let urlReg = /[^\s]*\.+[^\s]/

                    let isCn = $('#comment-form').attr('is-chinese')
                    let comContent = $('#textarea').val()
                    let mail = $('#mail').val()
                    let url = $('#url').val()

                    if (isCn === 'y' && !cnReg.test(comContent)) {
                        this.comTip = "评论内容需要包含中文！"
                    } else if (typeof mail !== "undefined" && mail !== '' && !mailReg.test(mail)) {
                        this.comTip = "邮箱格式错误！"
                    } else if (typeof url !== "undefined" && url !== '' && !urlReg.test(url)) {
                        this.comTip = "网址格式错误！"
                    } else {
                        this.comTip = ''
                    }
                } else {
                    if (this.comTip !== '') {
                        alert(this.comTip)
                        return false
                    } else {
                        return true
                    }
                }
            },
            /**
             * 点击刷新验证码
             */
            captchaRefresh: function ($t) {
                let timestamp = new Date().getTime();
                $t.attr("src", "/include/lib/checkcode.php?" + timestamp)
            },
        };

        /**
         * 事件监听
         */
        $(document).ready(function () {

            $("#captcha").click(function () {
                myBlog.captchaRefresh($(this))
            })
            $("#comment-form").blur(function () {
                myBlog.comSubmitTip('judge')
            })
        })
    </script>
<?php } ?>

<?php function widget_newcomm($title)
{
    global $CACHE;
    $com_cache = $CACHE->readCache('comment');
    $isGravatar = Option::get('isgravatar');
    ?>
    <div class="col-md-4 widget">
        <h5><?= $title ?></h5>
        <ul>
            <?php
            foreach ($com_cache as $value):
                $url = Url::comment($value['gid'], $value['page'], $value['cid']);
                ?>
                <li>
                    <a href="<?= $url ?>" class="footer-link"><b><?= $value['name'] ?>: </b><?= $value['content'] ?></a>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
<?php } ?>

<?php
function widget_newlog($title)
{
    global $CACHE;
    $newLogs_cache = $CACHE->readCache('newlog');
    ?>
    <div class="col-md-4 widget">
        <h5><?= $title ?></h5>
        <ul>
            <?php foreach ($newLogs_cache as $value): ?>
                <li><a href="<?= Url::log($value['gid']) ?>" class="footer-link"><?= $value['title'] ?></a></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php } ?>

<?php
function widget_archive($title)
{
    $bar_id = "36";
    global $CACHE;
    $record_cache = $CACHE->readCache('record');
    ?>
    <div class="col-md-4 widget">
        <h5><?= $title ?></h5>
        <ul>
            <?php foreach ($record_cache as $value): ?>
                <li><a href="<?= Url::record($value['date']) ?>" class="footer-link"><?= $value['record'] ?>
                        &nbsp;(<?= $value['lognum'] ?>)</a></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php } ?>
