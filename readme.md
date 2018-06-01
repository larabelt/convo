## Installation

Add the ServiceProvider to the providers array in config/app.php

```php
Belt\convo\BeltconvoServiceProvider::class,
```

```
# publish
php artisan belt-convo:publish
composer dumpautoload

# migration
php artisan migrate

# seed
php artisan db:seed --class=BeltconvoSeeder

# compile assets
npm run
```
