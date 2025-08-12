# ROLO-Deck

## Stack
* Laravel 12
* Livewire 3
* AlpineJs
* PHPUnit

## Getting started
```
clone existing_repo
git clone git@github.com:aanimation/rolodeck.git
```

## Prepare
```
cd rolodeck
composer install
npm install
```

Prepare a database credential within database name, username and password
for next env
```
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

## Setup
```
copy .env.example to .env file

php artisan key:generate
php artisan migrate --seed
php artisan storage:link
```

## Assets
```
npm run dev
```

Happy Never Ending !!!