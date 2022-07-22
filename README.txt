This is a bus booking app where a user can:

1) Register/Login using email and password.

2) Get available seats for a trip from a certain start point to end point (cities in Egypt).

3) Book an available seat on a certain bus that goes from a certain start point to end point.


------------------------------------------------------------------------------------------------------------------------------

The functionality in this application is as follows:

1) User has to register or login to be able to get available seats and book a seat using a JWT Token that is provided when user logs in or register.

2) User must provide start and end point of the trip they want to go on and they must be valid cities in Egypt (Cairo,Fayum,Minya,Alexandria,Tanta,Luxor,Ismailia,Asyut,Qina,Giza)

3) When booking a seat, User must provide a valid seat id that was not booked before and this seat must be on a bus going through the start and end point that the user provided.

4) When booking a seat, the bus must contain an available seat for all the cross overs from the start to end point,

    for example: if user wants a trip from Cairo to Minya on a bus that goes through (Cairo - Fayum - Minya - Asyut), there must be an
    available seat from (Cairo-Fayum), (Cairo-Minya) , (Fayum-Minya). If there is no available seat for (Fayum-Minya) for example then
    user cannot book for the whole trip (Cairo - Minya).

 5) When user books a seat for a trip,one seat is booked but an available seat is decremented from all trips that cross over the start and end point.

     for example: If a user booked a seat from (Cairo-Minya) with id 2 on bus 3 that goes through (Cairo - Fayum - Minya - Asyut), the trips (Cairo-Fayum), (Cairo-Minya) , (Fayum-Minya)
     on bus 3 will be decremented by one because this user will need a seat through all these trips not just from (Cairo-Minya).

 -------------------------------------------------------------------------------------------------------------------------------------------------------------

The data provided in the database is as follows:

Bus one : (Cairo - Fayum - Minya - Asyut) , 12 seats available

Bus two : (Alexandria - Tanta - Luxor - Giza) , 12 seats available

Bus three : (Ismailia - Tanta - Luxor - Qina) , 12 seats available


--------------------------------------------------------------------------------------------------------------------------------------------------------

The relational database (MYSQL) is structured as follows:

1) users table : name,email,password

2) busses table: id,start_point,end_point

3) trips table(to save cross over trips in the bus with their order): id,start_point,end_point,start_point_order,end_point_order,bus_id (referencing busses table),available_seats (initially 12)

4) seats table :id,bus_id (references busses table),user_id (references users table,NULL when not booked),booked (flag to know if this seat is reserved or not,initially 0)


-------------------------------------------------------------------------------------------------------------------------------------------------------------------

This application was made using Laravel framework,MySQL database,REST APIs,Eloquent ORM to access database, MVC structure.

To start up the application,kindly follow the following steps:

1) run 'composer install' to install all dependencies needed

2) create .env file (copy contents of .env.example as reference) and insert your local database credentials like this:
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=123456


3) run 'php artisan migrate' to create tables needed for project.

4) run 'php artisan db:seed' to populate database with initial data (you can also use import.sql as a dump file for database provided in repo)

5) run 'php artisan jwt:secret' to create jwt secret key (for authentication) that will be saved automatically in .env file

6) to start server, run 'php artisan serve' that will run on : http://127.0.0.1:8000

7) APIs for this project:

  1) register: http://127.0.0.1:8000/api/register
  2) login: http://127.0.0.1:8000/api/login
  3) get available seats: http://127.0.0.1:8000/api/seats
  4) book a seat: http://127.0.0.1:8000/api/book/{id}

 ** You must provide bearer token for apis (3,4) that you will get from registering or logging in

 ** Kindly use the postman collection provided in this repo as a reference to make it easier to use the apis.
