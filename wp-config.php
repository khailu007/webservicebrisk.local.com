<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', '3t_wp_webservice_theme_brisk' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'd@t@base' );

/** Database hostname */
define( 'DB_HOST', 'localhost:3316' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'wcr/BK]dlJX~!~CV*7Q@PK9kz,v.6$^ iMHH5}{5QG~52i.$D0C<Mu^/rJzt*zr-' );
define( 'SECURE_AUTH_KEY',  'HkkfFRbLODxaWHm{~rA}722!*>C2(/Ppx9f6`vlj=;Z<iU,U;=sYmOrv?)dwpxe~' );
define( 'LOGGED_IN_KEY',    '*0IK9VzL%o]EmXNLO?pt?nM)@64lXvD@Oe$6n*g8`x_*was&9A^,3H|fS{rvF2}4' );
define( 'NONCE_KEY',        'O9#1JQc(Z`cg{|M$00~1)h L|Tr7o,}bk:4T5H%~).d|1JG^tj3$?cqQf%1AH2CE' );
define( 'AUTH_SALT',        'bl5%dh`b%%Dbk^@:JYEJY*CWT|tvxZ(o2I_ {JN5oW-F~=FNdwl~STX_a>@>x[ri' );
define( 'SECURE_AUTH_SALT', 'vP =/_e3Ij=3fyk=Wv|.}|_|){sBZ[*ni}KNW|@f_MQlS{K$^Aw~FJD12Y>1c6KW' );
define( 'LOGGED_IN_SALT',   'FRe<L;eRjG{=]&b,6Aj]<!b:oKLT1woSI%=dRMV:.`1nK,oGh8oDwY23gPaMabvo' );
define( 'NONCE_SALT',       '$bQpugmco}DxT/zUSEG~EP@:@d*0em:k8G%hG~7TQE1X%,Dggyv<j){G~Yy0F$Ip' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



define( 'DUPLICATOR_AUTH_KEY', '=%5*x@C}W.ntc^!~G>NqS5MzrF;yPh+%Bha/HeNfy$>(KC=|9 Jo?hIM^6A#?uOF' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
