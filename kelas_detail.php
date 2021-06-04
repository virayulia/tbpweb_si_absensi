<!DOCTYPE html>
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
                        <h1>Kelas</h1>
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
                    <strong>Detail Kelas</strong>
                </div>
                <div class="pull-right">
                    <a href="kelas_tampil.php" class="btn btn-success btn-sm"> 
                        <i class="fa">Back</i>
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive">
    

    <table class="table table-bordered">
    <thead>
    <tr>
            <th>No</th>
            <th>Kode Kelas</th>
            <th>Nama</th>
            <th>Nim</th>
            <th> </th>
            <th>Pertemuan-ke</th>
            <th> </th>
    </tr>
    </thead>
    <?php
            $no = 1;
            $db = new mysqli ("localhost","root","","si_absensi");
            $sql = mysqli_query($db, "SELECT * from krs join kelas on kelas.kelas_id=krs.kelas_id join mahasiswa on mahasiswa.mahasiswa_id=krs.mahasiswa_id join pertemuan on pertemuan.kelas_id=kelas.kelas_id WHERE kelas.kelas_id='".$_GET['kelas_id']."' ");
            
            while ($data = $sql->fetch_assoc()){
    ?>  
    <tr>
        <td><?php echo $no++;?></td>
        <td><?php echo $data['kode_kelas'];?></td>
        <td><?php echo $data['nama'];?></td>
        <td><?php echo $data['nim'];?></td>
        <td>
            <a href="kelas_detail_hapus.php?kelas_id=<?php echo $data['kelas_id'];?> & mahasiswa_id=<?php echo $data['mahasiswa_id'];?>"><button class="btn btn-danger">Delete</button></a>       
        </td>
        <td><?php echo $data['pertemuan_ke'];?></td>
        <td>
            <a href="pertemuan_tampil.php?kelas_id=<?php echo $data['kelas_id'];?> & mahasiswa_id=<?php echo $data['mahasiswa_id'];?> & pertemuan_id=<?php echo $data['pertemuan_id'];?>"><button class="btn btn-primary">Detail</button></a>       
        </td>
    </tr>
    <?php 
    }
    ?>
</table>
   
