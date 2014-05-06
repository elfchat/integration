<?php
define('DLE_CHARSET', 'Windows-1251'); // Your site charset
#COMMON

// DLE

@session_start();
@ob_start();
@ob_implicit_flush(0);

@error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
@ini_set('display_errors', true);
@ini_set('html_errors', false);
@ini_set('error_reporting', E_ALL ^ E_WARNING ^ E_NOTICE);

define ('DATALIFEENGINE', true);

$member_id = FALSE;
$is_logged = FALSE;

define ('ROOT_DIR', dirname(__FILE__));
define ('ENGINE_DIR', ROOT_DIR . '/engine');

require_once ROOT_DIR . '/engine/init.php';


if($is_logged)
{
    $user = array();
    $user['from'] = 'DLE';
    $user['id'] = $member_id['user_id'];
    $user['name'] = $member_id['name'];
    elfchat_auth(elfchat_convert($user, DLE_CHARSET));
}
else
{
    elfchat_go();
}