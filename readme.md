# Twitter API SPA

## Overview

- A small web app using Vue.js on the the frontend and Laravel on the backend
- Uses the Twitter API to get 5 of the latest tweets from a users’ timeline with their screen name. 
- The frontend is set to auto refresh (update new tweets) every 3 minutes.

## Requirements

- PHP >= 7.1.3
- BCMath PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- NPM/Node
- composer

## Development

### Laravel

You can use the following “composer” command to install the necessary laravel modules. 
<code>
composer install
</code>

If you have PHP installed locally and you would like to use PHP's built-in development server to serve your application, you may use the serve Artisan command.  
This command will start a development server at http://localhost:8000:  
<code>
php artisan serve
</code>

### Vue.js
You can use the following commands to check the current version of Node js and NPM.  
<code>
// Node js Version  
node -v  
// NPM Version  
npm -v
</code>

You can use the following “npm” command to install the necessary node modules.  
<code>
npm install
</code>

You can use the following NPM command to track the changes and compile the components and other required files.  
<code>
npm run watch
</code>

## Testing 

You can run your PHPUnit tests by running the phpunit command:  
<code>
./vendor/bin/phpunit
</code>
