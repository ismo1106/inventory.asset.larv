## Installation

* `git clone https://github.com/ismo1106/inventory.asset.larv.git`
* `cd inventory.asset.larv`
* `composer install`
* save the .env.example to .env
* update the .env file with your db credentials
* `php artisan key:generate`

## Peraturan Permission (Middleware Route)

Name Permission menggunakan Nama Conttoller (without 'Controller' string) dengan separator (.) kemudian diikuti nama method atau action, contoh:
* Contorller Class name : `UserController`
* Method function name : `index`
* Permission Name must use : `User.index` 

## License

This Project used the Laravel framework, is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
