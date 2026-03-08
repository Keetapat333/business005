<?php
require "connect.php";

if (isset($_GET['CustomerID'])) {

    $CustomerID = $_GET['CustomerID'];

    $stmt = $conn->prepare(
        "DELETE FROM customer WHERE CustomerID = :CustomerID"
    );

    $stmt->bindParam(':CustomerID', $CustomerID);

    $stmt->execute();

    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    echo '
    <script>
    $(document).ready(function(){
        swal({
            title: "Success!",
            text: "Delete customer successfully",
            type: "success",
            timer: 2000,
            showConfirmButton: false
        }, function(){
            window.location.href = "index.php";
        });
    });
    </script>';
}
?>