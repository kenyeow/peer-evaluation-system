<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


## Peer Evaluation System

Peer Evaluation System is a web application developed using the Laravel framework. This system is developed to enhance the assignment evaluation process by using the peer evaluation method.

## Prerequisites

To run this system there is a few prerequisites programs to download.

- [XAMPP] version: 7.4.12 / PHP 7.4.12 (https://www.apachefriends.org/download.html).
- [Composer] version: v2.0.7 (https://getcomposer.org/download/).
- Code Editor Recommended: [Visual Studio Code](https://code.visualstudio.com/download).

## Installation

- Clone the repository to your local disk : git clone https://github.com/NgYanYan/Peer-Evaluation-System.git Peer-Evaluation-System
- Change directory to the application folder : cd Peer-Evaluation-System
- run : composer update
- Create .env file based on .env.example : copy .env.example .env
- Create an empty database
- Update database params inside .env file
- Generate un application key : php artisan key:generate
- Update npm packages : npm install
- Run : npm run dev
- Run the migration : php artisan migrate
- Run the local server : php artisan serve

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
