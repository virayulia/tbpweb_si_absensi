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
                    <strong>Tambah Kelas</strong>
                </div>
                <div class="pull-right">
                    <a href="kelas_tampil.php" class="btn btn-success btn-sm"> 
                        <i class="fa">Back</i>
                    </a>
                </div>
            </div>

            <div class="card-body table-responsive">
            <form action="" method="post">
                    <div class="mb-3"> 
                      <label for="kode_kelas" class="form-label">Kode Kelas</label>
                      <input type="text" class="form-control" name="kode_kelas" placeholder="Masukkan Kode Kelas" autocomplete='off' required>
                    </div>
                    <div class="mb-3">
                      <label for="kode-matkul" class="form-label">Kode Matkul</label>
                      <input type="text" class="form-control" name="kode_matkul" placeholder="Masukkan Kode Matkul" autocomplete='off' required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_matkul" class="form-label">Nama Matkul</label>
                        <input type="text" class="form-control" name="nama_matkul" placeholder="Masukkan Nama Matkul" autocomplete='off' required>
                      </div>
                      <div class="mb-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="text" class="form-control" name="tahun" placeholder="Masukkan Tahun Ajaran" autocomplete='off' required>
                      </div>
                      <div class="mb-3">
                        <label for="semester" class="form-label">Semester</label><br>
                        <input type="radio" name="semester" value="1"> Ganjil  
                        <input type="radio" name="semester" value="2"> Genap 
                      </div>
                      <div class="mb-3">
                        <label for="sks" class="form-label">Sks</label>
                        <input type="text" class="form-control" name="sks" placeholder="Masukkan Sks" autocomplete='off' required>
                      </div>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>
            </div>
            </div>
            </div>
    <?php 

    if (isset($_POST['submit'])) {
        $kode_kelas = $_POST['kode_kelas'];
        $kode_matkul = $_POST['kode_matkul'];
        $nama_matkul = $_POST['nama_matkul'];
        $tahun = $_POST['tahun'];
        $semester = $_POST['semester'];
        $sks = $_POST['sks'];

        $cek = mysqli_query($db , "SELECT kelas_id FROM kelas WHERE kelas_id='$kelas_id'");
         if(mysqli_fetch_assoc($cek)){    
            echo "
            <script>
            alert('ID Kelas sudah dipakai!!');
            </script> ";
         }
         else {
            $query = mysqli_query($db,"SELECT max(kelas_id) as kodeTerbesar FROM kelas");
            $data = mysqli_fetch_array($query);
            $urutan = $data['kodeTerbesar'];
        
            $urutan++; 
            $kelas_id = $urutan;
            
            $result = mysqli_query($db,"INSERT INTO kelas VALUES('$kelas_id','$kode_kelas','$kode_matkul','$nama_matkul','$tahun','$semester','$sks')") or die(mysqli_error($db));
            
            if ($result > 0) {
                echo "
                <script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'kelas_tampil.php';
                </script>
                ";
            } else {
                echo "
                <script>
                alert('Data gagal ditambahkan!');
                document.location.href = 'kelas_tampil.php';
                </script>
                ";
            }
         }
        }
        ?>

        </div>
    </div>    

</body>
</html>
