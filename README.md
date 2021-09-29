# Prueba de servicios en Laravel con Passport
Se realizo la prueba requerida para completar la solicitud como desarrollador, la prueba consistía en desarrollar 3 servicios API Rest, los cuales
fueron desarrollados con el framework Laravel añadiéndole el módulo de Paasport que proporciona el protocolo OAuth2 para la generación de tokens.

### Estos son los servicios desarrollados:
##### Users
- Login(http://127.0.0.1:8000/api/user/login)
- Register(http://127.0.0.1:8000/api/user/register)


##### Customers
- addCustomers(http://127.0.0.1:8000/api/customer/addCustomers)
- deleteCustomers(http://127.0.0.1:8000/api/customer/softDelete)
- searchCustomer(http://127.0.0.1:8000/api/customer/searchCustomers)

Para mas informacion en cuanto a los servicios se incluira el archivo services para hacer
las pruebas desde postman.

## Para comenzar:
### Paso 1 Cree el archivo .env 
En la raiz del proyecto siguiendo el archivo .env.example cree su archivo de configuracion y conecte la base de datos que utilizara en el proyecto.

### Paso 2 Instale los paquetes
```bash
composer install
```
### Paso 3 Crees las claves de la aplicacion 
```bash
php artisan key:generate
```
### Paso 4 Importe la base de datos
importar la base de datos almacenada en el archivo test.sql

### Paso 5 Ejecute el proyecto
```bash
php artisan serve
```