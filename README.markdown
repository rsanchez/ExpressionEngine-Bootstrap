# EE Bootstrap

This file "bootstraps" the EE environment, so you use the `ee()` function to access the instance.

Useful for little one off scripts, or cron jobs that need access to the EE environment.

Example:

```
<?php
$system_path = '/path/to/system/folder';
include '/path/to/bootstrap-ee2.php';

// cron job to close status of entries older than one year
ee()->db->where(‘entry_date <‘, now() - (365*24*60*60))
        ->update(‘channel_titles’, array(‘status’ => ‘closed’));
```

## Older versions
- [v1.0.0 - For EE 2.1.3-2.6.1](https://github.com/rsanchez/ExpressionEngine-Bootstrap/tree/v1.0.0)
- [v1.1.0 - For EE 2.7.0-2.7.3](https://github.com/rsanchez/ExpressionEngine-Bootstrap/tree/v1.1.0)
