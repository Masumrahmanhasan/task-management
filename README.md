
## Installation

- Clone the repo run `composer install`
- run `php artisan passport:install`
- Copy `.env.example` to `.env`
- run `npm install`
- set up database and run `php artisan migrate`
- run `php artisan db:seed` for dummy data

## api endpoints

- `POST /api/register` - register a user
- `POST /api/login` - login a user
- `GET /api/categories` - get categories details
- `GET /api/categories/{id}` - get category details
- `POST /api/categories` - create a category
- `PUT /api/categories/{id}` - update a category
- `DELETE /api/categories/{id}` - delete a category
- `GET /api/articles` - get articles list
- `GET /api/articles/{id}` - get article details
- `POST /api/articles` - create an article
- `PUT /api/articles/{id}` - update an article
- `DELETE /api/articles/{id}` - delete an article

## Postman Collection

- https://elements.getpostman.com/redirect?entityId=29988813-db5fcc55-3eb3-459d-a7fc-e08d4e4537ba&entityType=collection
