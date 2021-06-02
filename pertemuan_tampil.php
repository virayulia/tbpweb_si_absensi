<!DOCTYPE HTML>
<?php
include('koneksi.php');
require_once('head.php');
?>

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
                        <h1>Pertemuan Kelas</h1>
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
                    <strong>Data Pertemuan Kelas</strong>
                </div>
                <div class="pull-right">
                    <a href="pertemuan_tambah.php" class="btn btn-success btn-sm"> 
                        <i class="fa fa-plus">Add</i>
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive">
    
    <table class="table table-bordered">
    <thead>
    <tr>
            <th>No</th>
            <th>Kode Kelas</th>
            <th>Pertemuan Ke</th>
            <th>Tanggal</th>
            <th>Materi</th>
            <th>Kehadiran</th>
    </tr>
    </thead>
    <?php
            $no = 1;
            //$koneksi = new mysqli ("localhost","root","","si_absensi");
            $sql = mysqli_query($db, "SELECT pertemuan.pertemuan_ke, pertemuan.tanggal, pertemuan.materi, kelas.kode_kelas from pertemuan inner join kelas on kelas.kelas_id=pertemuan.kelas_id WHERE kelas.kelas_id= '".$_GET['kelas_id']."' ");
            
            while ($data = $sql->fetch_assoc()){
    ?>  
    <tr>
        <td><?php echo $no++;?></td>
        <td><?php echo $data['kode_kelas'];?></td>
        <td><?php echo $data['pertemuan_ke'];?></td>
        <td><?php echo $data['tanggal'];?></td>
        <td><?php echo $data['materi'];?></td>
        <td>
            <a href="upload_csv.php?pertemuan_id=<?= $row['pertemuan_id']; ?>" class="btn btn-primary">Detail</a>
        </td>
    </tr>
    <?php 
    }
    ?>
</table>