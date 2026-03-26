<?php
/**
 * One-time CLI: delete ALL comments (any status), comment meta, reset post counts, and close comments on posts.
 *
 * Usage (with Local / MySQL running):
 *   cd /path/to/wordpress/public
 *   php wp-content/themes/dogghouse-fct/script/delete-spam-comments.php
 *
 * Remove this file after running on production.
 *
 * @package dogghouse_fct
 */

if ( php_sapi_name() !== 'cli' ) {
	exit( 'CLI only.' );
}

$wp_root = dirname( __FILE__, 5 );
if ( ! is_readable( $wp_root . '/wp-load.php' ) ) {
	fwrite( STDERR, "Could not find wp-load.php at {$wp_root}\n" );
	exit( 1 );
}

require $wp_root . '/wp-load.php';

global $wpdb;

$total = (int) $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->comments}" );
echo "Comments found (all statuses): {$total}\n";

// Remove meta first, then comments (no FK in core, but safe order).
$meta_deleted = $wpdb->query( "DELETE FROM {$wpdb->commentmeta}" );
echo 'Comment meta rows deleted: ' . ( false === $meta_deleted ? '0' : (string) $meta_deleted ) . "\n";

$comments_deleted = $wpdb->query( "DELETE FROM {$wpdb->comments}" );
echo 'Comment rows deleted: ' . ( false === $comments_deleted ? '0' : (string) $comments_deleted ) . "\n";

$counts = $wpdb->query( "UPDATE {$wpdb->posts} SET comment_count = 0 WHERE comment_count != 0" );
echo 'Posts comment_count reset: ' . ( false === $counts ? '0' : (string) $counts ) . "\n";

// Close comments on existing content so the DB matches front-end policy.
$closed = $wpdb->query(
	$wpdb->prepare(
		"UPDATE {$wpdb->posts} SET comment_status = %s, ping_status = %s WHERE post_status IN ('publish','pending','draft','future','private')",
		'closed',
		'closed'
	)
);
echo 'Posts updated (comment/ping status closed): ' . ( false === $closed ? '0' : (string) $closed ) . "\n";

if ( function_exists( 'wp_cache_flush' ) ) {
	wp_cache_flush();
	echo "Object cache flushed.\n";
}

echo "Done.\n";
