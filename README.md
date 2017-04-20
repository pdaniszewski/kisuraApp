KisuraApp
=========

Steps 
1. clone repo: git clone git@github.com:pdaniszewski/kisuraApp.git
1. run composer: php composer.phar install
2. initialize database 'kisuraapp': <br>
    bin/console doctrine:database:drop --force<br>
    bin/console doctrine:database:create<br>
    bin/console doctrine:schema:update --force<br>
    bin/console doctrine:fixtures:load<br>
3. under directory './web' run small web server<br>
    php -S localhost:8080
4. test endpoints:<br>
    GET METHOD: curl -i 'http://localhost:8080/app_dev.php/api/v1/appointment/1'<br>
    POST METHOD: curl -i -X POST -H "Accept: application/json" -H "Content-Type: application/json" --data '{"appointmentForm":{"phone":"03021253454", "stylist": "zxcvbnmasdfghjkl", "slot": "1", "customer": "asdfghjklqwertyu"}}' 'http://localhost:8080/app_dev.php/api/v1/appointment'<br>
    PUT METHOD: curl -i -X PUT -H "Accept: application/json" -H "Content-Type: application/json" --data '{"appointmentForm":{"phone":"03021253455", "stylist": "zxcvbnmasdfghjkl", "slot": "1", "customer": "asdfghjklqwertyu"}}' 'http://localhost:8080/app_dev.php/api/v1/appointment/1'<br>
    DELETE METHOD: curl -i -X DELETE -H "Accept: application/json" -H "Content-Type: application/json" 'http://localhost:8080/app_dev.php/api/v1/appointment/1'<br>
