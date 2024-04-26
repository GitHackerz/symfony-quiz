# Random Symfony Quiz App

This is a simple Symfony 5 application that allows users to take a quiz and get a score at the end.

## Installation

1. Clone the repository 
2. Duplicate the `local.env` file and rename it to `.env`
3. Replace the `DATABASE_URL` value with your database credentials
4. Replace the `MAILER_DSN` value with your mailer credentials
5. Replace the `TWILIO_DSN` value with your Twilio credentials
6. Run `composer install`
7. Run `symfony console doctrine:database:create` (remove the existed database or rename it)
8. Run `symfony console make:migration`
9. Run `symfony console doctrine:migrations:migrate`
10. Run `npm install`
11. Run `npm run build`
12. Run `symfony serve`
13. Visit **http://localhost:8000** in your browser
14. Enjoy!