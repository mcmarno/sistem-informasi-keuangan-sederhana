<?php
 
session_start();
 
if (empty($_SESSION['email'])){
 
    header('location:login.php');
}

// Create database connection using config file
?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> sistem informasi keuangan remaja masjid </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="css/vendor.css">
        <!-- Theme initialization -->
        <link rel="stylesheet" href="css/app.css">
    </head>
    <body>
        <div class="main-wrapper">
            <div class="app" id="app">
                <header class="header">
                    <div class="header-block header-block-collapse d-lg-none d-xl-none">
                        <button class="collapse-btn" id="sidebar-collapse-btn">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    
                    <div class="header-block header-block-nav">
                        <ul class="nav-profile">
                            <li class="profile dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <div class="img" style="background-image: url('https://avatars3.githubusercontent.com/u/3959008?v=3&s=40')"> </div>
                                    <span class="name"> Admin </span>
                                </a>
                                <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <a class="dropdown-item" href="logout.php">
                                        <i class="fa fa-power-off icon"></i> Logout </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </header>
                <aside class="sidebar">
                    <div class="sidebar-container">
                        <div class="sidebar-header">
                            <div class="brand">
                                <div class="logo">
                                    <span class="l l1"></span>
                                    <span class="l l2"></span>
                                    <span class="l l3"></span>
                                    <span class="l l4"></span>
                                    <span class="l l5"></span>
                                </div> SIK Remaja Masjid </div>
                        </div>
                        <nav class="menu">
                            <ul class="sidebar-menu metismenu" id="sidebar-menu">
                                <li class="">
                                    <a href="index.php">
                                        <i class="fa fa-home"></i> Beranda </a>
                                </li>
                                <li class="">
                                    <a href="keuangan.php">
                                        <i class="fa fa-bar-chart"></i> Laporan Keuangan </a>
                                </li>
                                <li class="">
                                    <a href="users.php">
                                        <i class="fa fa-users"></i> User </a>
                                </li>
                                <li class="">
                                    <a href="index.php">
                                        <i class="fa fa-phone"></i> Contact </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <footer class="sidebar-footer">
                        <ul class="sidebar-menu metismenu" id="customize-menu">
                            <li>
                                <a href="logout.php">
                                    <i class="fa fa-power-off"></i> Logout </a>
                            </li>
                        </ul>
                    </footer>
                </aside>
                <div class="sidebar-overlay" id="sidebar-overlay"></div>
                <div class="sidebar-mobile-menu-handle" id="sidebar-mobile-menu-handle"></div>
                <div class="mobile-menu-handle"></div>
                <div class="title-block">
                    <h1 class="title"> Responsive Tables </h1>
                    <p class="title-description"> When blocks aren't enough </p>
                </div>
                <section class="section">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="card-title-block">
                                            <h3 class="title"> Laporan Keuangan </h3>
                                            <?php
                                            include_once("config.php");
                                            if(isset($_GET['cari'])){
                                            $cari1 = $_GET['cari1'];
                                            $cari2 = $_GET['cari2'];
                                            $kredit = mysqli_query($conn, "SELECT SUM(kredit) AS jumlah FROM tb_kas WHERE tanggal BETWEEN '$cari1' AND '$cari2' ");
                                            $debit = mysqli_query($conn, "SELECT SUM(debit) AS jumlah FROM tb_kas WHERE tanggal BETWEEN '$cari1' AND '$cari2' ");  

                                            }else{
                                                $kredit = mysqli_query($conn, "SELECT SUM(kredit) AS jumlah FROM tb_kas"); 
                                                $debit = mysqli_query($conn, "SELECT SUM(debit) AS jumlah FROM tb_kas");      
                                            }
                                            
                                            $datakredit = mysqli_fetch_array($kredit);
                                            $datadebit = mysqli_fetch_array($debit);
                                            $a = $datadebit['jumlah'];
                                            $b = $datakredit['jumlah'];
                                            $c = $a - $b;
                                            ?>
                                            <div class="col-4 col-sm-4 stat-col pull-right">
                                                <div class="stat-icon ">
                                                    <i class="fa fa-money "></i>
                                                </div>
                                                <div class="stat">
                                                    <div class="value"> <?php echo $c ?> </div>
                                                    <div class="name"> Saldo </div>
                                                </div>
                                            </div>
                                            <div class="col-4 col-sm-4 stat-col pull-right">
                                                <div class="stat-icon ">
                                                    <i class="fa fa-money "></i>
                                                </div>
                                                <div class="stat">
                                                    <div class="value"> <?php echo $datakredit['jumlah'] ?> </div>
                                                    <div class="name"> Kredit </div>
                                                </div>
                                            </div>
                                            <div class="col-4 col-sm-4 stat-col pull-right">
                                                <div class="stat-icon ">
                                                    <i class="fa fa-money "></i>
                                                </div>
                                                <div class="stat">
                                                    <div class="value"> <?php echo$datadebit['jumlah'] ?> </div>
                                                    <div class="name"> Debit </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div><a href="tambahkas.php"> <button class='btn btn-primary btn-sm fa fa-primary'> tambah data </button></a>
                                        </div>
                                        <form method="GET" name="cari" class="pull-left">
                                            <div class="row form-group">
                                                <div class="col-5">
                                                    <input type="date" class="form-control form-control-sm" placeholder="yyyy-mm-dd" name="cari1"> </div>sampai
                                                <div class="col-5">
                                                    <input type="date" class="form-control form-control-sm" placeholder="yyyy-mm-dd" name="cari2"> </div>
                                            </div>
                                        <div><button action="keuangan.php" type="submit" class="btn btn-info btn-sm fa fa-search pull-left" name="cari"> cari </button></div>
                                        <a href="keuangan.php"> <button class='btn btn-success btn-sm fa fa-refresh'> </button></a>
                                        </form>
                                        <form method="GET" name="cari" class="pull-right" action="./fpdf-table-wrap/index.php">
                                            <div class="row form-group">
                                                <div class="col-5">
                                                    <input type="date" class="form-control form-control-sm" placeholder="yyyy-mm-dd" name="cari1"> </div>sampai
                                                <div class="col-5">
                                                    <input type="date" class="form-control form-control-sm" placeholder="yyyy-mm-dd" name="cari2"> </div>
                                            </div>
                                        <div><button type="submit" class="btn btn-info btn-sm fa fa-download " name="cari"> pdf </button></div>
                                        </form>
                                        
                                        <?php
                                        include_once("config.php");
                                        // Fetch all users data from database
                                        if(isset($_GET['cari'])){
                                            $cari1 = $_GET['cari1'];
                                            $cari2 = $_GET['cari2'];
                                            $result = mysqli_query($conn, "SELECT * FROM tb_kas WHERE tanggal BETWEEN '$cari1' AND '$cari2' ORDER BY id_kas ASC");  

                                        }else{
                                            $result = mysqli_query($conn, "SELECT * FROM tb_kas ORDER BY id_kas ASC");       
                                        }
                                        ?>
                                    
                                        <div class="example">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>NO</th>
                                                            <th>Keterangan</th>
                                                            <th>Jenis</th>
                                                            <th>Tanggal</th>
                                                            <th>Debit</th>
                                                            <th>Kredit</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php  $no = 0;
                                                                while($data = mysqli_fetch_array($result)) {
                                                                    $tgl = $data['tanggal'];
                                                                    $tanggal = date('d-m-Y', strtotime($tgl));
                                                                    $no++;
                                                        echo"<tr>";
                                                            echo "<td>".$no."</td>";
                                                            echo "<td>".$data['keterangan']."</td>";
                                                            echo "<td>".$data['jenis']."</td>";
                                                            echo "<td>".$tanggal."</td>";
                                                            echo "<td>".$data['debit']."</td>";
                                                            echo "<td>".$data['kredit']."</td>";
                                                            echo "<td><a href='edit.php?id=$data[id_kas]'><button title='edit' class='btn btn-warning btn-sm fa fa-edit'> edit </button>
                                                                <button title='hapus' class='btn btn-danger btn-sm fa fa-trash'><a href='delete.php?id=$data[id_kas]'> hapus </button></td>";
                                                        echo"</tr>";
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </section>
   
                <footer class="footer">
                    <div></div>
                    <div class="footer-block author">
                        <ul>
                            <li> created with
                                <a href="#">Love</a>
                            </li>
                        </ul>
                    </div>
                </footer>
        <script>
            (function(i, s, o, g, r, a, m)
            {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function()
                {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
            ga('create', 'UA-80463319-4', 'auto');
            ga('send', 'pageview');
        </script>
        <script src="js/vendor.js"></script>
        <script src="js/app.js"></script>
    </body>
</html>
