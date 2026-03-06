<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration11</title>
</head>

<body>

    <h1>Add Customer</h1>
    <form action="addcustomer.php" method="POST">

        <label for="">CustomerID</label>
        <input type="text" Name="CustomerID">
        <br><br>
        <label for="">Name</label>
        <input type="text"
            Name="Name">
        <br><br>
        <label for="">Birthdate</label>
        <input type="date"
            Name="Birthdate">
        <br><br>
        <label for="">Email</label>
        <input type="email"
            Name="Email">
        <br><br>
        <label for="">CountryCode</label>
        <input type="text"
            Name="CountryCode">
        <br><br>
        <label for="">OutstandingDebt</label>
        <input type="number"
            Name="OutstandingDebt">
        <input type="submit">

    </form>
</body>

</html>

<?php
if (isset($_POST['CustomerID']) && isset($_POST['Name'])) :
    echo "<br>" . $_POST['CustomerID'] . $_POST['Name'] . $_POST['Birthdate'] . $_POST['Email'] .
        $_POST['CountryCode'] . $_POST['OutstandingDebt'];

    require 'connect.php';

    $sql = "insert into customer values(:CustomerID,:Name,:Birthdate,:Email,:CountryCode, :OutstandingDebt)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':CustomerID', $_POST['CustomerID']);
    $stmt->bindParam(':Name', $_POST['Name']);
    $stmt->bindParam(':Birthdate', $_POST['Birthdate']);
    $stmt->bindParam(':Email', $_POST['Email']);
    $stmt->bindParam(':CountryCode', $_POST['CountryCode']);
    $stmt->bindParam(':OutstandingDebt', $_POST['OutstandingDebt']);

    if ($stmt->execute()) :
        $message = 'Suscessfully add new customer';
    else :
        $message = 'Fail to add new customer';
    endif;
    echo $message;
    $conn = null;
endif;
?>