<?php
define('ELFCHAT_CHARSET', 'windows-1251'); // Your site charset
#COMMON


// Set flag that this is a parent file.
define('_JEXEC', 1);
define('DS', DIRECTORY_SEPARATOR);

if(file_exists(dirname(__FILE__) . '/defines.php'))
{
    include_once dirname(__FILE__) . '/defines.php';
}

if(!defined('_JDEFINES'))
{
    define('JPATH_BASE', dirname(__FILE__));
    require_once JPATH_BASE . '/includes/defines.php';
}

require_once JPATH_BASE . '/includes/framework.php';

// Mark afterLoad in the profiler.
JDEBUG ? $_PROFILER->mark('afterLoad') : null;

// Instantiate the application.
$app = JFactory::getApplication('site');

// Initialise the application.
$app->initialise();

$user = JFactory::getUser();

if($user->id != 0)
{
    $query = array();
    $query['from'] = 'Joomla';
    $query['id'] = $user->id;
    $query['name'] = $user->username;
    elfchat_auth(elfchat_convert($query, ELFCHAT_CHARSET));
}
else
{
    elfchat_go();
}


