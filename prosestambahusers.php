<?php
session_start();

    $id = $_POST['id_users'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $password = hash('sha256', $pass);

        // include database connection file
    include_once("config.php");
    $query = "INSERT INTO tb_users(id_users, nama, email, password) VALUES('$id', '$nama','$email','$password')";

        // Insert user data into table
    $result = mysqli_query($conn, "$query");


        // Show message when user added
    header("location:users.php");
?>