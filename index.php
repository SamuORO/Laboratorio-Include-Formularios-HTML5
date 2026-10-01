<?php 
include "header.php"; 
?> 

<main class="container my-4"> 
    <section> 
        <h1 class="text-center mb-4"> Registro de Aspirantes </h1> 
        
        <p class="text-center"> Complete el siguiente formulario para registrar sus datos. </p> 
        
        <form action="procesar.php" method="POST" enctype="multipart/form-data"> 
            <div class="mb-3"> 
                <label for="nombre" class="form-label"> Nombre </label> 
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre" required > 
            </div> 
                
            <div class="mb-3"> 
                <label for="apellido" class="form-label"> Apellido </label> 
                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingrese su apellido" required > 
            </div> 
            
            <div class="mb-3"> 
                <label for="identificacion" class="form-label"> Identificación </label> 
                <input type="text" class="form-control" id="identificacion" name="identificacion" placeholder="Ejemplo: 8-888-888" required > 
            </div> 
            
            <div class="mb-3"> 
                <label for="fecha_nacimiento" class="form-label"> Fecha de nacimiento </label> 
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required > 
            </div> 
            
            <div class="mb-3"> 
                <label for="sexo" class="form-label"> Sexo </label> 
                <select class="form-select" id="sexo" name="sexo" required > 
                    <option value="">Seleccione una opción</option> 
                    <option value="Masculino">Masculino</option> 
                    <option value="Femenino">Femenino</option> 
                </select> 
            </div> 
            
            <div class="mb-3"> 
                <label for="foto" class="form-label"> Fotografía </label> 
                <input type="file" class="form-control" id="foto" name="foto" accept=".jpg, .jpeg, .png, .gif, .webp" required > 
            </div> 
            
            <div class="text-center"> 
                <button type="submit" class="btn btn-primary"> Registrar Aspirante </button> 
            </div> 
        </form> 
    </section> 
</main> 

<?php 
include "footer.php"; 
?>