<?php
define('ELFCHAT_CHARSET', 'windows-1251'); // Your site charset
#COMMON


require_once("include/bittorrent.php");
dbconn(true);

if(!empty($CURUSER))
{
    $query = array();
    $query['from'] = 'TBDEV';
    $query['id'] = $CURUSER['id'];
    $query['name'] = $CURUSER['username'];
    elfchat_auth(elfchat_convert($query, ELFCHAT_CHARSET));
}
else
{
    elfchat_go();
}