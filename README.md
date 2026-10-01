# Registro de Aspirantes

## Descripción

Este proyecto consiste en un sistema web para el **Registro de Aspirantes**, desarrollado utilizando **PHP, HTML5 y Bootstrap**.

El sistema permite ingresar los datos personales de un aspirante, validar su información y subir una fotografía. Los datos son procesados mediante PHP y la fotografía es almacenada en una carpeta específica del proyecto.

El proyecto fue desarrollado como parte de un laboratorio para practicar el uso de formularios HTML, procesamiento de datos mediante PHP, validaciones, subida de archivos y medidas básicas de seguridad.

---

## Tecnologías utilizadas

* **PHP** - Procesamiento del formulario y validación de datos.
* **HTML5** - Estructura de las páginas.
* **Bootstrap 5** - Diseño y estilos de la interfaz.
* **Apache** - Servidor web utilizado mediante WAMP.
* **WAMP** - Entorno de desarrollo local.

---

## Estructura del proyecto

```text
TallerAspirantes/
│
├── index.php
├── procesar.php
├── header.php
├── footer.php
│
└── uploaded_files/
    ├── .htaccess
    └── fotografías subidas
```

### Archivos principales

**index.php**

Contiene el formulario donde el usuario introduce los datos del aspirante:

* Nombre
* Apellido
* Identificación
* Fecha de nacimiento
* Sexo
* Fotografía

El formulario utiliza el método `POST` y `multipart/form-data` para poder enviar la fotografía.

---

**header.php**

Contiene la estructura inicial de la página, incluyendo:

* Configuración HTML5.
* Meta etiquetas.
* Bootstrap.
* Barra de navegación.
* Migas de pan.

Este archivo se incluye mediante `include` en las páginas que lo necesitan.

---

**footer.php**

Contiene el pie de página del proyecto y utiliza PHP para mostrar automáticamente el año actual:

```php
<?php echo date('Y'); ?>
```

---

**procesar.php**

Se encarga de recibir y procesar la información enviada desde `index.php`.

Entre sus funciones se encuentran:

* Recibir los datos mediante `$_POST`.
* Limpiar los datos recibidos.
* Validar los campos obligatorios.
* Normalizar nombres y apellidos.
* Calcular la edad.
* Validar el rango de edad.
* Validar la fotografía.
* Guardar la fotografía.
* Mostrar el resultado del registro.

---

**uploaded_files/**

Esta carpeta almacena las fotografías que son subidas mediante el formulario.

También contiene un archivo `.htaccess` para evitar que los archivos puedan ser accedidos directamente desde el navegador.

---

## Validación y saneamiento de datos

Para limpiar y normalizar la información introducida por el usuario se utilizaron diferentes funciones de PHP.

### `trim()`

Elimina espacios innecesarios al principio y al final de los datos.

### `strip_tags()`

Elimina etiquetas HTML que puedan ser introducidas en los campos del formulario.

### `strtolower()`

Convierte el texto a minúsculas.

### `ucwords()`

Convierte la primera letra de cada palabra a mayúscula.

Estas funciones se utilizan principalmente para normalizar el nombre y apellido.

Por ejemplo:

```text
carlos jimenez
```

se convierte en:

```text
Carlos Jimenez
```

### `strtoupper()`

Convierte la identificación a mayúsculas.

### `htmlspecialchars()`

Se utiliza al mostrar los datos procesados para evitar que contenido HTML introducido por el usuario sea interpretado por el navegador.

---

## Validación de edad

El sistema calcula automáticamente la edad utilizando la fecha de nacimiento proporcionada.

El aspirante debe tener una edad entre:

```text
18 y 70 años
```

Si no cumple este requisito, el sistema muestra un mensaje indicando que la edad no es válida y proporciona un botón para regresar al formulario.

---

## Subida de fotografías

El formulario permite seleccionar fotografías en los siguientes formatos:

* JPG
* JPEG
* PNG
* GIF
* WEBP

El archivo se recibe mediante `$_FILES`.

Primero se verifica que la extensión esté permitida y posteriormente se utiliza:

```php
getimagesize()
```

para comprobar que el archivo realmente corresponda a una imagen.

También se genera un nombre único para evitar conflictos entre archivos:

```php
uniqid()
```

Finalmente, la imagen se guarda utilizando:

```php
move_uploaded_file()
```

---

## Protección de las fotografías

La carpeta `uploaded_files` contiene un archivo `.htaccess` que bloquea el acceso directo desde el navegador.

La configuración utilizada es:

```apache
# Bloquea TODO acceso desde el navegador a esta carpeta

# Apache 2.4+ (WAMP actual)
<IfModule mod_authz_core.c>
    Require all denied
</IfModule>

# Apache 2.2
<IfModule !mod_authz_core.c>
    Order allow,deny
    Deny from all
</IfModule>
```

De esta manera, PHP puede guardar las fotografías en la carpeta, pero los archivos no pueden ser consultados directamente mediante una URL.

---

## Uso del sistema

1. Abrir el proyecto desde el servidor local de WAMP.
2. Acceder a `index.php`.
3. Completar todos los campos del formulario.
4. Seleccionar una fotografía.
5. Presionar **Registrar Aspirante**.
6. El sistema procesa y valida los datos.
7. Si la información es correcta, se muestra el registro exitoso.
8. La fotografía se almacena dentro de `uploaded_files`.

Si la edad no está entre 18 y 70 años, el sistema muestra un mensaje de error y permite regresar al formulario.

---

## Instalación

Para ejecutar el proyecto localmente se necesita tener instalado WAMP.

El proyecto debe colocarse dentro de la carpeta:

```text
C:\wamp64\www\
```

Por ejemplo:

```text
C:\wamp64\www\TallerAspirantes
```

Después se deben iniciar los servicios de **Apache** desde WAMP y acceder al proyecto mediante el navegador.

---

## Objetivo del proyecto

El objetivo principal es practicar la creación de un formulario web utilizando PHP y HTML5, aplicando validaciones, saneamiento de información, manejo de archivos y conceptos básicos de seguridad.

También se busca aplicar una estructura modular mediante archivos `include` y utilizar Bootstrap para mejorar la presentación de la aplicación.


## Creador del proyecto
Samuel Orocú 8-1039-1344
Grupo 1S3122
