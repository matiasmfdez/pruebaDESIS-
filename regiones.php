<?php <
include("conector.php");
$sql = "SELECT nombre_region, idRegion FROM regiones";
$result = $conn->query($sql);
// Verificar si hay resultados
if ($result->num_rows > 0) {
    // almacena los datos de las regiones
    $regiones = array();
    // Recorrer los resultados y almacenarlos en el arreglo
    while ($row = $result->fetch_assoc()) {
        $regiones[] = $row;
    }
    $regiones_json = json_encode($regiones);
    echo $regiones_json;
} else {
    echo "No se encontraron regiones.";
}
?>

