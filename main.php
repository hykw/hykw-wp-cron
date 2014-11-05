<?php
/**
 * @package HYKW cron plugin
 * @version 1.0.0
 */
/*
  Plugin Name: HYKW cron plugin
  Plugin URI: https://github.com/hykw/hykw-wp-cron
  Description: WordPress の cron 用プラグイン
  Author: hitoshi-hayakawa
  Version: 1.0.0
*/

define('HYKWCRON_HOOK_HOURLY', 'HYKWCRON_HOOK_HOURLY');
define('HYKWCRON_HOOK_TWICEDAILY', 'HYKWCRON_HOOK_TWICEDAILY');
define('HYKWCRON_HOOK_DAILY', 'HYKWCRON_HOOK_DAILY');

define('HYKWCRON_HOOK_5SEC', 'HYKWCRON_HOOK_5SEC'); // for DEBUG
define('HYKWCRON_INT_5SEC', '5sec');

# TRUE = DEBUG on
define('HYKWCRON_IS_DEBUG', TRUE);


# http://codex.wordpress.org/Function_Reference/wp_schedule_event

# wp-cron start
function hykwcron_cronStart()
{
  if (!wp_next_scheduled(HYKWCRON_HOOK_HOURLY))
    wp_schedule_event(time(), 'hourly', HYKWCRON_HOOK_HOURLY);

  if (!wp_next_scheduled(HYKWCRON_HOOK_TWICEDAILY))
    wp_schedule_event(time(), 'twicedaily', HYKWCRON_HOOK_TWICEDAILY);

  if (!wp_next_scheduled(HYKWCRON_HOOK_DAILY))
    wp_schedule_event(time(), 'daily', HYKWCRON_HOOK_DAILY);


  ### DEBUG
  if (HYKWCRON_IS_DEBUG) {
    if (!wp_next_scheduled(HYKWCRON_HOOK_5SEC))
      wp_schedule_event(time(), HYKWCRON_INT_5SEC, HYKWCRON_HOOK_5SEC);
  }
}
register_activation_hook(__FILE__, 'hykwcron_cronStart');

# wp-cron stop
function hykwcron_cronStop()
{
  wp_clear_scheduled_hook(HYKWCRON_HOOK_HOURLY);
  wp_clear_scheduled_hook(HYKWCRON_HOOK_TWICEDAILY);
  wp_clear_scheduled_hook(HYKWCRON_HOOK_DAILY);

  wp_clear_scheduled_hook(HYKWCRON_HOOK_1SEC);
}
register_deactivation_hook(__FILE__, 'hykwcron_cronStop');


function hykwcron_add_interval($schedules)
{
  $schedules[HYKWCRON_INT_5SEC] = array(
      'interval' => 5,
      'display' => __('every 5 seconds'),
  );
  return $schedules;
}
add_filter('cron_schedules', 'hykwcron_add_interval');
