<?php
include ('conection.php');
include ('protect.php');
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
        <h2>LIST OF REQUESTED DOCUMENTS:</h2>
        <table border="1">
            <tr>
                <th>Request ID</th>
                <th>User ID</th>
                <th>Document ID</th>
                <th>Request Date</th>
            </tr>
            <?php
                $sql_code = "SELECT * 
                    FROM requests";
                $sql_query = $mysqli->query($sql_code) or die("Query Error! " . $mysqli->error);

                if($sql_query->num_rows == 0) {
            ?>
            <tr>
                <td colspan="8">No results found!</td>
            </tr>
            <?php
                } else {
                   while ($data = $sql_query->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $data['request_id']?></td>
                        <td><?php echo $data['user_code']?></td>
                        <td><?php echo $data['document_id']?></td>
                        <td><?php echo $data['request_date']?></td>
                    </tr>
                    <?php
                   }
                }     
            ?>
        </table>
    </form><br>
    <h2>TO CANCEL A REQUEST, SELECT:</h2>
    <form method="POST">
        <div id="form_requestdoc">
            <label style="font-size: 14pt;">DOCUMENT ID:</label>
            <select id="select_docId" name="select_docId">
            <?php
            $sql_doc = "SELECT document_id FROM requests ORDER BY document_id ASC ";
            $result_doc = mysqli_query($mysqli,$sql_doc);
            while ($row = mysqli_fetch_array($result_doc)){
                echo "<option value='" . $row['document_id'] . "'>" . $row['document_id'] . "</option>";
            }
            ?>
            </select><br><br>
        </div>
    <input id="cancel_request" name="cancel_request" type="submit" value="Cancel Request"><br>
    <?php
        if(!empty($_POST['select_docId'])) {
            $document_id = $_POST['select_docId'];
        if (isset($_POST['cancel_request'])){
            $sql_cancelrequestdoc = "UPDATE documents SET doc_status = 'Available' WHERE document_id = '$document_id'";
            $result_cancelrequest = mysqli_query($mysqli,$sql_cancelrequestdoc);
            $sql_cancelrequestdoc2 = "DELETE FROM requests WHERE document_id = '$document_id'";
            $result_cancelrequest2 = mysqli_query($mysqli,$sql_cancelrequestdoc2);
            echo '<script>alert("Request canceled successfully!");</script>';
        }};
        
    ?>
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