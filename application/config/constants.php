<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


// Define Ajax Request
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
//

define('TABLE_TRUCK_INFO',         'truckinfo');
define('TABLE_TRUCK_INFO_HIS',     'truckinfohis');
define('TABLE_SYSTEM_USER',        'systemuser');
define('TABLE_SYSTEM_USER_HIS',    'systemuserhis');
define('TABLE_SYSTEM_MENU',        'systemmenu');
define('TABLE_SYSTEM_MENU_RIGHTS', 'systemmenurights');
define('TABLE_SYSTEM_CODE',        'systemcode');
define('TABLE_SYSTEM_ROLE',        'systemrole');
define('TABLE_ROLE_MENU_RIGHTS',   'rolemenurights');
define('TABLE_SYSTEM_USER_ROLE',   'systemuserrole');
define('TABLE_DRIVER_LOCATION',    'driverlocation');
define('TABLE_DRIVER_LOCATION_RT', 'driverlocationrt');
define('TABLE_FREIGHT_SOURCE',     'freightsource');
define('TABLE_FREIGHT_SOURCE_HIS', 'freightsourcehis');
/* End of file constants.php */
/* Location: ./application/config/constants.php */