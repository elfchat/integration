<?php
#COMMON

define('IPB_THIS_SCRIPT', 'public');
require_once('./initdata.php');
require_once(IPS_ROOT_PATH . 'sources/base/ipsRegistry.php');

$registry = ipsRegistry::instance();
$registry->init();

$id = intval($_COOKIE['member_id']);
$member = IPSMember::load($id);

if(!empty($member))
{
    $user = array();
    $user['from'] = 'IPB';
    $user['id'] = $member['member_id'];
    $user['name'] = $member['members_display_name'];
	$user['mask'] =  $member['prefix'] . '*' . $member['suffix'];
    elfchat_auth($user);

}
else
{
    elfchat_go();
}

exit();