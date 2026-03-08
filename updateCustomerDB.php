<?php
require "connect.php";
// ตัวอัพเดตข้อมูล
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql_update = "UPDATE customer SET Name = :Name, Birthdate = :Birthdate, Email = :Email, OutstandingDebt = :OutstandingDebt, CountryCode = :CountryCode WHERE CustomerID = :CustomerID";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bindParam(':CustomerID', $_POST['CustomerID']);
    $stmt_update->bindParam(':Name', $_POST['Name']);
    $stmt_update->bindParam(':Birthdate', $_POST['Birthdate']);
    $stmt_update->bindParam(':Email', $_POST['Email']);
    $stmt_update->bindParam(':OutstandingDebt', $_POST['OutstandingDebt']);
    $stmt_update->bindParam(':CountryCode', $_POST['CountryCode']);
    $stmt_update->execute();
    echo "<p>ข้อมูลลูกค้าถูกอัปเดตเรียบร้อยแล้ว</p>";
}   
$sql_c = "SELECT *
    FROM customer,country
    WHERE customer.countrycode = country.countrycode
    AND CustomerID = :CID";  
$stmt_customer = $conn->prepare($sql_c);
$stmt_customer->bindParam(':CID', $_GET['CustomerID']);
$stmt_customer->execute();
$result_customer = $stmt_customer->fetch(PDO::FETCH_ASSOC);


$sql_country = "SELECT * from Country";
$stmt_c = $conn->prepare($sql_country);
$stmt_c->execute();
$cc = $stmt_c->fetchAll();


?>
<!DOCTYPE html>
<html lang="en"> 

<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>updatecustomer.php</title> 
     
</head> 


<body>
    <h2>แก้ไขมูลลูกค้าเข้าฐานข้อมูล1</h2>
    <form action="updateCustomerDB.php" method="POST">
        <label>รหัสลูกค้า: </label>
        <input type="text" placeholder="กรุณากรอกรหัสลูกค้า" name="CustomerID"
            value="<?php echo $result_customer['CustomerID'] ?>">
        <br> <br>
        <label>ชื่อ นามสกุล: </label>
        <input type="text" name="Name" class="form-control" value="<?= $result_customer['Name'] ?>">
        <br> <br>
        <label>วันเกิด: </label>
        <input type="date" placeholder="กรุณากรอกวันเกิดลูกค้า" name="Birthdate"
            value="<?= $result_customer['Birthdate'] ?>">
        <br> <br>
        <label>Email: </label>
        <input type="email" placeholder="กรุณากรอกอีเมลล์ลูกค้า" name="Email" value="<?= $result_customer['Email'] ?>">
        <br> <br>
        <label>ยอดหนี้: </label>
        <input type="number" placeholder="กรุณากรอกยอดหนี้ลูกค้า" name="OutstandingDebt"
            value="<?= $result_customer['OutstandingDebt'] ?>">
        <br> <br>
        <label>กรุณาเลือกประเทศ: </label>
        <select name="CountryCode" id="CountryCode">


            <?php
            $selected = $result_customer['CountryName'];

            foreach ($cc as $c) {

                if ($selected == $c['CountryName']) {

                    echo '<option selected value="' . $c["CountryCode"] . '">' . $c["CountryName"] . '</option>';

                } else {

                    echo '<option value="' . $c["CountryCode"] . '">' . $c["CountryName"] . '</option>';

                }

            }  
            ?>


        </select>
        <br> <br>
        <input type="submit">
    </form>
</body>

</html>