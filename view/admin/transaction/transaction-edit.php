<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"]) && isset($_POST["status"])) {

    $id = $_POST["id"];
    $status = $_POST["status"];
    $sql = "UPDATE transactions SET status='$status' WHERE id = $id";

    try {
        if ($conn->query($sql) === true) {
            header("HTTP/1.1 200 OK");
            $response = "Transaction dengan ID $id berhasil update.";
        }
    } catch (\Throwable $th) {
        header("HTTP/1.1 400 Bad Request");
        $response = "Some error <br/>" . "<i style='font-size: 10px'>SQL : " . $th->getMessage() . "</i>";
    }

    echo $response;

    $conn->close();
}
