<?php
include ('conection.php');
include ('protect.php');
$query = "UPDATE loans SET date_updated = NOW()";
$mysqli->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style_homepage.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <title>Port-Cartier Municipal Library</title>
</head>
<body>
    <h6 class="bg-dark-subtle">
        Welcome to Painel, <?php echo $_SESSION['user'];?>
        <br>
    </h6>
    <a href="logout.php">Logout</a>
    <a name="back" href="#" onclick="redirect()">Back to Menu</a>
    <br><br>
    <div id="container" class="container">
    <form action="">
        <h2>LIST OF BORROED DOCUMENTS:</h2>
        <table border="1">
            <tr>
                <th>Document ID</th>
                <th>User ID</th>
                <th>Loan Date</th>
                <th>Return Date</th>
                <th>Loan Status</th>
            </tr>
            <?php
                $sql_code = "SELECT * 
                    FROM loans";
                $sql_query = $mysqli->query($sql_code) or die("Query Error! " . $mysqli->error);

                if($sql_query->num_rows == 0) {
            ?>
            <tr>
                <td colspan="5">There are no borrowed documents!</td>
            </tr>
            <?php
                } else {
                   while ($data = $sql_query->fetch_assoc()) {
                    $return_date = $data['return_date'];
                    $date_updated = $data['date_updated'];
                    if($return_date < $date_updated) {
                        $loan_status = "Late";
                    } else {
                        $loan_status = "Valid";
                    }
                    $query = "UPDATE loans SET loan_status = '$loan_status' WHERE document_id = '".$data['document_id']."' ";
                    $mysqli->query($query);
                    ?>
                    <tr>
                        <td><?php echo $data['document_id']?></td>
                        <td><?php echo $data['user_code']?></td>
                        <td><?php echo $data['loan_date']?></td>
                        <td><?php echo $data['return_date']?></td>
                        <td><?php echo $loan_status?></td>
                    </tr>
                    <?php
                   }
                }     
            ?>
        </table>
    </form>
    </form>
    </div>
    <script>
        function redirect() {
            var user_type_code = "<?php echo $_SESSION['user_type_code']; ?>";
            if (user_type_code == "E") {
                window.location.href = "painel_E.php";
            } else if (user_type_code == "A") {
                window.location.href = "painel_A.php";
            }
        }
    </script>
</body>
</html>