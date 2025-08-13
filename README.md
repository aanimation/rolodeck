# ROLO-Deck
* Laravel 12
* Livewire 3 + AlpineJs
* Stripe Webhook

## Prepare
Prepare a mysql/postgres database credential within database name, username and password

```
clone existing_repo
git clone git@github.com:aanimation/rolodeck.git

cd rolodeck
copy .env.example to .env file

composer install
php artisan key:generate
php artisan migrate --seed
php artisan storage:link

npm install
npm run dev

php artisan serve
```

## Sitemap
* products, product, cart, checkout
* login (Admin Dashboard)

## Notes
Stripe responses : [Rolodeck Sheet](https://docs.google.com/spreadsheets/d/1YlHNlranPeBvGwRQhM6HI7WoqIaysjJSHRb7dRKMjZc/)

Cheers !!!

Arham Arifuddin