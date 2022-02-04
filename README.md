# CRUD con TDD en Laravel

Este proyecto se realizó siguiendo el siguiente [videotutorial](https://youtu.be/_GwqxAi_ly0).

Funciones y métodos están actualizados con Laravel 8.

## Pasos

Descarguen o clonen el proyecto:

```bash
git clone git@github.com:juanxodj/tdd-practice.git
```

Después instalan las dependencias:

```bash
composer install
```
En Laravel 8 pueden ejecutar el siguiente comando para ejecutar todos los test escritos:

```bash
php artisan make:test
```
Si quieren ejecutar un test en específico deben pasarle el nombre del test:

```bash
php artisan make:test --filter=test_a_post_can_be_created
```

Que lo disfruten!

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)