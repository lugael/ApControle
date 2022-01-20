<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "apcontrole";
$aux_op = (isset($_POST['aux_op']) ? $_POST['aux_op'] : '' );
$id = (isset($_POST['id']) ? $_POST['id'] : '' );
$nome_inq = (isset($_POST['nome_inq']) ? $_POST['nome_inq'] : '' );
$idade_inq = (isset($_POST['idade_inq']) ? $_POST['idade_inq'] : '' );
$sexo_inq = (isset($_POST['sexo_inq']) ? $_POST['sexo_inq'] : '');
$telefone_inq = (isset($_POST['telefone_inq']) ? $_POST['telefone_inq'] : '' );
$email_inq = (isset($_POST['email_inq']) ? $_POST['email_inq'] : '' );


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

switch ($aux_op) {
  case 'I':
      $sql = "INSERT INTO inquilino (
                  nome_inq, idade_inq, sexo_inq, telefone_inq, email_inq )
                  VALUES(
                    '{$nome_inq}',
                    '{$idade_inq}',
										'{$sexo_inq}',
                    '{$telefone_inq}',
                    '{$email_inq}'
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
    $sql="UPDATE inquilino Set nome_inq = '$nome_inq',
            idade_inq = '$idade_inq',
						sexo_inq = '$sexo_inq',
            telefone_inq = '$telefone_inq',
            email_inq = '$email_inq'
             WHERE id = '$id'";
    var_dump($sql);
     if (mysqli_query($conn, $sql)) {
           echo "Record updated successfully";
     } else {
           echo "Error updating record: " . mysqli_error($conn);
    }
  break;
  case 'E':
      $sql = "DELETE FROM inquilino WHERE id='$id'";
      if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
      } else {
        echo "Error deleting record: " . $conn->error;
      }

  break;
  default:

    $dados = [];

    $sql = "SELECT nome_inq,
                   idade_inq,
									 sexo_inq,
                   telefone_inq,
                   email_inq
              FROM inquilino
              WHERE id = $id";

    $query = $conn->query($sql);

    if(!empty($query)) {
      while ($row_inq = mysqli_fetch_assoc($query)) {
        $dados['nome_inq'] = $row_inq['nome_inq'];
        $dados['idade_inq'] = $row_inq['idade_inq'];
				$dados['sexo_inq'] = $row_inq['sexo_inq'];
        $dados['telefone_inq'] = $row_inq['telefone_inq'];
        $dados['email_inq'] = $row_inq['email_inq'];
    	}
    }


    echo json_encode($dados);

  break;
}

$conn->close();

?>
