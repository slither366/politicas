<!DOCTYPE html>
<html lang="es">
 
<head>
  <title>Bootstrap: Tipografía</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
</head>
 
<body>
<div class="container">
 
  <h1>Resaltar texto</h1>
  <p>Use el elemento mark para <mark>resaltar</mark> el texto.</p>
 
  <h1>Marcar abreviaturas o acrónimos</h1>
  <p>La <abbr title="Organización de las Naciones Unidas">ONU</abbr> fue fundada el 24 de octubre de 1945.</p>
 
  <h1>Citar textos</h1>
  <h2>Alineado a la izquierda</h2>
  <blockquote>
  <p>La tierra tiene lo suficiente para satisfacer las necesidades de todos, pero no las ambiaciones de unos cuantos.</p>
  <footer>Mahatma Gandhi</footer>
  </blockquote>
  <h2>Alineado a la derecha</h2>
  <blockquote class="blockquote-reverse">
  <p>La tierra tiene lo suficiente para satisfacer las necesidades de todos, pero no las ambiaciones de unos cuantos.</p>
  <footer>Mahatma Gandhi</footer>
  </blockquote>
 
  <h1>Listas de descripción</h1>
  <dl>
    <dt>Variedades de café</dt>
    <dd>- café arábica</dd>
    <dd>- café robuta</dd>
    <dt>Tipos de té</dt>
    <dd>- té verde</dd>
    <dd>- té blanco</dd>
    <dd>- té rojo</dd>
    <dd>- té azul</dd>
    <dd>- té amarillo</dd>
  </dl> 
 
  <h1>Marcar texto</h1>
  <p>Los siguientes elementos HTML: <code>span</code>, <code>section</code>, and <code>div</code> definen secciones en un documento.</p>
 
  <h1>Entradas por teclado</h1>
  <p>utilice <kbd>ctrl + s</kbd> para abrir el cuadro de diálogo "Guardar como...".</p>
 
  <h1>Múltiples líneas de código</h1>
  <h2>Sin scroll</h2>
  <pre>
El texto incluido en un elemento pre
es mostrado con una fuente de ancho
fijo, y se preservan todos
los      espacios y saltos
de línea.
   </pre>
   <h2>Con scroll</h2>
<pre class="pre-scrollable">
El texto incluido en un elemento pre
es mostrado con una fuente de ancho
fijo, y se preservan todos
los      espacios y saltos
de línea.
   </pre>
 
   <h1>Colores de texto predefinidos</h1>
   <p class="text-muted">Texto de color muted.</p>
  <p class="text-primary">Texto de color important.</p>
  <p class="text-success">texto de color success.</p>
  <p class="text-info">texto de color information.</p>
  <p class="text-warning">Texto de color warning.</p>
  <p class="text-danger">texto de color danger.</p>
 
  <h1>Colores de fondo predefinidos</h1>
  <p class="bg-primary">Color de fondo important.</p>
  <p class="bg-success">Color de fondo success.</p>
  <p class="bg-info">Color de fondo information.</p>
  <p class="bg-warning">Color de fondo warning.</p>
  <p class="bg-danger">Color de fondo danger.</p> 
 
  <h1>Alinear párrafos</h1>
  <p class="text-left">Párrfo alineado a la izquierda.</p>
  <p class="text-right">Párrafo alineado a la derecha.</p>
  <p class="text-center">Párrafo centrado.</p>
  <p class="text-justify">Párrafo justificado: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore 
 
et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
 
dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in 
 
culpa qui officia deserunt mollit anim id est laborum."</p>
  <p class="text-nowrap">Clase .text-nowrap: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore 
 
et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
   <h1>Mayúsculas y minúsculas</h1>
   <p class="text-lowercase">TEXTO EN minúsculas.</p>
   <p class="text-uppercase">texto en MAYÚSCULAS.</p>
   <p class="text-capitalize">la primera letra de cada palabra es mayúscula.</p>
 
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
 
</html>