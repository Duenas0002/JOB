<?php

require 'vendor/autoload.php'; 

// Cargar las variables de entorno
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host = getenv('host');
$username = getenv('username');
$password = getenv('password');
$database = getenv('database');
$port = getenv('port');
$table = getenv('table');

// Datos recibidos desde el formulario
$ClientName = $_POST['ClientName'];
$ClientEmail = $_POST['ClientEmail'];
$CompanyName = $_POST['CompanyName'];
$TeamMembers = $_POST['TeamMembers'];
$CompanyURL = $_POST['CompanyURL'];

// Crear una conexión
$conn = mysqli_connect($host, $username, $password, $database, $port);

// Verificar la conexión
if (!$conn) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Escapar variables para evitar inyecciones SQL
$ClientName = mysqli_real_escape_string($conn, $ClientName);
$ClientEmail = mysqli_real_escape_string($conn, $ClientEmail);
$CompanyName = mysqli_real_escape_string($conn, $CompanyName);
$TeamMembers = mysqli_real_escape_string($conn, $TeamMembers);
$CompanyURL = mysqli_real_escape_string($conn, $CompanyURL);

// Crear la consulta SQL
$sql = "INSERT INTO $table (ClientName, ClientEmail, CompanyName, TeamMembers, CompanyURL) 
        VALUES ('$ClientName', '$ClientEmail', '$CompanyName', '$TeamMembers', '$CompanyURL')";

// Ejecutar la consulta
if (mysqli_query($conn, $sql)) {
    echo "Registro insertado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Cerrar la conexión
mysqli_close($conn);

if ($TeamMembers===1){
    echo "Sorry, we consider you an unqualified leader";
}else{
    echo "            <!-- Calendly inline widget begin -->
<div class='calendly-inline-widget' data-url='https://calendly.com/d/cqpj-2nr-t5v/test001' style='min-width:320px;height:700px;'></div>
<script type='text/javascript' src='https://assets.calendly.com/assets/external/widget.js' async></script>
<!-- Calendly inline widget end -->";
}
?>
