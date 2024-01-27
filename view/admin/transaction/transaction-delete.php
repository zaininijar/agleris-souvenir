<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {

    $id = $_POST["id"];
    $sql = "DELETE FROM transactions WHERE id = $id";

    try {
        if ($conn->query($sql) === true) {
            header("HTTP/1.1 200 OK");
            $response = "Transaction dengan ID $id berhasil dihapus.";
        }
    } catch (\Throwable $th) {
        header("HTTP/1.1 400 Bad Request");
        $response = "Some error <br/>" . "<i style='font-size: 10px'>SQL : " . $th->getMessage() . "</i>";
    }

    echo $response;

    $conn->close();
}
