<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

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
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code






defined('PAYTM_ENVIRONMENT')  OR define('PAYTM_ENVIRONMENT', 'TEST');

defined('PAYTM_MERCHANT_KEY')  OR define('PAYTM_MERCHANT_KEY', '6yWsyojKo_eZ!D!X'); //Change this constant's value with Merchant key received from Paytm.

defined('PAYTM_MERCHANT_MID')  OR define('PAYTM_MERCHANT_MID', 'JzFDZR81757624590956'); //Change this constant's value with MID (Merchant ID) received from Paytm.

defined('PAYTM_MERCHANT_WEBSITE')  OR  define('PAYTM_MERCHANT_WEBSITE', 'WEBSTAGING'); //Change this constant's value with Website name received from Paytm.

$PAYTM_STATUS_QUERY_NEW_URL='https://securegw-stage.paytm.in/order/status';
$PAYTM_TXN_URL='https://securegw-stage.paytm.in/order/process';
if (PAYTM_ENVIRONMENT == 'PROD') {
	$PAYTM_STATUS_QUERY_NEW_URL='https://securegw.paytm.in/merchant-status/getTxnStatus';
	$PAYTM_TXN_URL='https://securegw.paytm.in/theia/processTransaction';
}

defined('PAYTM_REFUND_URL')  OR define('PAYTM_REFUND_URL', '');
defined('PAYTM_STATUS_QUERY_URL')  OR define('PAYTM_STATUS_QUERY_URL', $PAYTM_STATUS_QUERY_NEW_URL);
defined('PAYTM_STATUS_QUERY_NEW_URL')  OR define('PAYTM_STATUS_QUERY_NEW_URL', $PAYTM_STATUS_QUERY_NEW_URL);
defined('PAYTM_TXN_URL')  OR define('PAYTM_TXN_URL', $PAYTM_TXN_URL);



/*
|--------------------------------------------------------------------------
| Mail server details
|--------------------------------------------------------------------------
|
| Mail server details
*/


defined('PROTOCOL') OR define('PROTOCOL', 'smtp');
defined('SMTP_HOST') OR define('SMTP_HOST', 'mail.ludobattles.com');
defined('SMTP_PORT') OR define('SMTP_PORT', '26');
defined('SMTP_USER') OR define('SMTP_USER', 'admin@ludobattles.com');
defined('SMTP_PASS') OR define('SMTP_PASS', 'password@98');
defined('EMAIL_FROM') OR define('EMAIL_FROM', 'admin@ludobattles.com');
defined('FROM_NAME') OR define('FROM_NAME', 'LudoBattles');
// defined('PAYMENT_SUBJECT') OR define('PAYMENT_SUBJECT', 'Thank You for your Payment!');


/*
|--------------------------------------------------------------------------
| Mail Method
|--------------------------------------------------------------------------
|
| Mail Method
|
*/

defined("MAIL_METHOD") OR define("MAIL_METHOD", "server");





/*
|--------------------------------------------------------------------------
| paykun merchand id and access id
|--------------------------------------------------------------------------
|
| paykun merchand id and access id
|
*/

// defined("﻿Access_Token") OR define("﻿Access_Token", "13111BA75386AB627FE9EC98A58EDE3E");
// defined("API_Secret") OR define("API_Secret", "BF5EFBB066D8DE00ACAA7D33A95758FB");
// defined("PAYKUN_MERCHANT_MID") OR define("PAYKUN_MERCHANT_MID", "254830991914160");


defined("﻿Access_Token") OR define("﻿Access_Token", "4AEAA9844FB2C3FAE8225C93C5CA3A9D");
defined("API_Secret") OR define("API_Secret", "1B1FD77298BA993F47C1BC6FE1A17765");
defined("PAYKUN_MERCHANT_MID") OR define("PAYKUN_MERCHANT_MID", "544771114566593");

defined("Admin_email") OR define("Admin_email", "ajaysah531@gmail.com");