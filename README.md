# Prototech-test

1. Clone repisitory

    `$ git clone https://github.com/maks-lukonin/prototech-test.git .`

2. Installing dependencies

    `$ composer install`

3. Create DB

4. Copy .env.example to .env

    `$ cp .env.example .env`

5. Config .env

    ```
    APP_NAME="Prototech-test"
    APP_ENV=production
    APP_DEBUG=false
    APP_URL=https://prototech.test

    DB_*
    ```

6. Generate key

    `$ php artisan key:generate`

7. Run migrations with seeds

    `$ php artisan migrate --seed`
