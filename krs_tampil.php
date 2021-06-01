<!doctype html>
<?php
include('koneksi.php');
require_once('head.php');

?>
<body>
    <?php
    require_once('leftpanel.php');
    ?>

    <div id="right-panel" class="right-panel">
        <?php
            require_once('header.php');
        ?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Peserta Kelas</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active"><i class="fa fa-dashboard"></i></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">

            <div class="animated fadeIn">
            <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <strong>Data Peserta Kelas</strong>
                </div>
                <div class="pull-right">
                    <a href="krs_tambah.php" class="btn btn-success btn-sm"> 
                        <i class="fa fa-plus">Add</i>
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive">
    

    <table class="table table-bordered">
    <thead>
    <tr>
            <th>No</th>
            <th>Kelas</th>
            <th>Nama</th>
            <th>Aksi</th>
    </tr>
    </thead>
    <?php
            $no = 1;
            $koneksi = new mysqli ("localhost","root","","si_absensi");
            $sql = mysqli_query($koneksi, "SELECT * from krs join kelas on kelas.kelas_id=krs.kelas_id join mahasiswa on mahasiswa.mahasiswa_id=krs.mahasiswa_id");
            

            while ($data = $sql->fetch_assoc()){
    ?>  
    <tr>
        <td><?php echo $no++;?></td>
        <td><?php echo $data['nama_matkul'];?></td>
        <td><?php echo $data['nama'];?></td>
        <td>
            <a href="krs_hapus.php?id=<?php echo $data['krs_id'];?>"><button class="btn btn-danger">Delete</button></a>       
        </td>
    </tr>
    <?php 
    }
    ?>
</table>
   