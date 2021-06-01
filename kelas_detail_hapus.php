<!-- hapus peserta kelas-->
<?php

include('koneksi.php');
$mahasiswa_id = $_GET['mahasiswa_id'];
$kelas_id = $_GET['kelas_id'];
$sql = $db->query("DELETE from krs where kelas_id='$kelas_id' and mahasiswa_id='$mahasiswa_id'");

header("Location: kelas_detail.php?kelas_id=$kelas_id");