<?php 
    require_once("../connection.php");

    $sneaker_id = $_POST["sneaker_id"];

    $sql_select = "SELECT * FROM sneaker WHERE sneaker_id = $sneaker_id";
    $result = mysqli_query($connection, $sql_select);

    if (mysqli_num_rows($result) > 0) {
        $sql_delete = "DELETE FROM stock WHERE sneaker_id = $sneaker_id;
                       DELETE FROM sneaker WHERE sneaker_id = $sneaker_id";
        $result_delete = mysqli_multi_query($connection, $sql_delete);
        echo "Sneaker deleted successfully";

    } else {
        echo "Error: " . $sql_delete . "<br>" . mysqli_error($connection);
    }

?>