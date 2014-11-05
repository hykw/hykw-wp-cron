hykw-wp-cron
============

WordPress cron plugin

# Usage: 
    function func_hourly()
    {
        // some code
    }
    add_action(HYKWCRON_HOOK_HOURLY, 'func_hourly', 10);
  
    function func_twice()
    {
        // some code
    }
    add_action(HYKWCRON_HOOK_TWICEDAILY, 'func_twice', 10);

    function func_daily()
    {
        // some code
    }
    add_action(HYKWCRON_HOOK_DAILY, 'func_daily', 10);
