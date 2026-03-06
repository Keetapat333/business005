<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration11</title>
</head>

<body>

    <h1>Add Customer</h1>
    <form action="addcounty.php" method="POST">

        <label for="">CountryCode</label>
        <input type="text" Name="CountryCode">
        <br><br>
        <label for="">CountryName</label>
        <input type="text" Name="CountryName">

        <input type="submit">

    </form>
</body>

</html>


<!--  -->

<?php
if (isset($_POST['CountryCode']) && isset($_POST['CountryName'])) :
    echo "<br>" . $_POST['CountryCode'] . $_POST['CountryName'];

    require 'connect.php';

    $sql = "insert into country values(:CountryCode,:CountryName)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':CountryCode', $_POST['CountryCode']);
    $stmt->bindParam(':CountryName', $_POST['CountryName']);


    if ($stmt->execute()) :
        $message = 'Suscessfully add new Country';
    else :
        $message = 'Fail to add new Country';
    endif;
    echo $message;
    $conn = null;
endif;
?>