<?php
define('INSTANT_CMS_CHARSET', 'windows-1251'); // Your site charset
#COMMON


Error_Reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
setlocale(LC_ALL, 'ru_RU.CP1251');
define('PATH', $_SERVER['DOCUMENT_ROOT']);
define("VALID_CMS", 1);
session_start();

include('core/cms.php');
include(PATH . '/includes/config.inc.php');

$inCore = cmsCore::getInstance();

define('HOST', 'http://' . $inCore->getHost());

$inCore->loadClass('user');


$inDB = cmsDatabase::getInstance();
$inConf = cmsConfig::getInstance();
$inUser = cmsUser::getInstance();

$inUser->autoLogin();
if(!$inUser->update() && !$inCore->request('uri', 'str') == '/logout')
{
    $inCore->halt();
}

if($inUser->id != 0)
{
    $user = array();
    $user['from'] = 'instantCMS';
    $user['id'] = $inUser->id;
    $user['name'] = $inUser->nickname;
    elfchat_auth(elfchat_convert($user, INSTANT_CMS_CHARSET));
}
else
{
    header('Location: ' . ELFCHAT_URL);
}

