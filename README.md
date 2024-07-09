# Rest API Authentication Using JWT 
This is an implementation of Laravel Rest API Authentication Using JWT. 

## Installation

### Composer Packages 
```
composer install
```

## Configuration

### Create `.env` file from `.env.example`
```
cp .env.example .env
```

### Generate Laravel App Key
```
php artisan key:generate
```

### Database Integration
1. Create a database and connect it with Laravel with filling the DB name in `DB_DATABASE`
2. Adjust `DB_USERNAME`
3. Adjut `DB_PASSWORD`

### Migrate the Database Migration
```
php artisan migrate
```

### Publish JWT Auth Config
```
php artisan vendor:publish --provider="PHPOpenSourceSaver\JWTAuth\Providers\LaravelServiceProvider"
```

### Generate JWT Auth Secret Key
```
php artisan jwt:secret
```

This will update your `.env` file with something like `JWT_SECRET=foobar`

## Run App
```
php artisan serve
```
