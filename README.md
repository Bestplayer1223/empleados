# Empleados V1
Este es mi proyecto desarrollado de la prueba técnica del crud de empleados.
Este proyecto está desarrollado en Laravel, donde se llevó a cabo desde la creación
de la base de datos, junto con todos sus tablas, modelos y migraciones, hasta los controladores
Y archivos de validación (REQUESTS) necesarios para el funcionamiento de la aplicación.
Este proyecto cuenta con una API, mediante la cual JavaScript accede a la información y logra manipular la interfaz de manera dinámica.
En la carpeta public se encuentran las librerías usadas, y los archivos js y css creados.
Dentro de la carpeta resources, hay una carpeta llamada views, que es en la cual
Se encuentran todas las vistas HTML desarrolladas para este proyecto. Cuenta también
Con la implementación de Bootstrap y algunas librerías como lo es la de alertify.

En la carpeta routes, en el archivo api.php están las rutas generadas para la API del proyecto.


/ ******************* Pasos para Ejecutar el proyecto ***************/

Para poder colocar en funcionamiento este proyecto, se debe realizar los siguientes
pasos:
Instalar dependencias: se deben ejecutar los siguientes comando en la raíz del proyecto
        A. "composer install"
        B. "npm install"

Una vez ejecutados se pasa a crear una base de datos vacía, con el nombre de "prueba_tecnica_dev" en el gestor de bases de datos MYSQL de preferencia.
Posterior a la creación de la base de datos, en la raíz se debe crear un archivo llamado ".env"
que debe contener la información que contiene el archivo".env.example"
por consiguiente se debera migrar la base de datos, por lo que se debe ejecutar el siguiente comando
en la raíz del proyecto:
"php artisan migrate"

Finalmente, Cuando ya se haya realizado todos estos pasos, solo se deberá ejecutar los comandos "php artisan serve" en una terminal && "npm run dev" en otra, desde la raíz del proyecto para que inicie el servidor y se pueda visualizar la aplicación.
