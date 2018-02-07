Restaurante
==========
Petición | Ejemplo | Respuesta
------------ | ------------- | ------------- 
/allergens/{dish} | /allergens/Macarrones | ```[{"id":1,"name":"gluten"},{"id":2,"name":"lactosa"}]```
/dishes/{allergen} | /dishes/gluten | ```[{"id":1,"name":"Macarrones carbonara"},{"id":2,"name":"Macarrones con tomate"}]```
/dish/new | ```{"name":"Lentejas","ingredients":[{"name":"lentejas","name":"cebolla","name":"chorizo"}]}``` |  ```{"status":"OK","id":1,"dish-name":"Lentejas"}```
| | ```{"name":"Lentejas"}``` | ```{"status":"OK","id":1,"dish-name":"Lentejas"}```
/ingredient/new | ```{"name":"Gambas","allergens":[{"name":"marisco"}]}``` | ```{"status":"OK","id":12,"ingredient-name":"Gambas"}```
| | ```{"name":"Gambas"}``` | ```{"status":"OK","id":12,"ingredient-name":"Gambas"}```
/allergen/new |  ```{"name":"cacahuete"}"``` | ```{"status":"OK","id":7,"allergen-name":"cacahuete"}```
