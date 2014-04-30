files-upload-class
==================

Clase para la gestión de subida de archivos.

Configuración
=============

Lo único que debemos hacer para usar esta clase es importarla en el script donde la usaremos:
```php
include 'upload.class.php';
```

Uso
===

Bien ahora veamos un ejemplo de uso de esta clase, supongamos que tenemos un formulario desde el cual subimos un archivo:

**example-upload.html**
```html
<!DOCTYPE html>
<html>
    <head>
        <title>Subida de Archivos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <label for="file">Filename:</label>
        <input type="file" name="file" id="file"><br>
        <input type="submit" name="submit" value="Submit">
    </form>
    </body>
</html>
```

Es importante recordar que cuando queremos enviar archivos debemos establecer en el formulario el atributo enctype con el valor *multipart/form-data*, ademas debemos usar el elemento input con el atributo type en file y asignarme un nombre desde el atributo name.

**example-upload.php**
```php 
include 'upload.class.php';
if (isset($_FILES['file'])) {
    $uploaded = new Upload($_FILES['file']);
    $types  = array('image/png');
    $ext    = array('png');
    $size   = 1;
    $uploaded->validate($size, $ext, $types);
    $estado = $uploaded->save('stored/');
    if($estado){
       echo "Imagen Guardada correctamente.";
       $uploaded->rename('imagen1.png');
    } else {
       echo "Imagen no valida.";
    }
}
```

Bien, vamos a comentar el código de arriba, lo primero que debemos fijarnos es que importamos la clase upload.class.php, esto es lógico ya que de lo contrario no podríamos usarla. En la linea 2 realizamos una evaluación sobre la variable FILES, para saber si se ha enviado o no un archivo, en caso afirmativo precederemos al proceso de dicho archivo. Una vez confirmado el envió del archivo instanciaremos un objeto de la clase Upload pasando le como único parámetro del constructor el array FILES con su correspondiente referencia al nombre del campo del formulario desde el que se a enviado el archivo, en este caso "file". Seguido creamos tres variables en las que estableceremos los parámetros de validación del archivo:

* *$types*: es un array con los tipos MIME permitidos.
* *$ext*: es un array con las extensiones permitidas.
* *$size*: es el tamaño máximo en MB del archivo.

Ahora solo tenemos que pasar le estas variables al método *validate()* para que efectué la validación. Este método devolverá TRUE si el archivo cumple los requisitos y FALSE en caso contrario. Una vez hemos realizado la validación precederemos a guardar la imagen en el directorio deseado, en nuestro ejemplo usaremos la carpeta "stored", cabe destacar que debemos añadir la barra "/" al final del nombre de la carpeta donde se subirán las imágenes. Finalmente evaluamos si la subida a sido correcta o no y mostramos un mensaje informativo a los usuarios. Adicionamente podemos renombrar el archivo subido usando el método *rename()*. 
