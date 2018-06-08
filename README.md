# Trabajo Final para Computador Universitario
Este es el proyecto final propuesto para la carrera Computador Universitario de la Universidad Nacional de Salta - Argentina. Se utilizó los conocimientos adquiridos en la carrera para desarrollar una aplicación para comercio eletrónico B2C.

## Tecnologías empleadas
- PHP 5.6
- HTML5
- CSS3
- Javascript
- AJAX
- MySQL 5.4
- Composer

## Liberias/Frameworks
- JQuery
- Bootstrap 2
- Stripe
- DataTableJS
- HighChartsJS
- notifIF!
- JQuery FlexSlider
- JQuery treeview
- JQuery UI
- domPDF
- Eloquent component
- Carbon
- Whoops

## Funcionalidades
- Mostrar catálogo de productos.
- El catálogo puede ordenarse de acuerdo a distintos criterios.
- Buscador de productos.
- Carrito de compras.
- Registro y autenticación de usuarios.
- Usuarios registrados pueden ver sus ordenes.
- Registrar compras.
- Gestionar categorias y subcategorias de la tienda.
- Gestión de ordenes de compra.
- Reporte de ventas.

## Instalación
```sh
$ git clone https://github.com/pabcha/Seminario-CU.git
```

## Configuracion
Se debe modificar el archivo `application/Config.php` y `public/js/common/helpers.js (linea 91)`. Principalmente se necesita proporcionar base url y la informacion de la base de datos, el resto puede dejarse como esta.

## Informacion adicional
El código SQL de la base de datos se encuentra en la `carpeta zsql` de este proyecto. Dicha carpeta no es utilizada por el sistema asi que se puede borrar.
![db esquema](https://i.imgur.com/J0aIm57.png)

Se puede acceder al panel administrador colocando `/admin` al final del BASE_URL, por ejemplo `http://localhost/computador/admin`. A continuacion se muestran los usuarios que el sistema tiene incorporados si se utiliza el sql proporcionado:
```sh
admin@admin.com | 123456 | Administrador
juan@hotmail.com | 123456 | Vendedor 
user@user.com | 123456 | usuario común
```

El proyecto utiliza arquitectura [MVC (Modelo-Vista-Controlador)](https://codigofacilito.com/articulos/mvc-model-view-controller-explicado) el cual fue implementado gracias al canal de YouTube [dlancedu](https://www.youtube.com/playlist?list=PLMVWdD5bcndrmfgQdYeZqTx-OP8SQilJK).

![MVC](https://helloacm.com/wp-content/uploads/2017/01/model-view-controller-mvc-explained.jpg)

