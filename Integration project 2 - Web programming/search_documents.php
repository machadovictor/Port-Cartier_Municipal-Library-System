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
        <h2>LIST OF DOCUMENTS:</h2>
        <table border="1">
            <tr>
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
                    WHERE title LIKE '%$search%' 
                    OR author LIKE '%$search%' 
                    OR category_name LIKE '%$search%' 
                    OR doc_type_name LIKE '%$search%' 
                    OR genre_name LIKE '%$search%' 
                    OR descrip LIKE '%$search%'
                    AND doc_status LIKE 'Available' ";
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