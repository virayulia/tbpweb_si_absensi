<!-- tambah peserta kelas-->

<?php

    include('koneksi.php');
    require_once('head.php');

    $krs = mysqli_query($db, 'SELECT * from krs');
    $kelas = mysqli_query($db,'SELECT * from kelas');
    $mahasiswa = mysqli_query($db,'SELECT * from mahasiswa');


if(isset($_POST['submit'])){
    $kelas_id = $_POST ['kelas_id'];
    $mahasiswa_id = $_POST ['mahasiswa_id'];
  

    if ($kelas_id!=null && $mahasiswa_id!=null){ //untuk cek apakah data telah diinputkan
        $ambil = mysqli_query($db,"SELECT mahasiswa_id FROM krs WHERE mahasiswa_id='$mahasiswa_id'"); //untuk select mahasiswa yang ingin dicek
        if ($ambil->num_rows>0){ // untuk cek apakah data mahasiswa sudah ada di db
            $take = mysqli_query($db,"SELECT kelas_id FROM krs WHERE kelas_id='$kelas_id' and mahasiswa_id=$mahasiswa_id"); // untuk select data kelas yang ingin dicek
            if ($take->num_rows>0){ // untuk cek apakah data kelas sudah ada di db
                $msg = 1;
            } 
            else{
                $create="INSERT into krs(kelas_id, mahasiswa_id) values('$kelas_id','$mahasiswa_id')";
                $sql = mysqli_query($db,$create);
                if ($sql){
                    $msg = 2;
                } 
            }
        }

        else {        
        $create="INSERT into krs(kelas_id, mahasiswa_id) values('$kelas_id','$mahasiswa_id')";
        $sql = mysqli_query($db,$create);
            if ($sql){
                $msg = 2;
            } 
        }
    }
    else {
    echo "<script> alert('Silahkan Isi data!'); document.location.href = 'krs_tambah.php'; </script>";
    }
}
?>

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


<?php
    if (isset($msg)){
        if($msg==1){
        ?>
            <div class="alert alert-warning">Data sudah ada!</div>
            <br>
        <?php
        } else if ($msg==2){
        ?>

        <script>
            alert('Data berhasil ditambahkan!');
            document.location.href = 'krs_tampil.php';
        </script>
        <br>
        <?php  
        }
    }
?>

            <div class="animated fadeIn">
            <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <strong>Tambah Peserta Kelas</strong>
                </div>
                <div class="pull-right">
                    <a href="krs_tampil.php" class="btn btn-success btn-sm"> 
                        <i class="fa">Back</i>
                    </a>
                </div>
            </div>



            <div class="card-body table-responsive">
            <form action="" method="post">
         
            <div class="mb-3"> 
            <label class="form-label">Kelas</label>
             <br>
             <select name="kelas_id" class="form-control">
             <option value="null" disabled selected> </option>
                <?php
                $query = $db->query("SELECT * from kelas");
            
                while ($qtabel = $query->fetch_assoc())
                {
                    if($qtabel['nama_matkul']==$data->kelas_id){
                    echo '<option value="'.$qtabel['kelas_id'].'" selected>'.$qtabel['nama_matkul'].'</option>';             
                    }else{
                    echo '<option value="'.$qtabel['kelas_id'].'">'.$qtabel['nama_matkul'].'</option>';              
                    }
                }
                ?>
            </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama</label>
             <br>
             <select name="mahasiswa_id" class="form-control">
             <option value="null" disabled selected> </option>
                <?php
                $query = $db->query("SELECT * from mahasiswa");
            
                while ($qtabel = $query->fetch_assoc())
                {
                    if($qtabel['nama']==$data->mahasiswa_id){
                    echo '<option value="'.$qtabel['mahasiswa_id'].'" selected>'.$qtabel['nama'].'</option>';             
                    }else{
                    echo '<option value="'.$qtabel['mahasiswa_id'].'">'.$qtabel['nama'].'</option>';              
                    }
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form> 
    </div>
</div>
</div>

</body>
</html>

