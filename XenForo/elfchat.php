<?php
#COMMON

$startTime = microtime(true);
$fileDir = dirname(__FILE__);

require($fileDir . '/library/XenForo/Autoloader.php');
XenForo_Autoloader::getInstance()->setupAutoloader($fileDir . '/library');

XenForo_Application::initialize($fileDir . '/library', $fileDir);
XenForo_Application::set('page_start_time', $startTime);

XenForo_Session::startPublicSession(new Zend_Controller_Request_Http);
$visitor = XenForo_Visitor::getInstance();

$userId = $visitor->getUserId();
$userName = $visitor['username'];

if ($userId) {
    $user = array();
    $user['from'] = 'XenForo';
    $user['id'] = $userId;
    $user['name'] = $userName;
    elfchat_auth($user);
} else {
    elfchat_go();
}