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
    <title>Consulting Members</title>
</head>
<body>
    <h1>
        Welcome to Painel, <?php echo $_SESSION['user'];?>
        <br>
    </h1>
    <a href="logout.php">Logout</a>
    <a href="painel_E.php">Back to Menu</a>
    <br><br><br><br>
    <div id="container">
    
    <form method="post">
        <input type="text" name="search" placeholder="Make your consult by writing keywords.">
        <input type="submit" value="Search">
        <br>
        <h2>List of members:</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Member</th>
                <th>St. Number</th>
                <th>St. Name</th>
                <th>City</th>
                <th>Province</th>
                <th>Phone</th>
                <th>E-mail</th>
                <th>Details</th>
            </tr>
            <?php
                if(!isset($_GET['search'])) {
                    ?>
                <tr>
                    <td colspan="9">Enter the member you want to consult.</td>
                </tr>
                <?php
                } else {
                $search = $mysqli->real_escape_string($_GET['search']);
                $sql_code = "SELECT *
                    FROM users
                    WHERE user_type_code = 'M'
                    AND (user_code LIKE '%$search%' 
                    OR full_name LIKE '%$search%' 
                    OR street_number LIKE '%$search%' 
                    OR street_name LIKE '%$search%' 
                    OR city LIKE '%$search%' 
                    OR province LIKE '%$search%'
                    OR phone LIKE '%$search%' 
                    OR email LIKE '%$search%')";
                $sql_query = $mysqli->query($sql_code) or die("Query Error! " . $mysqli->error);

                if($sql_query->num_rows == 0) {
            ?>
            <tr>
                <td colspan="9">No results found!</td>
            </tr>
            <?php
                } else {
                   while ($data = $sql_query->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $data['user_code']?></td>
                        <td><?php echo $data['full_name']?></td>
                        <td><?php echo $data['street_number']?></td>
                        <td><?php echo $data['street_name']?></td>
                        <td><?php echo $data['city']?></td>
                        <td><?php echo $data['province']?></td>
                        <td><?php echo $data['phone']?></td>
                        <td><?php echo $data['email']?></td>
                        <td><input class="check" type="radio" name="select" onclick="<?php $test = $data['user_code']  ?>" value=<?php echo $data['user_code']?> ></td>
                    </tr>
                    <?php
                   }
                }     
            ?>
            <?php } ?>
        </table>
        <input class="button" type="submit" name="More" value="More">
    </form>
    </br>
    <?php 
        if(array_key_exists('More', $_POST)) {
            showDetails();
        }

        function showDetails() { ?>
            <table class="details-table"> <!-- style="display:none"; -->
            <thead>
                <tr>
                    <th>ID Detail</th>
                    <th>ID Document</th>
                    <th>Loan Date</th>
                    <th>Return Date</th>
                    <th>Loan Status</th>
                </tr>
            </thead>
            <tbody class="details-table-body">
            </tbody>
            <?php
                include ('conection.php');

                $sql_code = "SELECT * FROM loans WHERE user_code = '27'";
                $sql_query = $mysqli->query($sql_code) or die("Query Error! " . $mysqli->error);

                if($sql_query->num_rows == 0) {
            ?>
            <tr>
                <td colspan="5">No results found!</td>
            </tr>
            <?php
                } else {
                   while ($data2 = $sql_query->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $data2['user_code']?></td>
                        <td><?php echo $data2['document_id']?></td>
                        <td><?php echo $data2['loan_date']?></td>
                        <td><?php echo $data2['return_date']?></td>
                        <td><?php echo $data2['loan_status']?></td>
                    </tr>
                    <?php
                   }
                }     
            ?>
        </table>
        <?php }
    ?>
    </div>
</body>
</html>