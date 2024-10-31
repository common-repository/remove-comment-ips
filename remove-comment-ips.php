<?php
/*
Plugin Name: Remove Comment IPs
Plugin URI:  https://www.ctrl.blog/entry/remove-comment-ip-wordpress-plugin
Description: Removes the IP address of comment authors after 2 months.
Version:     1.0.2
Author:      Geeky Software
Author URI:  https://www.ctrl.blog/topic/wordpress
License:     GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

if (!defined('ABSPATH')) {
  header('HTTP/1.1 403 Forbidden');
  exit(  'HTTP/1.1 403 Forbidden');
}

function remove_comment_ip($comment_id) {
  $comment = get_comment($comment_id, ARRAY_A);
  if (empty($comment)) {
    return FALSE;
  }
  $comment['comment_author_IP'] = '0';  // 'unspecified address'
  wp_update_comment($comment);
}
add_action('remove_comment_ip_handle', 'remove_comment_ip', 10, 1);

function remove_comment_ip_schedule_future_processing($comment_id, $comment_approved) {
  $days = intval(apply_filters('remove_comment_ip_days_to_deletion', 60));
  if ($days < 0)
    $days = 60;
  elseif ($days == 0)
    $seconds = 60;
  else
    $seconds = $days * 24 * 60 * 60;
  wp_schedule_single_event(time() + $seconds, 'remove_comment_ip_handle', array($comment_id));
}
add_action('comment_post', 'remove_comment_ip_schedule_future_processing', 10, 2);

if (is_admin()) {
  // Remove all comment IPs six hours after the plugin is activated.
  if (get_option('remove_comment_ips_firstrun', '0') == '0') {
    update_option('remove_comment_ips_firstrun', '1');
    $comments = get_comments(array());
    $delay = 21600;  // 6 hours
    foreach($comments as $comment) {
      wp_schedule_single_event(time() + $delay, 'remove_comment_ip_handle', array($comment->comment_ID));
      $delay += 6;
  } }

  function remove_comment_ips_deactivate() {
    // unscheduled every possibly scheduled task.
    $comments = get_comments(array());
    foreach($comments as $comment) {
      wp_clear_scheduled_hook('remove_comment_ip_handle', array($comment->comment_ID));
  } }
  register_deactivation_hook(__FILE__, 'remove_comment_ips_deactivate');
}

?>
