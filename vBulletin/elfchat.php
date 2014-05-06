<?php
define('ELFCHAT_CHARSET', 'ISO-8859-5'); // Your site charset
#COMMON

// vB

// ####################### SET PHP ENVIRONMENT ###########################
error_reporting(E_ALL & ~E_NOTICE);

// #################### DEFINE IMPORTANT CONSTANTS #######################
define('THIS_SCRIPT', 'index');
define('CSRF_PROTECTION', true);
define('CSRF_SKIP_LIST', '');
define('VB_ENTRY', 'elfchat.php');

// ######################### REQUIRE BACK-END ############################
require_once('./global.php');

if($vbulletin->userinfo['userid'] != 0)
{
    $query = array();
    $query['from'] = 'VB';
    $query['id'] = $vbulletin->userinfo['userid'];
    $query['name'] = $vbulletin->userinfo['username'];
    elfchat_auth(elfchat_convert($query, ELFCHAT_CHARSET));
}
else
{
    elfchat_go();
}