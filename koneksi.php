<?php
session_start();
$db = new mysqli('localhost', 'root','','si_absensi');

if($db->connect_errno > 0){
	die('Koneksi gagal');
}
?>