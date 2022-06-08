<p align="center"><img src="/public/images/logo-transparent.png" width="400"></p>

## About Project

This is a web application created in Laravel framework. The app is designed with intention to replicate ticketing systems. 

When registering, user chooses their role in the company (agent/technician) and based on the role either communicates with customers and opens tickets to assign them to technicians or sees a preview of assigned tickets and when finished, marks them as solved.

Agents have the option of adding new clients to the database, creating tickets and leaving them open or assigning them to technicians.

Every new assigned ticket sends an email notification to the technician, which can be disabled in the profile.

After a technican marks a ticket as solved, agent sees a purple mark next to that ticket so they can talk with the customer and close the ticket if everything is okay, if the problem needs more work that ticket can be opened again and assigned.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Testing Project

Setting up the app:

1. Install [Laravel](https://laravel.com/docs) and [XAMPP](https://www.apachefriends.org/)
    - [setting up](https://dev.to/sayandeepmajumdar/how-to-install-laravel-project-on-your-windows-10-using-xampp-1g0n)
2. Clone the repository (https://github.com/lergahana/Ticketing-sustav.git) or download the zip
3. Configure the *.env* file
4. Run command `php artisan db:seed` to seed the database with:
    - 20 users (both agents and technicians)
    - 50 clients
    - 4 default status (open, pending, assigned, closed)
    - 150 open tickets assigned to random agents and clients
5. Log in using default credentials: 
    - As agent: 
        - username: *agent.default@<span></span>mail.com*
        - password: *useruser*
    - As technician: 
        - username: *ticketing.sustav@<span></span>gmail.com*
        - password: *useruser*
6. Try out all the features

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).