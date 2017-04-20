KisuraApp
=========

Steps 
1. clone repo: git clone git@github.com:pdaniszewski/kisuraApp.git
1. run composer: php composer.phar install
2. initialize database 'kisuraapp': 
    bin/console doctrine:database:drop --force
    bin/console doctrine:database:create
    bin/console doctrine:schema:update --force
    bin/console doctrine:fixtures:load
3. under application root directory run small web server
    php -S localhost:8080
4. test endpoints:
    GET METHOD: curl -i 'http://localhost:8080/app_dev.php/api/v1/appointment/1'
    POST METHOD: curl -i -X POST -H "Accept: application/json" -H "Content-Type: application/json" --data '{"appointmentForm":{"phone":"03021253454", "stylist": "zxcvbnmasdfghjkl", "slot": "1", "customer": "asdfghjklqwertyu"}}' 'http://localhost:8080/app_dev.php/api/v1/appointment'
    PUT METHOD: curl -i -X PUT -H "Accept: application/json" -H "Content-Type: application/json" --data '{"appointmentForm":{"phone":"03021253455", "stylist": "zxcvbnmasdfghjkl", "slot": "1", "customer": "asdfghjklqwertyu"}}' 'http://localhost:8080/app_dev.php/api/v1/appointment/1'
    DELETE METHOD: curl -i -X DELETE -H "Accept: application/json" -H "Content-Type: application/json" 'http://localhost:8080/app_dev.php/api/v1/appointment/1'