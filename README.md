# Forum Application

## A fully functional Forum project written in Laravel and Javascript!

The goal project are the next list of things:

- Create data with seeders to the next:
    - 1000 users
    - 10000 post
    - 5 response to every post 
- Allow manage authentication with login and register functionality
- Allow show/hide the buttons add post and add response depends of the role of the user

## How to install this Forum project follow the next steps

1. install docker locally
2. clone this repository
3. open the terminal and the root folder of the project to run the next commands
3. composer install
4. npm i
5. cp .env.example .env
6. set the env variables in the file .env
6. docker-compose up -d --force-recreate
7. ./vendor/bin/sail up -d
7. ./vendor/bin/sail artisan migrate:fresh --seed
8. npm run dev