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

$dados_unid = "SELECT * FROM unidade ORDER BY id ";
$lista_unid = mysqli_query($conn, $dados_unid);
if(($lista_unid) and ($lista_unid->num_rows != 0)){
	while ($row_unid = mysqli_fetch_assoc($lista_unid)) {
		$html .= '<tr>:';
		$html .= '<td>' . $row_unid['id'] . '</td>';
		$html .= '<td>' . $row_unid['proprietario_unid'] . '</td>';
		$html .= '<td>' . $row_unid['condominio_unid'] . '</td>';
		$html .= '<td>' . $row_unid['endereco_unid'] . '</td>';
		$html .= '<td><button id="'.$row_unid['id'].'" onclick="abre_unid(\'A\','.$row_unid['id'].')">Despesas</button></td>';
		$html .= '<td><button id="'.$row_unid['id'].'" onclick="abre_unid(\'A\','.$row_unid['id'].')">Editar</button></td>';
		$html .= '<td><button id="'.$row_unid['id'].'" onclick="remover_unid(\'E\','.$row_unid['id'].')">Remover</button></td>';
		$html .= '</tr>';

	}
	echo json_encode($html);

}else{
	echo "nenhum dado encontrado";
}
?>
