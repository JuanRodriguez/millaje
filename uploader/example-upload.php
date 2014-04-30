<?php
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
?>
