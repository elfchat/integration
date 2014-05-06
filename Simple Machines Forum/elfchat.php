<?php
define('ELFCHAT_CHARSET', 'windows-1251'); // Your site charset
#COMMON


// Get everything started up...
define('SMF', 1);
@set_magic_quotes_runtime(0);
error_reporting(E_ALL);
$time_start = microtime();

// Make sure some things simply do not exist.
foreach (array('db_character_set') as $variable)
	if (isset($GLOBALS[$variable]))
		unset($GLOBALS[$variable]);

// Load the settings...
require_once(dirname(__FILE__) . '/Settings.php');

// Make absolutely sure the cache directory is defined.
if ((empty($cachedir) || !file_exists($cachedir)) && file_exists($boarddir . '/cache'))
	$cachedir = $boarddir . '/cache';

// And important includes.
require_once($sourcedir . '/QueryString.php');
require_once($sourcedir . '/Subs.php');
require_once($sourcedir . '/Errors.php');
require_once($sourcedir . '/Load.php');
require_once($sourcedir . '/Security.php');

// Using an pre-PHP5 version?
if (@version_compare(PHP_VERSION, '5') == -1)
	require_once($sourcedir . '/Subs-Compat.php');

// If $maintenance is set specifically to 2, then we're upgrading or something.
if (!empty($maintenance) && $maintenance == 2)
	db_fatal_error();

// Create a variable to store some SMF specific functions in.
$smcFunc = array();

// Initate the database connection and define some database functions to use.
loadDatabase();

// Load the settings from the settings table, and perform operations like optimizing.
reloadSettings();
// Clean the request variables, add slashes, etc.
cleanRequest();
$context = array();




// Register an error handler.
set_error_handler('error_handler');

// Start the session. (assuming it hasn't already been.)
loadSession();

// What function shall we execute? (done like this for memory's sake.)
call_user_func(smf_main());


// The main controlling function.
function smf_main()
{
	global $modSettings, $settings, $user_info, $board, $topic, $maintenance, $sourcedir;

	// Load the user's cookie (or set as guest) and load their settings.
	loadUserSettings();

	// Load the current theme.  (note that ?theme=1 will also work, may be used for guest theming.)
	loadTheme();

	// Check if the user should be disallowed access.
	is_not_banned();
}

if(!$context['user']['is_guest'])
{
    $query = array();
    $query['from'] = 'SMF';
    $query['id'] = $context['user']['id'];
    $query['name'] = $context['user']['name'];
    elfchat_auth(elfchat_convert($query, ELFCHAT_CHARSET));
}
else
{
    elfchat_go();
}