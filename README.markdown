# EE Bootstrap

This file "bootstraps" the EE environment, so you use the `ee()` function to access the instance.

Useful for little one off scripts, or cron jobs that need access to the EE environment.

Example:

```
<?php
$system_path = '/path/to/system/folder';
include '/path/to/bootstrap-ee2.php';

// cron job to close status of entries older than one year
ee()->db->where('entry_date <', now() - (365*24*60*60))
        ->update('channel_titles', array('status' => 'closed'));
```

## Using with composer

```
composer require eecli/bootstrap ~1.2
```

```
<?php
$system_path = '/path/to/system/folder';
include 'vendor/eecli/bootstrap/bootstrap-ee2.php';
```