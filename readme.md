<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of any modern web application framework, making it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 1100 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for helping fund on-going Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell):

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- [UserInsights](https://userinsights.com)
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)
- [Invoice Ninja](https://www.invoiceninja.com)
- [iMi digital](https://www.imi-digital.de/)
- [Earthlink](https://www.earthlink.ro/)
- [Steadfast Collective](https://steadfastcollective.com/)
- [We Are The Robots Inc.](https://watr.mx/)
- [Understand.io](https://www.understand.io/)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## API Routes

- /api/clients - returns all clients
- /api/drivers - returns all drivers
- /api/serviceable-requests - returns all serviceable requests
- /api/history - returns all requests that have been fulfilled
- /api/login?email={email}&password={password} - returns if the client is authorized, the clients role, and the client object. The same for driver and admin.
- /api/logout?email={email} - returns true and marks driver as offline
- /api/register?first_name={first_name}&last_name={last_name}&email={email}&phone_number={phone_number}&password={password}&confirm_password={confirm_password} - returns error if passwords do not match. Returns error if emails match. Returns success if the client is successfully created. (only to be used for clients).
- /api/register-driver?first_name={first_name}&last_name={last_name}&email={email}&phone_number={phone_number}&password={password}&confirm_password={confirm_password} - same as client register except returns driver object. Also needs to be only accessible to admin.
- /api/driver?id={id} - return the driver provided the id
- /api/client?id={id} - return the client provided the id
- /api/client-requests?id={id} - return a client’s serviceable requests provided client id
- /api/driver-requests?id={id} - return a driver’s serviceable requests provided driver id. (returns requests currently in progress by the specified driver)
- /api/create-request?client_id={client_id}&destination_address={destination_address}&pick_up_address={pick_up_address}&estimated_length={estimated_length}&time={time}&date={date} - return the serviceable request that was created. Returns error if client is not authorized.
- /api/finished-request?request_id={request_id}&driver_id={driver_id} - returns the history object that was created after the service request is deleted.
- /api/authorize-client?client_id={client_id}&authorize={authorize} - returns the client object that was authorized. Returns deleted if the client is not authorized. The parameter authorized should be the string ‘yes’ or ‘no’. Only to be accessed by admin.
- /api/accept-request?driver_id={driver_id}&request_id={request_id} - returns the serviceable request that has been updated to a in-route status rather than pending.

## Creating A Route
In order to create a route you must go to the routes/api.php file.

You will see that the routes take the shape:
<code>
- Route::get($uri, $callback);
- Route::post($uri, $callback);
- Route::put($uri, $callback);
- Route::patch($uri, $callback);
- Route::delete($uri, $callback);
- Route::options($uri, $callback);
</code>

To look up more routing documentation look at [Laravel's Routing](https://laravel.com/docs/5.7/routing) documentation.

## The Models

We have a few different models used that are linked to a database table they are found in the app/ directory:
- Client
- Driver
- History
- ServiceableRequests
- User

These do not have much to them looking at [Laravel's Eloquent: Getting Started](https://laravel.com/docs/5.7/eloquent)
will give you everything you need to know about working with them.

