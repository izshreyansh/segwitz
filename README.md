[Get postman collection](https://www.getpostman.com/collections/0eb71b814414bb2aa40b)

#### How to set up the project
- Install composer dependencies
- copy .env.example to .env
- Update .sqlite path in the .env
- Run these commands:
  - ```php artisan migrate:fresh --seed```

Demo Admin, Clients and Contacts will be seeded.
Now you can make use of the postman collection in-order to test the api.

[Note: Please refer to the seeded dummy data in-order to get login credentials for both Admin & Client. Password is `password` for all accounts]
