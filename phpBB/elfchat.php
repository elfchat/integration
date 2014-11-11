<?php
define('ELFCHAT_CHARSET', 'iso-8859-1'); // Your site charset
#COMMON

define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
require($phpbb_root_path . 'common.' . $phpEx);
//require($phpbb_root_path . 'includes/functions_user.' . $phpEx);
//require($phpbb_root_path . 'includes/functions_module.' . $phpEx);

// Basic parameter data
$id 	= request_var('i', '');
$mode	= request_var('mode', '');

if ($mode == 'login' || $mode == 'logout' || $mode == 'confirm')
{
	define('IN_LOGIN', true);
}

// Start session management
$user->session_begin();
//$auth->acl($user->data);

if($user->data['user_id'] != 1)
{
    $query = array();
    $query['from'] = 'phpBB';
    $query['id'] = $user->data['user_id'];
    $query['name'] = $user->data['username'];
    elfchat_auth(elfchat_convert($query, ELFCHAT_CHARSET));
}
else
{
    elfchat_go();
}
