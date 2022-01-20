<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "apcontrole";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$html = '';

$dados_inq = "SELECT * FROM inquilino ORDER BY id ";
$lista_inq = mysqli_query($conn, $dados_inq);
if(($lista_inq) and ($lista_inq->num_rows != 0)){
	while ($row_inq = mysqli_fetch_assoc($lista_inq)) {
		$html .= '<tr>:';
		$html .= '<td>' . $row_inq['id'] . '</td>';
		$html .= '<td>' . $row_inq['nome_inq'] . '</td>';
		$html .= '<td>' . $row_inq['idade_inq'] . '</td>';
		$html .= '<td>' . $row_inq['sexo_inq'] . '</td>';
		$html .= '<td>' . $row_inq['telefone_inq'] . '</td>';
		$html .= '<td>' . $row_inq['email_inq'] . '</td>';
		$html .= '<td><button id="'.$row_inq['id'].'" onclick="abre_inq(\'A\','.$row_inq['id'].')">Editar</button></td>';
		$html .= '<td><button id="'.$row_inq['id'].'" onclick="remover_inq(\'E\','.$row_inq['id'].')">Remover</button></td>';
		$html .= '</tr>';

	}
	echo json_encode($html);

}else{
	echo "nenhum dado encontrado";
}
?>
