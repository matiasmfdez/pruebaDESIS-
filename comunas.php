<?php
include("conector.php");

// Obtén el ID de la región seleccionada
$regionId = $_POST['regionId'];

// Realiza la consulta SQL para obtener las comunas de cada región
$sql = "SELECT nombre FROM comunas WHERE idRegion = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $RegionId);
$stmt->execute();

// almacena el resultado de la consulta
$result = $stmt->get_result();
// poblando el selector de comunas
$comunasOptions = '';
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $comunasOptions .= '<option value="' . $row['nombre'] . '">' . $row['nombre'] . '</option>';
  }
} else {
  $comunasOptions .= '<option value=""> No hay comunas disponibles</option>';
}
$stmt->close();
$conn->close();
echo $comunasOptions;
?>
