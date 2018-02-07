Restaurante
==========

### Registro de cambios sobre los platos
Para el registro de cambios he usado el sistema de eventos que proporciona Symfony. Al modificar un plato se lanza un evento `dish.modified` que es recogido por la clase DishSubscriber.  El registro de los cambios se guarda en una tabla de log con los ids de los ingredientes añadidos y/o borrados del plato.

## Lista de peticiones a la API
Petición | Ejemplo | Respuesta
------------ | ------------- | ------------- 
/allergens/{dish} | /allergens/Macarrones | ```[{"id":1,"name":"gluten"},{"id":2,"name":"lactosa"}]```
/dishes/{allergen} | /dishes/gluten | ```[{"id":1,"name":"Macarrones carbonara"},{"id":2,"name":"Macarrones con tomate"}]```
/dish/new | ```{"name":"Lentejas","ingredients":[{"name":"lentejas","name":"cebolla","name":"chorizo"}]}``` |  ```{"status":"OK","id":1,"dish-name":"Lentejas"}```
| | ```{"name":"Lentejas"}``` | ```{"status":"OK","id":1,"dish-name":"Lentejas"}```
/ingredient/new | ```{"name":"Gambas","allergens":[{"name":"marisco"}]}``` | ```{"status":"OK","id":12,"ingredient-name":"Gambas"}```
| | ```{"name":"Gambas"}``` | ```{"status":"OK","id":12,"ingredient-name":"Gambas"}```
/allergen/new |  ```{"name":"cacahuete"}"``` | ```{"status":"OK","id":7,"allergen-name":"cacahuete"}```

## Carpetas del proyecto
Carpeta | Contenido
------------ | ------------- 
app/config | Configuraciones (rutas, bbdd, etc)
src | Código de la aplicación
test | test automáticos
