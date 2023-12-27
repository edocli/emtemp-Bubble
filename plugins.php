<?php

if (!defined('EMLOG_ROOT')) {
    exit('error!');
}

function optionIconFont() {
    echo sprintf('<link rel="stylesheet" href="%s">', 'https://cdn.bootcdn.net/ajax/libs/remixicon/4.0.0/remixicon.min.css?ver=' . Option::EMLOG_VERSION_TIMESTAMP);
}
addAction('adm_head', 'optionIconFont');