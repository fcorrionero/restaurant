Restaurante
==========

### Tecnología empleada
Para el desarrollo del proyecto he utilizado el framework PHP Symfony que es flexible, además de potente y robusto, permitiendo acelerar el proceso de desarrollo. Este framework permite una implementación modular separando claramente las partes de la aplicación como son las Entidades, Lógica, Controladores, etc. El ORM de Symfony (Doctrine) permite también abstraerse del tipo de base de datos utilizada. En este caso se ha empleado mysql, cuyo esquema se encuentra en el fichero schema.sql.

### Comentarios al código
Las respuestas a las peticiones se generan en el controlador de la aplicación ApiController. La lógica principal en el servicio RestaurantService donde se realizan las principales operaciones relacionadas con el manejo de las entidades. Se han creado tres entidades para representar los principales objetos de la base de datos y dos repositorios para ejecutar operaciones específicas sobre ellas, en este caso búsquedas.
 

### Registro de cambios sobre los platos
Para el registro de cambios he usado el sistema de eventos que proporciona Symfony. Al modificar un plato se lanza un evento `dish.modified` que es recogido por la clase DishSubscriber.  El registro de los cambios se guarda en una tabla de log con los ids de los ingredientes añadidos y/o borrados del plato.

### Lista de peticiones a la API
Para las consultas sobre un plato/alérgeno he empleado los nombres en lugar de los ids por comodidad a la hora de hacer las pruebas, en una aplicación real habría que emplear los ids de los platos/alérgenos que nos proporcionase la aplicación de los camareros.

Petición | Ejemplo | Respuesta
------------ | ------------- | ------------- 
/allergens/{dish} | /allergens/Macarrones | ```[{"id":1,"name":"gluten"},{"id":2,"name":"lactosa"}]```
/dishes/{allergen} | /dishes/gluten | ```[{"id":1,"name":"Macarrones carbonara"},{"id":2,"name":"Macarrones con tomate"}]```
/dish/new | ```{"name":"Lentejas","ingredients":[{"name":"lentejas","name":"cebolla","name":"chorizo"}]}``` |  ```{"status":"OK","id":1,"dish-name":"Lentejas"}```
| | ```{"name":"Lentejas"}``` | ```{"status":"OK","id":1,"dish-name":"Lentejas"}```
/ingredient/new | ```{"name":"Gambas","allergens":[{"name":"marisco"}]}``` | ```{"status":"OK","id":12,"ingredient-name":"Gambas"}```
| | ```{"name":"Gambas"}``` | ```{"status":"OK","id":12,"ingredient-name":"Gambas"}```
/allergen/new |  ```{"name":"cacahuete"}"``` | ```{"status":"OK","id":7,"allergen-name":"cacahuete"}```

### Carpetas del proyecto
Carpeta | Contenido
------------ | ------------- 
app/config | Configuraciones (rutas, bbdd, etc)
src | Código de la aplicación
src/Controller | Controladores
src/Entity | Entidades
src/Event | Eventos y EventSubscribers
src/Repository | Repositorio de las entidades
src/Service | Servicios de la aplicación
test | test automáticos
