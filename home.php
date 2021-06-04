<!doctype html>
<?php
session_start();
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
                        <h1>Dashboard</h1>
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

        <div class="content mt-3" align="center">

            <div class="animated fadeIn">
                <h1><b>Selamat Datang</b></h1> <br>
                <img src="images/home.jpg"  >

            </div>

            </div>

        </div>

    </div>    

</body>
</html>