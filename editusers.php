<?php

session_start();

if (empty($_SESSION['email'])){

    header('location:login.php');
}

include "config.php";
$id = $_GET['id'];      //get the goods which will updated
$query = "SELECT * FROM tb_users WHERE id_users = '$id'";  //get the data that will be updated
$hasil = mysqli_query($conn, $query);
  //echo "hasil ==> ".$hasil;
$data  = mysqli_fetch_array($hasil);

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
                                    <a class="dropdown-item" href="#">
                                        <i class="fa fa-user icon"></i> Profil </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fa fa-gear icon"></i> Ganti Password </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="auth/login.php">
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
                <article class="content forms-page">
                 <section class="section">
                        <div class="row sameheight-container">
                            <div class="col-md-6">
                                <div class="card card-block sameheight-item">
                                    <div class="title-block">
                                        <h3 class="title"> Edit Data Pengguna </h3>
                                    </div>
                                    <form id="tambah-form" action="proseseditusers.php" method="POST">
                                        <div class="form-group">
                                            <label class="control-label">ID</label>
                                            <input type="text" class="form-control underlined" name="id_users" value="<?php echo $data['id_users'] ?>" readonly="readonly"></div>
                                        <div class="form-group">
                                            <label class="control-label">Nama</label>
                                            <input type="text" class="form-control underlined" name="nama" value="<?php echo $data['nama'] ?>"></div>
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="email" class="form-control underlined" name="email" value="<?php echo $data['email'] ?>"></div>
                                        <div class="form-group">
                                            <label class="control-label">Password</label>
                                            <input type="password" class="form-control underlined" placeholder="masukan password baru minimal 6 karakter "name="password"></div>
                                        <div class="form-group col-md-4" >
                                            <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </article>
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