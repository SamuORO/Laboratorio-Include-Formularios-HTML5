<?php

// Verificar que el formulario fue enviado mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recibir los datos
    $nombre = $_POST["nombre"] ?? "";
    $apellido = $_POST["apellido"] ?? "";
    $identificacion = $_POST["identificacion"] ?? "";
    $fecha_nacimiento = $_POST["fecha_nacimiento"] ?? "";
    $sexo = $_POST["sexo"] ?? "";

    // Limpiar los datos
    $nombre = trim(strip_tags($nombre));
    $apellido = trim(strip_tags($apellido));
    $identificacion = trim(strip_tags($identificacion));
    $fecha_nacimiento = trim(strip_tags($fecha_nacimiento));
    $sexo = trim(strip_tags($sexo));

    // Verificar que los campos no estén vacíos
    if (
        empty($nombre) ||
        empty($apellido) ||
        empty($identificacion) ||
        empty($fecha_nacimiento) ||
        empty($sexo)
    ) {
        die("Error: Todos los campos son obligatorios.");
    }

    // Normalizar nombre y apellido
    $nombre = ucwords(strtolower($nombre));
    $apellido = ucwords(strtolower($apellido));

    // Convertir identificación a mayúsculas
    $identificacion = strtoupper($identificacion);

    // Calcular la edad
    $fechaNacimiento = new DateTime($fecha_nacimiento);
    $hoy = new DateTime();

    $edad = $hoy->diff($fechaNacimiento)->y;

    // Validar edad
    if ($edad < 18 || $edad > 70) { 
        ?> 

        <!DOCTYPE html> 
        <html lang="es"> 
            
        <head> 
            <meta charset="UTF-8"> 
            <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
                
            <title>Edad no válida</title> 
                
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" > 
        </head> 
        <body> 
            <main class="container mt-5"> 
                <section class="card shadow p-4 text-center"> 
                    <div class="alert alert-danger"> 
                        <h2>Edad no válida</h2> 
                        <p class="mb-0"> El aspirante debe tener entre 18 y 70 años. </p> 
                    </div> 
                    <a href="index.php" class="btn btn-primary"> Volver al formulario </a> 
                </section> 
            </main>
        </body> 
        </html> 
        <?php 
        exit; 
    }

    // Verificar que se haya enviado una fotografía
    if (!isset($_FILES["foto"]) || $_FILES["foto"]["error"] != 0) {
        die("Error: Debe seleccionar una fotografía.");
    }

    // Obtener información de la fotografía
    $foto = $_FILES["foto"];

    // Extensiones permitidas
    $extensionesPermitidas = ["jpg", "jpeg", "png", "gif", "webp"];

    // Obtener extensión
    $extension = strtolower(pathinfo($foto["name"], PATHINFO_EXTENSION));

    // Verificar extensión
    if (!in_array($extension, $extensionesPermitidas)) {
        die("Error: El formato de imagen no está permitido.");
    }

    // Verificar que realmente sea una imagen
    $informacionImagen = getimagesize($foto["tmp_name"]);

    if ($informacionImagen === false) {
        die("Error: El archivo seleccionado no es una imagen válida.");
    }

    // Crear un nombre nuevo para la imagen
    $nombreFoto = uniqid("foto_", true) . "." . $extension;

    // Carpeta donde se guardarán las fotografías
    $carpeta = "uploaded_files/";

    // Verificar que la carpeta exista
    if (!is_dir($carpeta)) {
        die("Error: La carpeta uploaded_files no existe.");
    }

    // Verificar permisos de escritura
    if (!is_writable($carpeta)) {
        die("Error: La carpeta uploaded_files no tiene permisos de escritura.");
    }

    // Ruta final
    $rutaFoto = $carpeta . $nombreFoto;

    // Mover la fotografía
    if (!move_uploaded_file($foto["tmp_name"], $rutaFoto)) {
        die("Error: No se pudo guardar la fotografía.");
    }

    // Mostrar resultado
    ?>

    <!DOCTYPE html>
    <html lang="es">

    <head>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Registro exitoso</title>

        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
            rel="stylesheet"
        >

    </head>

    <body>

        <main class="container mt-5">

            <section class="card shadow p-4">

                <h1 class="text-center text-success mb-4">
                    Registro exitoso
                </h1>

                <p>
                    <strong>Nombre:</strong>
                    <?php echo htmlspecialchars($nombre); ?>
                </p>

                <p>
                    <strong>Apellido:</strong>
                    <?php echo htmlspecialchars($apellido); ?>
                </p>

                <p>
                    <strong>Identificación:</strong>
                    <?php echo htmlspecialchars($identificacion); ?>
                </p>

                <p>
                    <strong>Fecha de nacimiento:</strong>
                    <?php echo htmlspecialchars($fecha_nacimiento); ?>
                </p>

                <p>
                    <strong>Edad:</strong>
                    <?php echo $edad; ?> años
                </p>

                <p>
                    <strong>Sexo:</strong>
                    <?php echo htmlspecialchars($sexo); ?>
                </p>

                <p>
                    <strong>Fotografía:</strong>
                    <?php echo htmlspecialchars($nombreFoto); ?>
                </p>

                <div class="text-center mt-3">

                    <a href="index.php" class="btn btn-primary">
                        Registrar otro aspirante
                    </a>

                </div>

            </section>

        </main>

    </body>

    </html>

    <?php

} else {

    echo "Acceso no permitido.";

}

?>
