## Installation

Add the ServiceProvider to the providers array in config/app.php

```php
Belt\Notify\BeltNotifyServiceProvider::class,
```

```
# publish
php artisan belt-notify:publish
composer dumpautoload

# migration
php artisan migrate

# seed
php artisan db:seed --class=BeltNotifySeeder

# compile assets
npm run
```
