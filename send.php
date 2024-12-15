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
?>
