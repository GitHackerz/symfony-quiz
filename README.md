# Random Symfony Quiz App

This is a simple Symfony 5 application that allows users to take a quiz and get a score at the end.

## Installation

1. Clone the repository 
2. Run `composer install`
3. Run `symfony console doctrine:database:create` (remove the existed database or rename it)
4. Run `symfony console make:migration`
5. Run `symfony console doctrine:migrations:migrate`
6. Run `npm install`
7. Run `npm run build`
8. Run `symfony serve`
9. Visit `localhost:8000` in your browser
10. Enjoy!