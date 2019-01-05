# Laravue TodoApp
A Simple Todo App build on Laravel and Vuejs including BootstrapCSS.

### Running this app
- clone this repo or just the zip from the above green button.

- Make sure you have [composer](https://getcomposer.org/) installed for laravel and [nodejs](https://nodejs.org/en/) for npm.

- Rename **.env.example** to **.env** and add your database and mail credentials.

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

- compile javascript assets.
```bash
    npm run dev
```

- or replace **dev** with **watch**. if you want it to keep watching for changes.

- Generate JWT Secret for API authentication.
```bash
    php artisan jwt:secret
```

- you can create a virtual host with Apache or just run this command to run dev server (PHP's default server).
```bash
    php artisan serve
```

## Features
- Todos CRUD (Create, Read, Update, and Delete).
- Simple Pagination.
- Validation.
- Flash Messages with [vue-flash-message](https://github.com/keen-on-design/vue-flash-message).
- Display Loader before fetching todos.
- JWT API Authentication with [auth-jwt](https://github.com/tymondesigns/jwt-auth).
- Reset Password Email.
