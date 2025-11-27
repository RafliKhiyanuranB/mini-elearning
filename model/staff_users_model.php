<?php

function get_connection() {
    return mysqli_connect("localhost", "root", "", "elearning");
}

function get_all_users() {
    $conn = get_connection();
    $result = mysqli_query($conn, "SELECT * FROM users");

    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}
function get_user_by_id($id) {
    $conn = get_connection();
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
    return mysqli_fetch_assoc($result);
}

function insert_data_users(){
    $conn = get_connection();
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (name, email, role, password_hash) VALUES ('$name', '$email', '$role', '$password')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
