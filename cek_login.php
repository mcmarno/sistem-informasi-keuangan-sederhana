<?php
// mengaktifkan session php
session_start();
 
// menghubungkan dengan koneksi
include 'config.php';
 
// menangkap data yang dikirim dari form
$email = $_POST['email'];
$pass = $_POST['password'];
$password = hash('sha256', $pass);
 
// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($conn,"select * from tb_users where email='$email' and password='$password'");
 
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);
 
if($cek > 0){
	$_SESSION['email'] = $email;
	$_SESSION['status'] = "login";
	header("location:index.php");
}else{
	header("location:login.php?pesan=gagal");
}
?>