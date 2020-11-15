# TransactionalEmails-Microservice

Transactional email microservice - code challenge

Stack used:
- Web server: Nginx: can work as web server as well as LB.
- Application: Lumen Framework: for this microservice for this challenge because it has all the needed functionalities such as api, queues, validations etc.
- DB: MySQL 5.7.

Logic used in this exercise is to follow the prioroty saved in database, As as start we will send the email using the channel with priority 1, then increased by if the channel is inActive or failed in sending the email using that service.

To setup, Please follow the steps below:

1) docker-compose up -d (Once the composer install all modules then continue)
2) docker-compose exec php /var/www/html/artisan migrate
3) docker-compose exec php /var/www/html/artisan db:seed
4) docker-compose exec php /var/www/html/artisan queue:work

To use the CLI command:
1) docker-compose exec php /var/www/html/artisan takeaway:list-channels
2) docker-compose exec php /var/www/html/artisan takeaway:send-email

- You can find the logs under: src/storage/logs/
- You can make the tests using: docker-compose exec php /var/www/html/vendor/bin/phpunit
- You can also import the postman collection: https://www.getpostman.com/collections/386787cfbfdae90158d2

**Feel free to change the third party credentials in .env file.
**Play with the isActive flag to enable/disable a channel.


**NOTE: Emails sent through sendGrid are being processed for a long time in the mail service provider side. May there are some constrains which cause this.
Please try MailJet as first.
Thanks.

#TODO (Enhancements):
1) Handling multi locales for emails content.
2) Trying the to send the email using the same provider multiple times before moving on to the next provider.
3) Triggering some events to main events stram to ping about that email sending status.
4) Adding failure counts/logs to monitor the providers services and take any needed action.
5) Adding an admin tool to add/edit the templates emails or adding a new action (Order places, purchase notifications, etc...) which can use this micro-service.