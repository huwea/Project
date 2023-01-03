<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login_user.php");
  
 
  exit;
}
require 'function.php';




if (isset($_SESSION["popup"])) {
   $username =$_SESSION['popup'];
  
}

if (isset($_COOKIE["popup"])) {
   $username =$_COOKIE['popup'];
  
}



          
       


$jumlahDataPerHalaman = 8;
$jumlahData = count(query("SELECT * FROM anime"));

$jumlahHalaman = ceil($jumlahData/$jumlahDataPerHalaman);

$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;

$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
$anime = query("SELECT * FROM anime LIMIT $awalData, $jumlahDataPerHalaman");

//jika tombol cari ditekan
if (isset($_POST["cari"])){
  $anime = cari($_POST["keyword"]);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style2.css">
    <link rel="stylesheet" type="text/css" href="fontawesome-free/css/all.min.css">

    <title>landingpage</title>
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
      <a class="navbar-brand" href="#">
      <img src="img/brand2.png" alt="" loading="lazy">
      </a>
      <!-- -light -->
      <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span><i class="fa fa-bars text-white" aria-hidden="true"></i></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto ml-auto">
          <li class="nav-item">
            <a class="nav-link text-white mr-5" data-toggle="tooltip" data-placement="bottom" title="ini adalah tab home" href="index_user.php">HOME <span class="sr-only">(current)</span></a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-white mr-5" data-toggle="tooltip" data-placement="bottom" title="ini adalah tab list anime" href="gallery_user.php" style="text-decoration: underline;">LIST ANIME</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white mr-5" data-toggle="tooltip" data-placement="bottom" title="ini adalah tab about me" href="about_user.php">ABOUT ME</a>
          </li>
          <li class="nav-item dropdown " data-toggle="tooltip" data-placement="right" title="ini adalah menu logout">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class=" fas fa-user text-white">&nbsp;<?=  $username; ?></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              
              <a class="dropdown-item" href="logout.php">LOGOUT</a>
              
            </div>
          </li>
          
        </ul>
        <form class="form-inline my-2 my-lg-0" method="post">
          <input class="form-control mr-sm-2" type="text" name="keyword" autofocus placeholder="Search" aria-label="Search" id="keyword">
          <button class="btn btn-outline-success my-2 my-sm-0 text-white" name="cari" type="submit" id="tombolcari">Search</button>
        </form>
        
        
      </div>
    </nav>

    <!-- CARD -->
    <div class="container-fluid bg-gallery" id="container">
      <!-- ROW -->
      <div class="row mx-auto ">

        <!-- for -->
        <?php  foreach($anime as $row)  : ?>

          <?php

            $long_string = $row["sinopsis"] ;
            $limited_string = limit_words($long_string, 20);

            $genres = $row["genres"] ;  
            $checked = explode(",", $genres);
            $studios = $row["studios"] ;
            $result = query("SELECT * FROM studios WHERE studios = '$studios'")[0];

          ?>
          <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card mr-auto ml-auto mt-5 card-view" >
              <img src="img/<?=$row["gambar"];?>"class="card-img-top" alt="...">
              <div class="card-body bg-dark">
                <h5 class="card-title "><?= $row["title"] ;?></h5>
                <p class="card-text text-white text-justify mt-2"><?= $limited_string;?></p>
                <i class="fas fa-star text-warning"></i>
                <i class="fas fa-star text-warning"></i>
                <i class="fas fa-star text-warning"></i>
                <i class="fas fa-star text-warning"></i>
                <i class="fas fa-star text-warning">&ensp;<?= $row["score"] ;?></i><br>
                <a href="#" class="btn btn-primary mt-2" data-target="#produk<?=$row["idanime"];?>" data-toggle="modal">Detail</a>
                
              </div>
            </div>
          </div>
           <!-- DETAIL -->
          <div class="modal fade" id="produk<?=$row["idanime"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Detail Informasi</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <!-- body modal -->
                <div class="modal-body">
                  <div class="row m-3">

                    <div class="col-md-12 text-center pb-5">
                      <img src="img/<?=$row["gambar"];?>" alt="" width="25%">
                    </div>
                    <div class="col-md-6 ">
                      
                      <h5 class="pt-3 ">Sinopsis</h5>
                      <p class="text-justify pt-1 pb-3"><?= $row["sinopsis"] ;?></p>
                    </div>

                    <div class="col-md-6 mt-2">
                      <!--  -->
                      <table class="table table-hover ">
                        <tr>
                          <th>Title</th>
                          <td><?= $row["title"] ;?></td>
                        </tr>
                        <tr>
                          <th>Type</th>
                          <td><?= $row["type"] ;?></td>
                        </tr>
                        <tr>
                          <th>Episodes</th>
                          <td><?= $row["episodes"] ;?></td>
                        </tr>
                        <tr>
                          <th>Status</th>
                          <td><?= $row["status"] ;?></td>
                        </tr>
                        <tr>
                          <th>Aired</th>
                          <td><?= date('d F Y', strtotime($row["aired"])) ;?></td>
                        </tr>
                        <tr>
                          <th>Premiered</th>
                          <td><?= $row["premiered"] ;?></td>
                        </tr>
                        
                        
                        <tr>
                          <th>Studios</th>
                          <td data-target="#studios_<?=$row["studios"];?>" data-toggle="modal" data-dismiss="modal"><a href="#"><?= $row["studios"] ;?></a></td>
                        </tr>
                        <tr>
                          <th>Source</th>
                          <td><?= $row["source"] ;?></td>
                        </tr>
                        <tr>
                          <th>Genres</th>
                          <td><?= $row["genres"] ;?></td>
                        </tr>
                        <tr>
                          <th>Duration</th>
                          <td><?= $row["duration"] ;?>  Menit</td>
                        </tr>
                        <tr>
                          <th>Score</th>
                          <td>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning">&ensp;<?= $row["score"] ;?></i><br>
                          </td>
                        </tr>  
                      </table>
                    </div>
                  <!-- end row body  -->
                  </div>
                <!-- body modal -->
                </div>
                <!-- footer modal -->
                <div class="modal-footer">
                  <a href="#" class="btn btn-danger" data-dismiss="modal">Kembali</a>
 
                <!-- end footer modal -->
                </div>

              </div>
            </div>
          </div>

          <!-- DETAIL Studios-->
          <div class="modal fade" id="studios_<?=$row["studios"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Detail Informasi</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <!-- body modal -->
                <div class="modal-body">
                  <div class="row m-3">

                    <div class="col-md-12 text-center pb-5">
                      <img src="img/<?=$result["gambarstudio"];?>" alt="" width="25%">
                    </div>
                    <div class="col-md-6 ">
                      
                      <h5 class="pt-3 ">Deskripsi</h5>
                      <p class="text-justify pt-1 pb-3"><?= $result["deskripsi"] ;?></p>
                    </div>

                    <div class="col-md-6 mt-2">
                      <!--  -->
                      <table class="table table-hover ">
                        <tr>
                          <th>Studios</th>
                          <td><?= $result["studios"] ;?></td>
                        </tr>
                        <tr>
                          <th>Jenis</th>
                          <td><?= $result["industri"] ;?></td>
                        </tr>
                        <tr>
                          <th>Kantor</th>
                          <td><?= $result["kantor"] ;?></td>
                        </tr>
                       
                        <tr>
                          <th>Didirikan</th>
                          <td><?= date('d F Y', strtotime($result["didirikan"])) ;?></td>
                        </tr>
                        <tr>
                          <th>Situs</th>
                          <td><?= $result["situs"] ;?></td>
                        </tr>
                        <tr>
                          <th>Karyawan</th>
                          <td><?= $result["karyawan"] ;?> Orang</td>
                        </tr>
   
                      </table>
                    </div>
                  <!-- end row body  -->
                  </div>
                <!-- body modal -->
                </div>
                <!-- footer modal -->
                <div class="modal-footer">
                  <a href="#" class="btn btn-danger" data-dismiss="modal">Kembali</a>
                  <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button> -->
                  
                <!-- end footer modal -->
                </div>

              </div>
            </div>
          </div>

        <!-- end for -->
        <?php endforeach; ?>
      <!-- ROW -->
      </div>
    <!-- END CARD -->
    </div>

    <!-- pagination -->
    <div class="container-fluid pt-5 pb-5 bg-pagination">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <ul class="pagination justify-content-center pagination-lg">
          

          <?php if ($halamanAktif > 1) : ?>
            <li class="page-item"><a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>" arial-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
            <!-- &lt; -->
          <?php endif; ?>

          <?php for($i =1; $i <= $jumlahHalaman; $i++) : ?>
            <?php if($i == $halamanAktif) : ?>
              <li class="page-item active"><a class="page-link" href="?halaman=<?= $i;  ?>"><?= $i; ?></a></li>
              
            <?php else : ?>
              <li class="page-item"><a class="page-link" href="?halaman=<?= $i;  ?>"><?= $i; ?></a></li>
              
            <?php endif; ?>

          <?php endfor; ?>

          <?php if ($halamanAktif < $jumlahHalaman) : ?>
            <li class="page-item"><a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>">Next</a></li>

          <?php endif; ?>
        </ul>
      </div>
    </div>

    <!-- HTML Bagian FOOTER.-->
    <footer class="text-white bg-dark">
      <div class="container">
        <div class="row footer">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center ">
            <i class="fa-2x fab fa-facebook-f ml-3 mr-3"></i>
            <i class="fa-2x fab fa-instagram ml-3 mr-3"></i>
            <i class="fa-2x fab fa-telegram-plane ml-3 mr-3"></i>
            <i class="fa-2x far fa-envelope ml-3 mr-3"></i>
            
          </div>
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="footer_garis"></div>
          </div>
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center text-white">
            <div class="footer_main_copyright"><i class="far fa-copyright"></i> HUAN WENDY ARIONO (l200180086) INI ADALAH WEBSITE UNTUK MEMENUHI PROJECT PRAKTIKUM WEB</div>
          </div>
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center text-white">
            <div class="footer_sub_copyright"> Input <i class="fa-xs fas fa-circle"></i> Update <i class="fa-xs fas fa-circle"></i> Delete <i class="fa-xs fas fa-circle"></i> view <i class="fa-xs fas fa-circle"></i> Search <i class="fa-xs fas fa-circle"></i>  ENJOY on this site</div>
          </div>
      </div>
    </footer>

    <!-- javascript -->
    <script type="text/javascript" src="js/popper.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="js/script_teori2.js"></script>
  </body>
</html>