<?php
define('ELFCHAT_CHARSET', 'iso-8859-1'); // Your site charset
#COMMON

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
//


if($userdata['session_logged_in'])
{
    $query = array();
    $query['from'] = 'phpBB';
    $query['id'] = $userdata['user_id'];
    $query['name'] = $userdata['username'];
    elfchat_auth(elfchat_convert($query, ELFCHAT_CHARSET));
}
else
{
    elfchat_go();
}
