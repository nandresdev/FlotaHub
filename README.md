# Intranet para gestionar información de vehiculos y funcionarios.

## Descripción


## Características



## Tecnologías utilizadas

En este proyecto, se emplean las siguientes tecnologías y bibliotecas para el desarrollo, gestión de la base de datos, interfaz de usuario y otras funcionalidades:

### Backend
- **[Laravel 10](https://laravel.com/)**: Un framework de PHP para el desarrollo de aplicaciones y servicios web.
- **[MySQL](https://www.mysql.com/)**: Sistema de gestión de bases de datos relacional, utilizado para almacenar y gestionar la base de datos del proyecto.

### Frontend
- **[AdminLTE 3](https://adminlte.io/themes/v3/)**: Un template administrativo basado en Bootstrap que proporciona una interfaz de usuario limpia y responsiva para aplicaciones web.

### Otras bibliotecas y tecnologías
- **[Bootstrap](https://getbootstrap.com/)**: Framework de HTML, CSS y JS para desarrollar proyectos de manera rápida y responsiva.
- **[jQuery](https://jquery.com/)**: Biblioteca de JavaScript rápida y concisa que simplifica la manipulación del HTML document, el manejo de eventos, la animación y las interacciones Ajax.
- **[Maatwebsite/Excel](https://docs.laravel-excel.com/3.1/getting-started/)**: Paquete para Laravel que permite la exportación e importación de datos a y desde archivos Excel, simplificando las operaciones de hojas de cálculo.
- **[Dompdf/Dompdf](https://github.com/dompdf/dompdf)**: Biblioteca PHP para generar documentos PDF desde HTML. Utilizada para crear reportes y exportaciones de datos en formato PDF.

### Herramientas de desarrollo
- **[Git](https://git-scm.com/)**: Sistema de control de versiones distribuido para manejar todo el código fuente del proyecto.
- **[Composer](https://getcomposer.org/)**: Herramienta para la gestión de dependencias en PHP, que permite declarar las bibliotecas de las cuales depende tu proyecto.


## Instalación
Sigue estos pasos para configurar y ejecutar el proyecto en tu entorno local.

### 1. Clona el repositorio
Clona el código del proyecto utilizando el siguiente comando:

```sh
git clone https://github.com/nandresdev/net-jardin-infantil.git
```

### 2. Navega a la carpeta del proyecto
Una vez clonado, accede al directorio del proyecto:

```sh
cd net-jardin-infantil
```

### 3. Instala las dependencias del proyecto
Instala todas las dependencias necesarias con Composer y NPM:

 ```sh
composer install
 ```
 ```sh
npm install
 ```

### 4. Configura el entorno
Copia el archivo de configuración de entorno y genera la clave de la aplicación:

```sh
copy .env.example .env  # Utiliza 'cp .env.example .env' si estás en un entorno Unix/Linux
```
```sh
php artisan key:generate
```

### 5. Migraciones 
Ejecuta las migraciones para crear las tablas en la base de datos.

```sh
php artisan migrate
```

### 6. Ejecuta el servidor de desarrollo
Inicia el servidor de desarrollo de Laravel:

```sh
php artisan serve
```

### 7. Accede a la aplicación
Visita http://localhost:8000 en tu navegador para ver la aplicación en funcionamiento.
