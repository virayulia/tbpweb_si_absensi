<?php
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include 'koneksi.php';

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// menyeleksi data user dengan username dan password yang sesuai
$sql = mysqli_query($db,"SELECT * FROM user,mahasiswa WHERE username='$username' and user.password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($sql);

// cek apakah username dan password di temukan pada database

if($cek > 0){

 $data = mysqli_fetch_assoc($sql);

 // cek jika user login sebagai admin
 if($data['level']=="admin"){

  // buat session login dan username
  $_SESSION['name'] = $data['nama'];
  $_SESSION['username'] = $username;
  $_SESSION['level'] = "admin";
  // alihkan ke halaman dashboard admin
  header("location:home.php");

 // cek jika user login sebagai mahasiswa
 }else if($data['level']=="mahasiswa"){
  // buat session login dan username
  $_SESSION['name'] = $data['nama'];
  $_SESSION['username'] = $username;
  $_SESSION['level'] = "mahasiswa";
  // alihkan ke halaman dashboard mahasiswa
  header("location:home.php");

 }else{

  // alihkan ke halaman login kembali
  header("location:index.php?pesan=gagal");
 } 
}else{
 header("location:index.php?pesan=gagal");
}

?>