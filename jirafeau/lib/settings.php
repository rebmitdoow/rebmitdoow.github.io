<?php
/*
 *  Jirafeau, your web file repository
 *  Copyright (C) 2008  Julien "axolotl" BERNARD <axolotl@magieeternelle.org>
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as
 *  published by the Free Software Foundation, either version 3 of the
 *  License, or (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

global $cfg;

// Read config files
require(JIRAFEAU_ROOT . 'lib/config.original.php');
if (file_exists(JIRAFEAU_ROOT . 'lib/config.local.php')) {
    // read local copy and merge with original values
    $cfgOriginal = $cfg;
    require(JIRAFEAU_ROOT . 'lib/config.local.php');
    $cfg = array_merge($cfgOriginal, $cfg);
    unset($cfgOriginal);
}

// Setup debug mode
if ($cfg['debug'] === true) {
    @error_reporting(E_ALL);
} else {
    @error_reporting(0);
}


// Set constants

/* Jirafeau package */
define('JIRAFEAU_PACKAGE', 'Jirafeau');
define('JIRAFEAU_VERSION', '4.4.0');

/* Directories. */
define('VAR_FILES', $cfg['var_root'] . 'files/');
define('VAR_LINKS', $cfg['var_root'] . 'links/');
define('VAR_ASYNC', $cfg['var_root'] . 'async/');

// helping variable to build absolute link to
// root of the domain without handling the URL scheme
$absPrefix = parse_url($cfg['web_root'], PHP_URL_PATH);
if (true === empty($absPrefix)) {
    // fallback if installation isn't done yet: relative links to same level on the current page
    $absPrefix = './';
}
define('JIRAFEAU_ABSPREFIX', $absPrefix);

/* Useful constants. */
if (!defined('NL')) {
    define('NL', "\n");
}
if (!defined('QUOTE')) {
    define('QUOTE', "'");
}

define('JIRAFEAU_INFINITY', -1);
define('JIRAFEAU_MINUTE', 60); // 60
define('JIRAFEAU_HOUR', 3600); // JIRAFEAU_MINUTE * 60
define('JIRAFEAU_DAY', 86400); // JIRAFEAU_HOUR * 24
define('JIRAFEAU_WEEK', 604800); // JIRAFEAU_DAY * 7
define('JIRAFEAU_FORTNIGHT', 1209600); // JIRAFEAU_WEEK * 2
define('JIRAFEAU_MONTH', 2592000); // JIRAFEAU_DAY * 30
define('JIRAFEAU_QUARTER', 7776000); // JIRAFEAU_DAY * 90
define('JIRAFEAU_YEAR', 31536000); // JIRAFEAU_DAY * 365

// set UTC as default timezone for all date/time functions
date_default_timezone_set('UTC');
