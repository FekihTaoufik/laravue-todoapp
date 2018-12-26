# Laravue
Full stack laravel and vuejs articles app with bootstrapCSS.

### Running this app
- clone this repo or just zip from the above green button.

- Make sure you have [composer](https://getcomposer.org/) installed for laravel and [nodejs](https://nodejs.org/en/) for npm.

- Rename .env.example to .env and add your database and mail credentials.

- Install laravel dependencies.
```bash
    composer install
```

- install javascript dependencies.
```bash
    npm install
```

- Generate Application Key.
```bash
    php artisan key:generate
```
- create tables.
```bash
	php artisan migrate
```

- compile javascript assets
```bash
    npm run dev
```

- or replace **dev** with **watch**. if you want it to keep watching for changes.

- you can create a virtual host or just run this command to run dev server
```bash
    php artisan serve
```
