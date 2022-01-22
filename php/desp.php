<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "apcontrole";
$aux_op = (isset($_POST['aux_op']) ? $_POST['aux_op'] : '' );
$id = (isset($_POST['id']) ? $_POST['id'] : '' );
$descricao_desp = (isset($_POST['descricao_desp']) ? $_POST['descricao_desp'] : '' );
$tipo_desp = (isset($_POST['tipo_desp']) ? $_POST['tipo_desp'] : '' );
$vencimento_desp = (isset($_POST['vencimento_desp']) ? $_POST['vencimento_desp'] : '');
$valor_desp = (isset($_POST['valor_desp']) ? $_POST['valor_desp'] : '');
$status_desp = (isset($_POST['status_desp']) ? $_POST['status_desp'] : '');



$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

switch ($aux_op) {
  case 'I':
      $sql = "INSERT INTO despesa (
                  descricao_desp, tipo_desp, vencimento_desp, valor_desp,status_desp )
                  VALUES(
                    '{$descricao_desp}',
                    '{$tipo_desp}',
										'{$vencimento_desp}',
										'{$valor_desp}',
										'{$status_desp}'
                    )";
                    if ($conn->query($sql) === TRUE) {
                      $last_id = $conn->insert_id;
                      echo "New record created successfully. Last inserted ID is: " . $last_id;
      }

                    else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
      }
  break;
  case 'A':
    $sql="UPDATE despesa Set descricao_desp = '$descricao_desp',
            tipo_desp = '$tipo_desp',
						vencimento_desp = '$vencimento_desp',
						valor_desp = '$valor_desp',
						status_desp = '$status_desp'
             WHERE id = '$id'";
    var_dump($sql);
     if (mysqli_query($conn, $sql)) {
           echo "Record updated successfully";
     } else {
           echo "Error updating record: " . mysqli_error($conn);
    }
  break;
  case 'E':
      $sql = "DELETE FROM despesa WHERE id='$id'";
      if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
      } else {
        echo "Error deleting record: " . $conn->error;
      }

  break;
  default:

    $dados = [];

    $sql = "SELECT descricao_desp,
                   tipo_desp,
									 vencimento_desp,
									 valor_desp,
									 status_desp
              FROM despesa
              WHERE id = $id";

    $query = $conn->query($sql);

    if(!empty($query)) {
      while ($row_desp = mysqli_fetch_assoc($query)) {
        $dados['descricao_desp'] = $row_desp['descricao_desp'];
        $dados['tipo_desp'] = $row_desp['tipo_desp'];
				$dados['vencimento_desp'] = $row_desp['vencimento_desp'];
				$dados['valor_desp'] = $row_desp['valor_desp'];
				$dados['status_desp'] = $row_desp['status_desp'];
    	}
    }


    echo json_encode($dados);

  break;
}

$conn->close();

?>
