## About

Simple application to track the playtime of your current record stylus. The application requires you to have a discogs account and have your record collection in a public folder. 

## Usage

The app is meant to be hosted on your local network and does not have multi user support. It caches your discogs collection locally and uses it to create playsessions based on your played record. The playtime of the album is collected from discogs.

## Technologies

- Backend: Laravel Livewire
- Frontend: Blade views, TailwindCSS, AlpineJS
- Database: Sqlite

## Requirements

- PHP >= 8.1
- Composer 2
- Node 18

## How to start the app

1. Clone the repository
2. Make a `database.sqlite` file in the database folder
3. Run `composer install` in the root directory of the repository
4. Run `npm install` in the root directory of the repository
5. Run `php artisan migrate` in the root directory of the repository to initialize the database
6. Run `php artisan serve --host=0.0.0.0` in a terminal window
7. Run `npm run dev -- --host=0.0.0.0` in a seperate terminal window (Change 0.0.0.0 to your local ip address of the host computer)
8. The app can now be accessed from any device on your local network using the servers private ip address.
