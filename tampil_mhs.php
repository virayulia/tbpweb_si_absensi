<!doctype html>
<?php
include('koneksi.php');
require_once('head.php');

$username = $_SESSION['username'];
$sql = "SELECT * FROM kelas join krs on kelas.kelas_id = krs.kelas_id join mahasiswa on krs.mahasiswa_id = mahasiswa.mahasiswa_id WHERE mahasiswa.nim = '$username' ";


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
                        <h1></h1>
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
        <strong>Data Kelas</strong>
    </div>
</div>
<div class="card-body table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode Kelas</th>
                <th>Kode Matkul</th>
                <th>Nama Matkul</th>
                <th>Tahun</th>
                <th>Semester</th>
                <th>Sks</th>
                <th>Detail</th>
        
            </tr>
        </thead>
        <tbody>
            <?php
                if(!$result = $db->query($sql)){
                    die('Gagal Meminta Data');
                }
                while($row = $result->fetch_assoc()){
            ?>
                <tr>
                    <td><?php echo $row ['kode_kelas'] ?></td>
                    <td><?php echo $row ['kode_matkul'] ?></td>
                    <td><?php echo $row ['nama_matkul'] ?></td>
                    <td><?php echo $row ['tahun'] ?></td>
                    <td><?php echo $row ['semester'] ?></td>
                    <td><?php echo $row ['sks'] ?></td>
                    <td><a href="belom.php?kelas_id=<?= $row['kelas_id']; ?>" class="btn btn-primary">Detail</a>
                    </td>
                </tr>

        </tbody>
        <?php } ?>
    </table>
    </div>
</div>
</div>

</div>
            

        </div>
    </div>    

</body>
</html>