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
    <br><br><br><br>
    <div id="container" class="container">
    <h2>SELECT WHAT YOU WANT TO DO:</h2>
        <div class="menu" class="col-md-10 col-sm-12">
            <input type="button" value="Request Documents" onclick="window.location.href='request_documents.php'">
            <input type="button" value="Cancel Request" onclick="window.location.href='cancel_request.php'">
            <input type="button" value="Borrow Documents" onclick="window.location.href='borrow_documents.php'">
            <input type="button" value="Return Documents" onclick="window.location.href='return_documents.php'">
            <br><br><h2>REPORTS</h2>
            <input type="button" value="Consult Members" onclick="window.location.href='search_members.php'">
            <input type="button" value="Consult Documents" onclick="window.location.href='search_documents.php'">
            <input type="button" value="Requested Documents" onclick="window.location.href='requested_documents.php'">
            <input type="button" value="Borrowed Documents" onclick="window.location.href='borrowed_documents.php'">
            <input type="button" value="Late Loans" onclick="window.location.href='late_loans.php'">
        </div>
    </div>
</body>
</html>