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

# http://codex.wordpress.org/Function_Reference/wp_schedule_event

# wp-cron start
function hykwcron_cronStart()
{
  wp_schedule_event(time(), 'hourly', 'HYKWCRON_HOOK_HOURLY');
  wp_schedule_event(time(), 'twicedaily', 'HYKWCRON_HOOK_TWICEDAILY');
  wp_schedule_event(time(), 'daily', 'HYKWCRON_HOOK_DAILY');
}
register_activation_hook(__FILE__, 'hykwcron_cronStart');

# wp-cron stop
function hykwcron_cronStop()
{
  wp_clear_scheduled_hook('HYKWCRON_HOOK_HOURLY');
  wp_clear_scheduled_hook('HYKWCRON_HOOK_TWICEDAILY');
  wp_clear_scheduled_hook('HYKWCRON_HOOK_DAILY');
}
register_deactivation_hook(__FILE__, 'hykwcron_cronStop');


# Do action
function hykwcron_do_hourly() {
  do_action(HYKWCRON_HOOK_HOURLY);
}
function hykwcron_do_twicedaily() {
  do_action(HYKWCRON_HOOK_TWICEDAILY);
}
function hykwcron_do_daily() {
  do_action(HYKWCRON_HOOK_DAILY);
}
add_action('HYKWCRON_HOOK_HOURLY','hykwcron_do_hourly');
add_action('HYKWCRON_HOOK_TWICEDAILY','hykwcron_do_twicedaily');
add_action('HYKWCRON_HOOK_DAILY','hykwcron_do_daily');
