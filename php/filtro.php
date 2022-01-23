<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "apcontrole";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$pesquisar = $_POST['pesquisar'];
	 $result_cursos = "SELECT * FROM despesa WHERE propi_unid LIKE '%$pesquisar%' LIMIT 100";
	 $resultado_cursos = mysqli_query($conn, $result_cursos);

	 while($rows_cursos = mysqli_fetch_array($resultado_cursos)){
			 echo "Nome do curso: ".$rows_cursos['propi_unid']."<br>";
	 }
?>
