<?php
/**
 * Comments template (disabled site-wide — see dogghouse_fct_disable_public_comments in functions.php).
 *
 * Kept so WordPress does not fall back to a parent theme; outputs nothing.
 *
 * @package dogghouse_fct
 */

if ( post_password_required() ) {
	return;
}
