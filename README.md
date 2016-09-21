# uuid
Add some basic uuid funtionality to eloquent models.

### Installation
Add this repo to `composer.json`

```json
"require": {
  "rdelorier/uuid": "dev-master"
},
"repositories": [
  {
    "type": "vcs",
    "url":  "git@github.com:RDelorier/uuid.git"
  }
]
```

Then run update to install
```composer update```

Next use the trait on any model you want to have a uuid
```php
<?php

use Codesmith\Eloquent\Uuid\HasUuid;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasUuid;
}
```

And of course don't forget to add the field to your table migration
```php
$table->uuid('uuid')->index();
```

Now you can use the uuid to generate your routes
```php
Route::resource('users', 'UserController');

// generate url using route helper
$url = route('users.show', App\User::first());
// == http://app.dev/users/15734274-7f3b-11e6-aa8b-60f81db6e9e6
```

I'm sure eventually this will get a real release...
