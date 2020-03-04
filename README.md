# Parking slots management
RESTful API to managing parking slots

## Requirements
```
docker
docker-compose
```

## Example request to API endpoints
```
use Insomnia Rest Client and import ./Insomnia-rest-client.json file
```

## Run application
```
docker-compose up -d
```

## Run migration (exec follow commands in docker container called app)
```
composer dump-autoload
php artisan migrate
php artisan db:seed
```

## Access application
```
Default nginx port is 80 (make sure is available)
http://localhost/
```


## Database structure
```
Databases:
    vehicle_types
    rates
    vehicle_types_rates
    discount_cards
    slots

* vehicle_types
    - id
    - key (unique)
    - title
    - parking_slots (by default 1)

* rates
    - id
    - title
    - from_time
    - to_time

* vehicle_types_rates
    - id
    - vehicle_type_id
    - rate_id
    - amount_per_hour

* discount_cards
    - id
    - key (unique)
    - title
    - discount_percentage

* slots
    - id
    - vehicle_type_id
    - discount_card_id (null by default)
    - starting_at
    - end_at (null by default)
```
