<?php
define('ELFCHAT_CHARSET', 'windows-1251'); // Your site charset
#COMMON

require(dirname(__FILE__) . '/wp-load.php');

$user = wp_get_current_user();

if ($user->ID) {
    $query = array();
    $query['from'] = 'WordPress';
    $query['id'] = $user->ID;
    $query['name'] = $user->display_name;
    elfchat_auth(elfchat_convert($query, ELFCHAT_CHARSET));
} else {
    elfchat_go();
}