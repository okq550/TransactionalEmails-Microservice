# TransactionalEmails-Microservice

Transactional email microservice - code challenge

To setup, Please follow the steps below:

1) docker-compose up -d
2) docker-compose exec php /var/www/html/artisan migrate
3) docker-compose exec php /var/www/html/artisan db:seed
4) docker-compose exec php /var/www/html/artisan queue:work

- You can find the logs under: src/storage/logs/
- You can make the tests using: docker-compose exec php /var/www/html/vendor/bin/phpunit
- You can also import the postman collection: https://www.getpostman.com/collections/386787cfbfdae90158d2

**Please contact me to get the .env file which contains some credentails.

Thanks.