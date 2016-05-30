<?php
/**
 * Default config settings
 *
 * Enter any WordPress config settings that are default to all environments
 * in this file. These can then be overridden in the environment config files.
 *
 * Please note if you add constants in this file (i.e. define statements)
 * these cannot be overridden in environment config files.
 *
 * @package    Studio 24 WordPress Multi-Environment Config
 * @version    1.0
 * @author     Studio 24 Ltd  <info@studio24.net>
 */


/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '+r&Ljr|)nL1i4@M3,T=ME=8hxh65Hb:a2Xd=*.N*@^bRy`5pF-I0W*8z]hMG+EEb');
define('SECURE_AUTH_KEY',  'qL:0jED2nTX0;Y&mL3<|1CFl2p-:khHBU-$tz3-XIfxqQ*|BV3m.:24+:x#+I@-q');
define('LOGGED_IN_KEY',    'Aa#~q4?Fo@w-,HibF~sz%5mtQ6Kg8P 2QzY{bd|3@5h|vuU![1)+ZS45]X2or@ZG');
define('NONCE_KEY',        ' ]et_* J,=|J()q{P/Kz2t:n&QsGyLUW<U9J33K)pHc6d8+t4RW-a]pt|^_GQyL9');
define('AUTH_SALT',        'd+TGWq;|~@V~cUR4M0l,I]ee+eq2U0F-g4sy1dMw;gZ([S;}mx(GwM&0<6j5*XRp');
define('SECURE_AUTH_SALT', 'ao]?v881}D-<|L53}uN1o=. P[K,%|+~*DJfO7RFfH61k@}.Su&<Zuw)$y!9+ /X');
define('LOGGED_IN_SALT',   ']YO6DvwsQXO304 =+8K~Lv;rH/Af/Is<,epow02o630mhR38_u*P`7bydljG7Z}m');
define('NONCE_SALT',       'whX[QZw3om@(ayp:Xw6unOn8}^|$]iU/8F!vCL+lED~w} [3`@/-#A-HEibPN!l#');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * Increase memory limit.
 */
define('WP_MEMORY_LIMIT', '64M');