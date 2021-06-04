<!DOCTYPE html>
<html>
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

<?php

include('koneksi.php');
require_once('head.php');


    if (isset($_POST['submit'])) {
        $pertemuan_ke = $_POST['pertemuan_ke'];
        $kelas_id = $_POST['kelas_id'];
        $pertemuan_ke = $_POST['pertemuan_ke'];
        $tanggal = $_POST['tanggal'];
        $materi = $_POST['materi'];

            $query = mysqli_query($db,"SELECT max(pertemuan_id) as kodeTerbesar FROM pertemuan");
            $data = mysqli_fetch_array($query);
            $urutan = $data['kodeTerbesar'];
        
            $urutan++; 
            $pertemuan_id = $urutan;
            
            $result = mysqli_query($db,"INSERT INTO pertemuan VALUES('$pertemuan_id','$kelas_id','$pertemuan_ke','$tanggal','$materi')") or die(mysqli_error($db));
            
            if ($result > 0) {
                echo "
                <script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'pertemuan_tampill.php';
                </script>
                ";
            } else {
                echo "
                <script>
                alert('Data gagal ditambahkan!');
                document.location.href = 'pertemuan_tampill.php';
                </script>
                ";
            }
         
        }
?>

            <div class="animated fadeIn">
            <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <strong>Tambah Pertemuan Kelas</strong>
                </div>
                <div class="pull-right">
                    <a href="pertemuan_tampill.php" class="btn btn-success btn-sm"> 
                        <i class="fa">Back</i>
                    </a>
                </div>
            </div>



            <div class="card-body table-responsive">
            <form action="" method="post">

            <div class="mb-3"> 
                <label class="form-label">Kode Kelas</label>
             <br>
             <select name="kelas_id" class="form-control">
             <option value="null" disabled selected> </option>
                <?php
                $query = $db->query("SELECT * from kelas");
            
                while ($qtabel = $query->fetch_assoc())
                {
                    if($qtabel['kode_kelas']==$data->kelas_id){
                    echo '<option value="'.$qtabel['kelas_id'].'" selected>'.$qtabel['kode_kelas'].'</option>';             
                    }else{
                    echo '<option value="'.$qtabel['kelas_id'].'">'.$qtabel['kode_kelas'].'</option>';              
                    }
                }
                ?>
            </select>
            </div>
            <div class="mb-3"> 
                <label for="pertemuan_ke" class="form-label">Pertemuan ke</label>
                <input type="text" class="form-control" name="pertemuan_ke" autocomplete="off" required >
            </div>

            <div class="mb-3"> 
                <label for="tanggal_pertemuan" class="form-label">Tanggal</label>
                <input type="date" class="form-control" name="tanggal" autocomplete="off" required >
            </div> 

            <div class="mb-3"> 
                <label for="materi" class="form-label">Materi</label>
                <input type="text" class="form-control" name="materi" autocomplete="off" required >
            </div> 

        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form> 
    </div>
</div>
</div>

</body>
</html>