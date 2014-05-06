<?php
define('ELFCHAT_CHARSET', 'windows-1251'); // Your site charset
#COMMON

define('PUN_ROOT', './');
require PUN_ROOT.'include/common.php';

if( $pun_user['id'] != 1 )
{
    $query = array();
    $query['from'] = 'punbb';
    $query['id'] = $pun_user['id'];
    $query['name'] = $pun_user['username'];
    elfchat_auth(elfchat_convert($query, ELFCHAT_CHARSET));
}
else
{
    elfchat_go();
}