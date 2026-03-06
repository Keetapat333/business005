<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration11</title>
</head>

<body>

    <h1>Add Customer</h1>
    <form action="addcustomerDrapdown.php" method="POST">

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
        <select name="CountryCode">
            <option value="AT">ออสเตรีย</option>
            <option value="AU">Australia</option>
            <option value="BD">บังคลาเทศ</option>
            <option value="CN">China</option>
            <option value="FI">Finland</option>
            <option value="GL">Greenland</option>
            <option value="ID">อินเดีย</option>
            <option value="IT">อิตาลี</option>
            <option value="JP">Japan</option>
            <option value="MY">มาเลเชีย</option>
            <option value="PA">POKA</option>
            <option value="PH">ฟิลิปปินส์</option>
            <option value="PK">ปากีสถาน</option>
            <option value="RS">รัสเซีย</option>
            <option value="SG">Singapore</option>
            <option value="TH">ไทย</option>

        </select>
        <br><br>
        <label for="">OutstandingDebt</label>
        <input type="number"
            Name="OutstandingDebt">
        <input type="submit">

    </form>
</body>

</html>


<!--  -->

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