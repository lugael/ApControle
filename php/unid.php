<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "apcontrole";
$aux_op = (isset($_POST['aux_op']) ? $_POST['aux_op'] : '' );
$id = (isset($_POST['id']) ? $_POST['id'] : '' );
$proprietario_unid = (isset($_POST['proprietario_unid']) ? $_POST['proprietario_unid'] : '' );
$condominio_unid = (isset($_POST['condominio_unid']) ? $_POST['condominio_unid'] : '' );
$endereco_unid = (isset($_POST['endereco_unid']) ? $_POST['endereco_unid'] : '');



$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

switch ($aux_op) {
  case 'I':
      $sql = "INSERT INTO unidade (
                  proprietario_unid, condominio_unid, endereco_unid )
                  VALUES(
                    '{$proprietario_unid}',
                    '{$condominio_unid}',
										'{$endereco_unid}'
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
    $sql="UPDATE unidade Set proprietario_unid = '$proprietario_unid',
            condominio_unid = '$condominio_unid',
						endereco_unid = '$endereco_unid'
             WHERE id = '$id'";
    var_dump($sql);
     if (mysqli_query($conn, $sql)) {
           echo "Record updated successfully";
     } else {
           echo "Error updating record: " . mysqli_error($conn);
    }
  break;
  case 'E':
      $sql = "DELETE FROM unidade WHERE id='$id'";
      if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
      } else {
        echo "Error deleting record: " . $conn->error;
      }

  break;
  default:

    $dados = [];

    $sql = "SELECT proprietario_unid,
                   condominio_unid,
									 endereco_unid
              FROM unidade
              WHERE id = $id";

    $query = $conn->query($sql);

    if(!empty($query)) {
      while ($row_inq = mysqli_fetch_assoc($query)) {
        $dados['proprietario_unid'] = $row_inq['proprietario_unid'];
        $dados['condominio_unid'] = $row_inq['condominio_unid'];
				$dados['endereco_unid'] = $row_inq['endereco_unid'];
    	}
    }


    echo json_encode($dados);

  break;
}

$conn->close();

?>
