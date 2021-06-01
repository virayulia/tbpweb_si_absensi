<!-- hapus peserta kelas-->
<?php

include('koneksi.php');
$id = $_GET['id'];
$sql = $db->query("DELETE from krs where krs_id='$id'");

header("Location: krs_tampil.php");