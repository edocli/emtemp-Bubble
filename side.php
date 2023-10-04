<?php
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>
<div class="row">
    <div class="col-md-4 widget">
        <h5>最新评论</h5>
        <?php $comments_recent = $this->widget('Widget_Comments_Recent', 'pageSize=5');
        if ($comments_recent->have()) {
            _e('<ul>');
            while ($comments_recent->next()) {
                _e('<li><a href="' . "$comments_recent->permalink" . '" class="footer-link">' . "$comments_recent->author" . ': ');
                $comments_recent->excerpt(35, '...');
                _e('</a></li>');
            }
            _e('</ul>');
        } else {
            _e('暂无评论');
        }
        ?>
    </div>
    <div class="col-md-4 widget">
        <h5>最新文章</h5>
        <ul><?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=6')->parse('<li><a href="{permalink}" class="footer-link">{title}</a></li>'); ?></ul>
    </div>
    <div class="col-md-4 widget">
        <h5>近期归档</h5>
        <ul><?php $this->widget('Widget_Contents_Post_Date', 'limit=6&type=month&format=F Y')->parse('<li><a href="{permalink}" class="footer-link">{date}</a></li>'); ?></ul>
    </div>
</div>