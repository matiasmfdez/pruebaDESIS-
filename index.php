<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>FORMULARIO PRUEBA</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div id="contenedor" class="contenedor">
        <h1>FORMULARIO DE VOTACION</h1>
        <form id="myForm" action="" method="POST">
          <div class="labels">
            <label for="nombreYApellido">Nombre y Apellido</label>
            <br>
            <label for="alias">Alias</label>
            <br>
            <label for="email">Email</label>
            <br>
            <label for="rut">RUT</label>
            <br>
            <label for="regiones">Región</label>
            <br>
            <label for="comunas">Comuna</label>
            <br>
            <label for="selectorcandidatos">Candidato</label>
            <br>
            <label>¿Cómo se enteró de nosotros?</label>
            <br>
            <input type="submit" value="VOTAR">
          </div>
          <div class="inputs">
            <input type="text" id="nombreYApellido" name="nombreYApellido" required>
            <br>
            <input type="text" id="alias" name="alias">
            <br>
            <input type="email" id="email" name="email">
            <br>
            <input type="text" id="rut" name="rut">
            <br>
            <select id="regiones" name="regionId" >
                <?php
                include("conector.php");
                $sql = "SELECT idRegion, nombre_region FROM regiones";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['idRegion'] . '">' . $row['nombre_region'] . '</option>';
                  }
                } else {
                  echo '<option value="">No hay regiones seleccionadas</option>';
                }
                $conn->close();
                ?>
              </select>
            <br>
            <select id="comunas" name="comunas" required>
             <?php
              include("conector.php");

                if (isset($_POST['idRegion'])) {
                  $regionId = $_POST['regionId'];
                  $sql = "SELECT nombre FROM comunas WHERE idRegion = $regionId";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    echo '<select id="comunas" name="comunas" required>';
                    while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['nombre'] . '">' . $row['nombre'] . '</option>';
                  }
                    echo '</select>';
                  } else {
                    echo '<p>No hay comunas disponibles para esta región.</p>';
                  }
                } else {
                  echo '<p>No se especificó una región.</p>';
                }

                $conn->close();
                ?>
            </select>
            <br>
            <select id="selectorcandidatos" name="candidato" required>
                <?php 
                echo "Hola, mundo";
                include("conector.php");
                $sql = "SELECT idcandidato, nombre FROM candidato";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['idcandidato'] . '">' . $row['nombre'] . '</option>';
                    }
                } else {
                    echo '<option value="">No hay candidatos disponibles</option>';
                }
                $conn->close();
                ?>
            </select>
            <br>
            <div id="check_enterado">
              <input type="checkbox" id="redesSociales" name="seEntero[]" value="redesSociales">
              <label for="redesSociales">Redes Sociales</label>
              <input type="checkbox" id="emailEnterado" name="seEntero[]" value="email">
              <label for="emailEnterado">Email</label>
              <input type="checkbox" id="anuncioWeb" name="seEntero[]" value="anuncioWeb">
              <label for="anuncioWeb">Anuncio web</label>
            </div>
          </div>

        </form>
    </div>
<script>
$(document).ready(function() {
  $('#myForm').submit(function(event) {
    event.preventDefault();
    // Validar alias
    const alias = $('#alias').val();
    if (alias.length <= 5 || !/[a-zA-Z]/.test(alias) || !/[0-9]/.test(alias)) {
      alert('El alias debe ser mayor a 5 caracteres y contener al menos una letra y un número.');
      return;
    }
    // Validar RUT
    var rut = $('#rut').val();
    if (!validarRut(rut)) {
      alert('El RUT ingresado no es válido.');
      return;
    }
    // Enviar formulario
    alert('Formulario enviado correctamente.');
    $(this).unbind('submit').submit();
  });

  function validarRut(rut) {
  // primero eliminar puntos y guion del rut para luego verificar el formato 
  rut = rut.replace(/[.-]/g, '');
  if (!/^\d{7,8}[0-9kK]$/.test(rut)) {
    return false;
  }
  //comprovador de dígito verificador
  const dv = rut.slice(-1).toUpperCase();
  //para obtener los dígitos numéricos del RUT:
  const rutNum = parseInt(rut.slice(0, -1), 10);
  // luego verificar que coincida el dv con el calculo 
  let suma = 0;
  let factor = 2;
  let resto;
  let digitoEsperado;
  for (let i = rutNum.toString().length - 1; i >= 0; i--) {
    suma += parseInt(rutNum.toString().charAt(i), 10) * factor;
    factor = factor === 7 ? 2 : factor + 1;
  }
  resto = suma % 11;
  digitoEsperado = resto === 0 ? '0' : resto === 1 ? 'K' : (11 - resto).toString();
  return dv === digitoEsperado;
  }
});
</script>
<!-- Metodo de almacenamiento de datos del formulario -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include("conector.php");

  //Almacenamos los datos del formulario
  $nombreYApellido = $_POST['nombreYApellido'];
  $alias = $_POST['alias'];
  $email = $_POST['email'];
  $rut = $_POST['rut'];
  $regionId = $_POST['regionId'];
  $comunaId = $_POST['comunas'];
  if (isset($_POST['comunas'])) {
  $comunaNombre = $_POST['comunas'];
  $sql = "SELECT id FROM comunas WHERE nombre = '$comunaNombre'";
  $result = $conn->query($sql);
//verificador de La clave fornanea de cada comuna(su region)
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $comunaId = $row['id'];
  } else {
    echo "Error al obtener el ID de la comuna.";
    exit; 
  }
} else {
  echo "No se seleccionó una comuna.";
  exit;
}
  $candidatoId = $_POST['candidato'];
  $seEntero = $_POST['seEntero'];
  //Verificador de que los campos requeridos estén completos
  if (!empty($nombreYApellido) && !empty($rut) && !empty($regionId) && !empty($comunaId) && !empty($candidatoId)) {

  // Consulta para verificar si el RUT ya está registrado
    $consultaRut = "SELECT * FROM formulario WHERE rut = '$rut'";
    $resultRut = $conn->query($consultaRut);
    if ($resultRut->num_rows > 0) {
  //mensaje cuando el rut ya ha sido ingresado
      echo "El RUT ya ha sido registrado previamente.";
    } else {
  // Consulta SQL para insertar los datos del formulario en la base de datos
      $consultaInsert = "INSERT INTO formulario (nombre_apellido, alias, email, rut, region_id, comuna_id, candidato_id) 
                   VALUES ('$nombreYApellido', '$alias', '$email', '$rut', '$regionId', '$comunaId', '$candidatoId')";

      if ($conn->query($consultaInsert) === TRUE) {
        echo "¡Tu voto ha sido registrado correctamente!";
      } else {
        echo "Error al registrar el voto: " . $conn->error;
      }
    }
  } else {
    //comprobar que existen todos los datos
    echo "Debes completar todos los campos requeridos.";
  }

  $conn->close();
}
?>
<!-- Script para manejar el evento de cambio del select de regiones -->
<script>
$(document).ready(function() {
  $('#regiones').change(function() {
    const regionId = $(this).val();
    if (regionId !== '') {
      // EL AJAX QUE VINCULA LAS REGIONES CON SUS COMUNAS 
      $.ajax({
        url: 'comunas.php',
        type: 'POST',
        data: { regionId: regionId },
        success: function(response) {
          $('#comunas').html(response);
        },
        error: function() {
          alert('Error al obtener las comunas');
        }
      });
    } else {
      $('#comunas').empty().append('<option value="">Seleccione una región primero</option>');
    }
  });
});
</script>

</body>
</html>
