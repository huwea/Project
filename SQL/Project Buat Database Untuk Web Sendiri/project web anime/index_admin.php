<?php  

session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  
 
  exit;
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

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog" arialabelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" >
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-tittle">HAY</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
        <?php  
          date_default_timezone_set('Asia/Jakarta');
          //ambil jam dan menit
          $jam = date('H:i');
          //atur salam menggunakan IF
          if ($jam > '05:30' && $jam < '10:00') {
              $salam = 'Pagi';
          } elseif ($jam >= '10:00' && $jam < '15:00') {
              $salam = 'Siang';
          } elseif ($jam < '18:00') {
              $salam = 'Sore';
          } else {
              $salam = 'Malam';
          }

          if (isset($_SESSION["popup"])) {
             $username =$_SESSION['popup'];
            
          }

          if (isset($_COOKIE["popup"])) {
             $username =$_COOKIE['popup'];
            
          }


         
          echo "<h6>Selamat $salam, $username</h6>";
          
        ?> 
        </div>

        <div class="modal-footer">
          
          <button type="button" class="btn-primary" data-dismiss="modal">OKE</button>
        </div>
      </div>
    </div>
  </div>

    


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
  	      <li class="nav-item active" style="text-decoration: underline;">
  	        <a class="nav-link text-white mr-5" data-toggle="tooltip" data-placement="bottom" title="ini adalah tab home" href="index_admin.php">HOME <span class="sr-only">(current)</span></a>
  	      </li>

  	      <li class="nav-item">
  	        <a class="nav-link text-white mr-5" data-toggle="tooltip" data-placement="bottom" title="ini adalah tab input data" href="input.php">INPUT DATA</a>
  	      </li>
          <li class="nav-item">
            <a class="nav-link text-white mr-5" data-toggle="tooltip" data-placement="bottom" title="ini adalah tab list anime" href="gallery.php">LIST ANIME</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white mr-5" data-toggle="tooltip" data-placement="bottom" title="ini adalah tab about me" href="about.php">ABOUT ME</a>
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

  	  </div>
  	</nav>

  	<!-- carousel -->
  	<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
  	  <ol class="carousel-indicators">
  	    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
  	    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
  	    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
  	  </ol>
  	  <div class="carousel-inner">
  	    <div class="carousel-item active">
  	      <img src="img/slider1.jpg" class="d-block w-100 h-100" alt="...">
  	      <div class="carousel-caption d-none d-lg-block">
  	        <h1 class="display-4">SELAMAT DATANG <span class="font-weight-bold"><br>DI WEBSITE DATABASE ANIME</span></h1>
            <p class="lead ">menampilan semua data berkaitan dengan anime</p>
              
  	      </div>
  	    </div>
  	    <div class="carousel-item">
  	      <img src="img/slider2.jpg" class="d-block w-100 h-100" alt="...">
  	      <div class="carousel-caption d-none d-md-block">
  	        <h1 class="display-4">DISINI MENAMPILKAN <span class="font-weight-bold"><br>SEMUA JUDUL ANIME</span></h1>
            <p class="lead ">disemua genre dan zaman</p>
  	      </div>
  	    </div>
  	    <div class="carousel-item">
  	      <img src="img/slider3.jpg" class="d-block w-100 h-100" alt="...">
  	      <div class="carousel-caption d-none d-md-block">
  	        <h1 class="display-4 ">DAPATKAN INFORMASI  <span class="font-weight-bold"><br>SEPUTAR DETAIL ANIME</span></h1>
            <p class="lead ">baik sinopsi, rating, keterangan studio dan lain-lain</p>
  	      </div>
  	    </div>
  	  </div>
  	  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
  	    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
  	    <span class="sr-only">Previous</span>
  	  </a>
  	  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
  	    <span class="carousel-control-next-icon" aria-hidden="true"></span>
  	    <span class="sr-only">Next</span>
  	  </a>
  	</div>

    <!-- HTML Bagian FEATURE -->    
    <div class="container-fluid">
    
      <div class="row  feature_header ">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="feature_header_text_main">MY WEB FEATURES FOR ADMIN</div>
              <div class="feature_header_text_sub">WEB INI MEMILIKI BEBERAPA FITUR </div>
          </div>
      </div>
<!-- END container -->
    </div>

    <div class="container-fluid">
      <div class="row  feature_content text-center"><!-- mx-auto -->
          <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 card-main ">
            <div class="card-light">
              <i class="fa-3x fa fa-plus-square card-img-top mb-5" aria-hidden="true"></i>
              
              <div class="card-body">
                <h5 class="card-title">INPUT</h5>
                <p class="card-text text-justify ">Admin dapat menginputkan data berkaitan dengan anime di menu input</p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 card-main">
            <div class="card-light">
              <i class="fa-3x fa fa-trash card-img-top mb-5" aria-hidden="true"></i>
              <div class="card-body">
                <h5 class="card-title">DELETE</h5>
                <p class="card-text text-justify">Admin dapat mengihapus data berkaitan dengan anime di menu list anime</p>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 card-main">
            <div class="card-light">
              <i class="fa-3x fa fa-search-plus card-img-top mb-5" aria-hidden="true"></i>
              <div class="card-body">
                <h5 class="card-title">SEARCH</h5>
                <p class="card-text text-justify">Admin dapat mencari data berkaitan dengan anime di menu list anime bagian search</p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 card-main">
            <div class="card-light">
              <i class="fa-3x fa fa-file card-img-top mb-5" aria-hidden="true"></i>
              <div class="card-body">
                <h5 class="card-title">UPDATE</h5>
                <p class="card-text text-justify">Admin dapat menginputkan data untuk mengupdate data lama di menu update</p>
              </div>
            </div>
          </div>  
      </div>
      
<!-- END container -->
    </div>

    <!-- HTML Bagian FEATURE -->    
    <div class="container-fluid">
    
      <div class="row  feature_header ">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="feature_header_text_main">MY WEB FEATURES FOR USER AND VISITOR</div>
              <div class="feature_header_text_sub">WEB INI MEMILIKI BEBERAPA FITUR </div>
          </div>
      </div>
<!-- END container -->
    </div>

    <div class="container-fluid">
      <div class="row  feature_content text-center">
          <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 card-main">
            <div class="card-light">
              
              <div class="card-body">
                
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 card-main">
            <div class="card-light">
              <i class="fa-3x fa fa-search-plus card-img-top mb-5" aria-hidden="true"></i>
              <div class="card-body">
                <h5 class="card-title">SEARCH</h5>
                <p class="card-text text-justify">User dan Visitor dapat mencari data berkaitan dengan anime di menu list anime bagian search</p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 card-main">
            <div class="card-light">
              <i class="fa-3x fas fa-eye card-img-top mb-5" aria-hidden="true"></i>

              <div class="card-body">
                <h5 class="card-title">VIEW</h5>
                <p class="card-text text-justify">User dan Visitor dapat melihat data anime di menu list anime dan menu lainnnya yang tersedia  </p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 card-main">
            <div class="card-light">
              
              <div class="card-body">
                
              </div>
            </div>
          </div>

      </div>
      
<!-- END container -->
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

    <script>
       $(document).ready(function () {

        if (document.cookie.indexOf("ModalShown=true")<0) {
            $("#myModal").modal("show");
            $("#myModalClose").click(function () {
                $("#myModal").modal("hide");
            });
            document.cookie = "ModalShown=true; expires=1";
        }
    });

    </script>
    
  </body>
</html>