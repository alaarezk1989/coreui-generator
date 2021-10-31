
## Installation

Clone Repository

`git clone `

Move to the newly created directory

`cd .apis`

Create a new .env file from .env.example

`cp .env.example .env`

Now edit your .env file and set your env parameters (Specially the database username/pass, database name)

Install dependencies

`composer install`

Generate a new key for your app

`php artisan key:generate`

Reload Database

`php artisan migrate:refresh --seed`

Done, You're ready to go

`php artisan serve`
