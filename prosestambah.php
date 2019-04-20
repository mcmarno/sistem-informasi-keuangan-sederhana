<?php
session_start();

    $id = $_POST['id_kas'];
    $keterangan = $_POST['keterangan'];
    $jenis = $_POST['jenis'];
    $tanggal = $_POST['tanggal'];
    $dana = $_POST['dana'];

        // include database connection file
    include_once("config.php");
    $query1 = "INSERT INTO tb_kas(id_kas, keterangan, jenis, tanggal, debit) VALUES('$id', '$keterangan','$jenis','$tanggal','$dana')";
    $query2 = "INSERT INTO tb_kas(id_kas, keterangan, jenis, tanggal, kredit) VALUES('$id', '$keterangan','$jenis','$tanggal','$dana')";

    if($jenis == "debit") {
        $tambah = $query1;
    }else{
        $tambah = $query2;
    }

        // Insert user data into table
    $result = mysqli_query($conn, "$tambah");


        // Show message when user added
    header("location:keuangan.php");
?>