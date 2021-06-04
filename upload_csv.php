<!DOCTYPE html>

<?php
include('koneksi.php');
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
                        <h1> Detail Kehadiran</h1>
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
                    <strong>Data Kehadiran Pertemuan</strong>
                </div>
                <div class="pull-right">
                    <a href="pertemuan_tampil.php" class="btn btn-success btn-sm"> 
                        <i class="fa">Back</i>
                    </a>
                </div>
        </div>

<?php
require_once('head.php');

$kelas_id = 1;
$pertemuan_id = $_GET['pertemuan_id'];

if (isset($_POST["upload"])) {

    $file_tmp = $_FILES["file"]["tmp_name"];
    $file_nama = $_FILES["file"]["name"];
    $format_file = 'csv';
    $ekstensi_file = explode('.', $file_nama);
    $ekstensi_file = strtolower(end($ekstensi_file));

    if ($ekstensi_file != $format_file) {
        $type = "error";
        $message = "File tidak berformat <b>.csv</b>";
    } 
        else {

        if ($_FILES["file"]["size"] > 0) {

            $file = fopen($file_tmp, "r");
            $skipLines = 7;
            $lineNum = 1;
            
            while (fgetcsv($file)) {
                if ($lineNum > $skipLines) {
                    break;
                }
                $lineNum++;
            }

            while (($column = fgetcsv($file, 1000, ";")) !== FALSE) {

                if (isset($column[1])) {
                    $kolom_join = $column[1];
                    $split_join = preg_split('/[, ]/', $kolom_join);
                    $jam_masuk = $split_join[2];
                }

                if (isset($column[2])) {
                    $kolom_leave = $column[2];
                    $split_leave = preg_split('/[, ]/', $kolom_leave);
                    $jam_keluar = $split_leave[2];
                }

                if (isset($column[4])) {
                    $kolom_email = $column[4];
                    $nim = substr($kolom_email, 0, 10);

                    $statement = $db->prepare("SELECT krs.krs_id FROM krs JOIN mahasiswa ON krs.mahasiswa_id = mahasiswa.mahasiswa_id WHERE krs.kelas_id = ? AND mahasiswa.nim = ?");
                    $statement->bind_param('is', $kelas_id, $nim);
                    $statement->execute();
                    $res = $statement->get_result();
                    $col = $res->fetch_assoc();
                    $krs_id = $col['krs_id'];
                }

                $join = strtotime($jam_masuk);
                $leave = strtotime($jam_keluar);
                $durasi = $leave - $join;

                $sqlInsert = "INSERT INTO absensi (krs_id, pertemuan_id, jam_masuk, jam_keluar, durasi) VALUES (?, ?, ?, ?, ?)";
                $statement = $db->prepare($sqlInsert);
                $statement->bind_param('iissi', $krs_id, $pertemuan_id, $jam_masuk, $jam_keluar, $durasi);
                $statement->execute();

                if ($db->affected_rows > 0) {
                    $type = "success";
                    $message = "Data absensi berhasil diupload";
                }
                else {
                    $type = "error";
                    $message = "Terjadi masalah dalam upload file";
                }
            }
        }
    }
}

$stmt = $db->prepare("SELECT * FROM absensi INNER JOIN krs ON absensi.krs_id = krs.krs_id INNER JOIN mahasiswa ON krs.mahasiswa_id = mahasiswa.mahasiswa_id WHERE absensi.pertemuan_id = ? AND krs.kelas_id = ?");
$stmt->bind_param('ii', $pertemuan_id, $kelas_id);
$stmt->execute();
$result = $stmt->get_result();

$stm = $db->prepare("SELECT * FROM absensi RIGHT JOIN krs ON absensi.krs_id = krs.krs_id RIGHT JOIN mahasiswa ON krs.mahasiswa_id = mahasiswa.mahasiswa_id WHERE krs.kelas_id = 1 AND krs.krs_id NOT IN (SELECT absensi.krs_id FROM absensi JOIN krs ON absensi.krs_id = krs.krs_id WHERE absensi.pertemuan_id = ? AND krs.kelas_id = ?)");
$stm->bind_param('ii', $pertemuan_id, $kelas_id);
$stm->execute();
$rslt = $stm->get_result();

?>

    <div class="row">
        <div class="col-5">
            <div id="response" class="<?php if (!empty($type) && $type == "success") {
                                            echo $type . " display-block alert alert-success";
                                        } 
                                        else if (!empty($type) && $type == "error") {
                                            echo $type . " display-block alert alert-danger";
                                        }
                                        ?>">
                <?php
                if (!empty($message)) echo $message; 
                ?>
            </div>
        </div>
    </div>

    <div class="row mb-2">
        <label for="file" class="form-label"><i></i></label>
        <div class="col-5">
            <form action="" method="post" name="upload_csv" id="upload_csv" enctype="multipart/form-data">
                <input type="file" class="form-control" id="file" name="file" accept=".csv">
        </div>
        <div class="col">
            <button type="submit" id="submit" name="upload" class="btn btn-primary"><i class="bi bi-file-earmark-arrow-up"></i>Upload</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nama Mahasiswa</th>
                        <th scope="col">Jam Masuk</th>
                        <th scope="col">Jam Keluar</th>
                        <th scope="col">Durasi</th>
                        <th scope="col">Status Kehadiran</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    while ($row = $result->fetch_assoc()) : 
                    ?>
                        
                        <?php
                        $hours = floor($row['durasi'] / 3600);
                        $minutes = floor(($row['durasi'] / 60) % 60);
                        $seconds = $row['durasi'] % 60;
                        ?>

                        <tr>
                            <td><?= $row['nama']; ?></td>
                            <td><?= $row['jam_masuk']; ?></td>
                            <td><?= $row['jam_keluar']; ?></td>
                            <td><?php if ($hours != 0) echo $hours . "h " ?>
                                <?php if ($minutes != 0) echo $minutes . "m " ?>
                                <?php if ($seconds != 0) echo $seconds . "s " ?>
                            </td>
                            <td><?= 'Hadir' ?></td>
                        </tr>

                    <?php 
                    endwhile; 
                    ?>

                    <?php
                     if (mysqli_num_rows($result) > 0) : 
                    ?>

                    <?php 
                     while ($data = $rslt->fetch_assoc()) : 
                    ?>

                            <tr>
                                <td><?= $data['nama']; ?></td>
                                <td><?= $data['jam_masuk']; ?></td>
                                <td><?= $data['jam_keluar']; ?></td>
                                <td><?= $data['durasi']; ?></td>
                                <td><?= 'Tidak Hadir' ?></td>
                            </tr>

                        <?php
                         endwhile;
                        ?>

                    <?php
                     endif;
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>