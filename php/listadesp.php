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

$dados_desp = "SELECT * FROM despesa ORDER BY id ";
$lista_desp = mysqli_query($conn, $dados_desp);
if(($lista_desp) and ($lista_desp->num_rows != 0)){
	while ($row_desp = mysqli_fetch_assoc($lista_desp)) {
		$html .= '<tr>:';
		$html .= '<td>' . $row_desp['id'] . '</td>';
		$html .= '<td>' . $row_desp['descricao_desp'] . '</td>';
		$html .= '<td>' . $row_desp['tipo_desp'] . '</td>';
		$html .= '<td>' . $row_desp['vencimento_desp'] . '</td>';
		$html .= '<td>' . $row_desp['valor_desp'] . '</td>';
		$html .= '<td>' . $row_desp['status_desp'] . '</td>';
		$html .= '<td><button id="'.$row_desp['id'].'" onclick="abre_edi_desp(\'A\','.$row_desp['id'].')">Editar</button></td>';
		$html .= '<td><button id="'.$row_desp['id'].'" onclick="remover_desp(\'E\','.$row_desp['id'].')">Remover</button></td>';
		$html .= '</tr>';

	}
	echo json_encode($html);

}else{
	echo "nenhum dado encontrado";
}
?>
