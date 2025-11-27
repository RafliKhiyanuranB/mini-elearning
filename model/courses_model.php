<?php

function get_connection() {
    return mysqli_connect("localhost", "root", "", "elearning");
}

function get_all_courses() {
    $conn = get_connection();
    $result = mysqli_query($conn, "SELECT * FROM courses");

    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function courses_delete() {
    $id = $_GET['id'];

    $sql = "DELETE FROM pelanggan WHERE id_pelanggan='$id'";

    if($sql){
        header("Location: index.php");
    }else{
        echo "Gagal menghapus data";
    }
}
