<?php

  session_start();
  // membuat variabel untuk menampung data dari form edit
  $id= $_POST['id_kas'] ;
  $keterangan= $_POST['keterangan'];
	$jenis	= $_POST['jenis'];
	$tgl	= $_POST['tanggal'];
  $tanggal = date('Y-m-d', strtotime($tgl));
  $dana = $_POST['dana'];
	  //buat dan jalankan query UPDATE
  include_once("config.php");
    $query1 = "UPDATE tb_kas SET keterangan = '$keterangan', jenis = '$jenis', tanggal = '$tanggal', debit = '$dana', kredit = '' WHERE id_kas = '$id'";
    $query2 = "UPDATE tb_kas SET keterangan = '$keterangan', jenis = '$jenis', tanggal = '$tanggal', kredit = '$dana', debit = '' WHERE id_kas = '$id'";

    if($jenis == "debit") {
        $tambah = $query1;
    }else{
        $tambah = $query2;
    }

   $result = mysqli_query($conn, $tambah);

  //periksa hasil query apakah ada error
  if(!$result) {
    die ("Query gagal dijalankan: ".mysqli_errno($conn).
       " - ".mysqli_error($conn));
  }

header("location:keuangan.php");
?>