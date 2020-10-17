# Doha Wordpress Theme

**Doha** es un *theme* "base" de **Wordpress**. No está pensado para ser usado *tal cual*, sino para ser tomado como punto de partida para la creación de un *theme* propio, con un código personalizado y un diseño original.

**Doha** es la versión ordenada de los archivos que utilizaba y reacomodaba periódicamente al empezar un proyecto nuevo, en casos en los que no era práctico entender y readaptar un *theme* existente, como tampoco lo era crear un *theme* propio completamente desde cero.

Esta base considera, a grandes rasgos, estos items:

* Estructura "limpia", sólo con los archivos básicos de un *theme*
* Funciones y configuraciones comunes para aprovechar u optimizar el *theme*
* Estilos para contenedores y una estructura general
* Estilos para considerar los elementos generados desde el editor de Wordpress
* Adaptación responsive, contemplando ya las funciones para mostrar/ocultar el menú y el buscador
* Tareas de Gulp organizadas para facilitar el desarrollo y la optimización de los assets

## Enlaces

* Repositiorio y descarga: https://github.com/leandroamato/doha
* Demo: https://doha.localv.ar/
* Contacto: https://leandro.ama.to/#contacto

## Requerimientos de desarrollo

- Una instalación de [Wordpress](https://wordpress.org/) activa
- [Node.js](https://nodejs.org/en/), para las dependencias de desarrollo
- [Gulp](https://gulpjs.com/), para ejecutar tareas que facilitan el proceso

## Uso

### Configuración

- Descargar [una copia de este *theme*](https://github.com/leandroamato/doha)
- Copiar los archivos en la instalación de Wordpress y activar el *theme* desde la administración
- Crear un archivo `config.json` a partir del ejemplo en `config.json.sample`
- Agregar al `config.json` los detalles del sitio
  - `site.url` con el URL local, sólo necesario para el proxy que usa Gulp
  - Opcionalmente, modificar las opciones de optimización:
    - `nano`: Opciones de CSSNano (Referencia: https://cssnano.co/docs/optimisations)
    - `terser`: Opciones de terser para javascript (Referencia: https://github.com/terser/terser#minify-options)
- Instalar dependencias con `npm install`
- Ejecutar `gulp` en el root del theme

### Manejo de assets y tareas de Gulp

**Gulp** tiene una serie de tareas para compilar y optimizar assets y para facilitar el desarrollo, definidas en `gulpfile.js`. Se pueden listar las tareas disponibles ejecutando `gulp --tasks`.

La tarea *default* de **Gulp** ejecuta:

1. `styles` para compilar el CSS
2. `scripts` para compilar el Javascript
3. `serve` para servir el sitio en el browser via [browserSync](https://www.browsersync.io/), observar cambios en archivos y recargar el sitio cuando haya cambios relevantes.

### Estilos y Javascript

La tarea de **Gulp** para procesar los estilos genera 2 archivos:

* `./dist/css/main.css`: Versión unificada de todos los archivos `.scss` en `./assets/scss`, para referencia o debug
* `./dist/css/main.min.css`: Versión minificada del archivo anterior, para usar en producción.

La tarea de **Gulp** para procesar javascript genera 2 archivos:

* `./dist/js/main.js`: Versión unificada de todos los archivos `.js` en `./assets/js`, para referencia o debug
* `./dist/js/main.min.js`: Versión minificada del archivo anterior, para usar en producción.

El theme "encola" automáticamente el estilo y el javascript generados con la función `doha_scripts_styles`.

#### Archivos de estilos

| Archivo                         | Detalles                                                                 |
|---------------------------------|--------------------------------------------------------------------------|
| **`main.scss`**                 | Archivo principal desde el que se importan todos los archivos de estilos |
| **`config/`**                   | Archivos con definiciones y configuraciones generales                    |
| `config/_normalize.scss`        | Un CSS reset moderno, via https://github.com/necolas/normalize.css/      |
| `config/_mq.scss`               | Media query mixins, via https://github.com/sass-mq/sass-mq               |
| `config/_variables.scss`        | Variables generales que se utilizan en el diseño                         |
| **`base/`**                     | Archivos con elementos generales y/o repetitivos                         |
| `base/_accessibility.scss`      | Algunas reglas para accesibilidad                                        |
| `base/_text.scss`               | Definiciones generales de tipografías y tamaños de bloques de texto      |
| `base/_links.scss`              | Estilos para links y botones genéricos                                   |
| `base/_form.scss`               | Estilos para campos de formularios                                       |
| **`containers/`**               | Archivos con contenedores generales                                      |
| `content/_body.scss`            | Estilos del body y el html                                               |
| `content/_container.scss`       | Estilos del contenedor general del sitio                                 |
| `content/_header.scss`          | Estilos del header                                                       |
| `content/_footer.scss`          | Estilos del footer                                                       |
| `content/_main.scss`            | Estilos del contenedor del contenido                                     |
| `blocks/_wrap.scss`             | Clase para contenidos que mantienen el ancho máximo                      |
| **`blocks/`**                   | Archivos con bloques y elementos de contenidos específicos               |
| `blocks/_primary-menu.scss`     | Estilos del menú principal                                               |
| `blocks/_search-form.scss`      | Estilos del buscador                                                     |
| `blocks/_article.scss`          | Estilos para posts y páginas "singulares"                                |
| `blocks/_comments_.scss`        | Estilos para comentarios                                                 |
| `blocks/_grid.scss`             | Estilos para el contenedor de posts en home y archivos                   |
| `blocks/_wordpress.scss`        | Estilos para bloques generados por Wordpress                             |
| `blocks/_posts-navigation.scss` | Paginación en los archivos de Wordpress                                  |
| `blocks/_no-results.scss`       | Estilos para la página que se muestra cuando no hay resultados           |

#### Archivos de Javascript

| Archivo     | Detalles                                                                      |
|-------------|-------------------------------------------------------------------------------|
| `toggle.js` | Funciones para permitir el toggle, como en el menú principal y en el buscador |

#### Archivos custom

El *theme* incluye carpetas para agregar archivos propios de CSS o Javascript, considerando casos en los que se quiere mantener el *theme* original inalterado para poder actualizarlo si hubiese nuevas versiones pero se necesita alguna personalización extra sencilla.

* `./assets/scss/custom/before/`: Archivos que se importan antes que los del *theme* (por ejemplo, para redefinir variables)
* `./assets/scss/custom/after/`: Archivos `.scss` que se importan después que los del *theme* (por ejemplo, para sobreescribir estilos o agregar reglas propias nuevas)
* `./assets/js/custom/`: Archivos `.js` para sumar funciones extra.

### Funciones de PHP

Las funciones propias del *theme* se encuentran en la carpeta `./functions/`, separadas en archivos para facilitar su edición.

| Archivo     | Detalles                                                                           |
|-------------|------------------------------------------------------------------------------------|
| `setup.php` | Setup del theme, habilitando funciones de Wordpress y otros detalles               |
| `meta.php`  | Incluye un meta tag de `description` por defecto                                   |
| `doha.php`  | Funciones para agregar estilos, mostrar contenidos y otros detalles personalizados |
