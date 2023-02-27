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
        <input type="text" name="search" placeholder="Type what you want to search!">
        <input type="submit" value="Search">
        <h2>LIST OF DOCUMENTS AVAILABLES TO REQUEST:</h2>
        <table border="1">
            <tr>
                <th>Document ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Year</th>
                <th>Category</th>
                <th>Type</th>
                <th>Genre</th>
                <th>Description</th>
            </tr>
            <?php
                if(!isset($_GET['search'])) {
                    ?>
                <tr>
                    <td colspan="8">Enter the document you want to consult.</td>
                </tr>
                <?php
                } else {
                $search = $mysqli->real_escape_string($_GET['search']);
                $sql_code = "SELECT * 
                    FROM documents
                    WHERE doc_status = 'Available' 
                    OR doc_status = 'Borrowed'
                    AND (title LIKE '%$search%' 
                    OR author LIKE '%$search%' 
                    OR category_name LIKE '%$search%' 
                    OR doc_type_name LIKE '%$search%' 
                    OR genre_name LIKE '%$search%' 
                    OR descrip LIKE '%$search%')";
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
                        <td><?php echo $data['document_id']?></td>
                        <td style="text-align: left;padding-left:10px"><?php echo $data['title']?></td>
                        <td style="text-align: left;"><?php echo $data['author']?></td>
                        <td><?php echo $data['year']?></td>
                        <td><?php echo $data['category_name']?></td>
                        <td><?php echo $data['doc_type_name']?></td>
                        <td><?php echo $data['genre_name']?></td>
                        <td style="text-align: left;"><?php echo $data['descrip']?></td>
                    </tr>
                    <?php
                   }
                }     
            ?>
            <?php } ?>
        </table>
    </form><br>
    <h2>TO REQUEST A DOCUMENT, SELECT:</h2>
    <form method="POST">
        <div id="form_requestdoc">
            <label style="font-size: 14pt;text-align:left;">MEMBER ID:</label>
            <select id="select_memberId" name="select_memberId">
            <?php
            $sql = "SELECT user_code FROM users WHERE user_type_code = 'M'ORDER BY user_code ASC";
            $result = mysqli_query($mysqli,$sql);
            while ($row = mysqli_fetch_array($result)){
                echo "<option value='" . $row['user_code'] . "'>" . $row['user_code'] . "</option>";
            }
            ?>
            </select><br><br>
            <label style="font-size: 14pt;">DOCUMENT ID:</label>
            <select id="select_docId" name="select_docId">
            <?php
            $sql_doc = "SELECT document_id FROM documents WHERE doc_status = 'Available' OR doc_status = 'Borrowed' ORDER BY document_id ASC ";
            $result_doc = mysqli_query($mysqli,$sql_doc);
            while ($row = mysqli_fetch_array($result_doc)){
                echo "<option value='" . $row['document_id'] . "'>" . $row['document_id'] . "</option>";
            }
            ?>
            </select><br><br>
        </div>
    <input id="submit_request" name="submit_request"type="submit" value="Send Request"><br>
    <?php
        if(!empty($_POST['select_memberId']) && !empty($_POST['select_docId'])) {
            $member_code = $_POST['select_memberId'];
            $document_id = $_POST['select_docId'];
        if (isset($_POST['submit_request'])){
            $sql_requestdoc = "UPDATE documents SET doc_status = CASE 
                                                            WHEN doc_status = 'Available' THEN 'Requested'
                                                            WHEN doc_status = 'Borrowed' THEN 'Borrowed/Requested'
                                                        END 
                                                        WHERE document_id = '$document_id'";
            $result_request = mysqli_query($mysqli,$sql_requestdoc);
            $sql_requestdoc2 = "INSERT INTO requests (user_code, document_id, request_date) VALUES ('$member_code','$document_id', NOW())";
            $result_request2 = mysqli_query($mysqli,$sql_requestdoc2);
            echo '<script>alert("Request sent successfully!");</script>';
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