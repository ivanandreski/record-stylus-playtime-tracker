#!/bin/sh
xterm -title "PHP Artisan" -hold -e "php artisan serve --host=0.0.0.0"  &
xterm -title "NPM Run dev" -hold -e "npm run dev -- --host=0.0.0.0"
