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
          <a class="nav-link text-white mr-5" data-toggle="tooltip" data-placement="bottom" title="ini adalah tab home" href="index.php">HOME <span class="sr-only">(current)</span></a>
        </li>
        <!-- <li class="nav-item ">
            <a class="nav-link text-white mr-5" href="list.php">LIST ANIME</a>
          </li> -->

        <li class="nav-item">
          <a class="nav-link text-white mr-5" data-toggle="tooltip" data-placement="bottom" title="ini adalah tab list anime" href="gallery_visitor.php">LIST ANIME</a>
        </li>
        <li class="nav-item active" style="text-decoration: underline;">
          <a class="nav-link text-white mr-5" data-toggle="tooltip" data-placement="bottom" title="ini adalah tab about me" href="about_visitor.php">ABOUT ME</a>
        </li>
        <li class="nav-item dropdown" data-toggle="tooltip" data-placement="right" title="ini adalah menu login">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class=" fas fa-user text-white"></i>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="login_user.php">User</a>
            <a class="dropdown-item" href="login.php">Admin</a>

          </div>
        </li>

      </ul>
      <!-- <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0 text-white" type="submit">Search</button> -->
      </form>
    </div>
  </nav>



  <!-- header -->
  <div class="jumbotron text-center">
    <img src="img/my.jpg">
    <h1>Huan Wendy Ariono</h1>
    <h4>L200180086</h4>

  </div>

  <!-- End of Header -->
  <!-- About Me -->
  <section id="about" class="about">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h2 class="text-center">About Me</h2>
          <hr>
        </div>
      </div>

      <div class="row ">
        <div class="col-md-6 col-md-offset-1 ">
          <p class="text-justify"><b>Nama saya adalah Huan Wendy Ariono. Saya adalah seorang mahasiswa di salah satu universitas terkenal di surakarta yaitu di Universitas Muhammadiyah Surakarta</b></p>
        </div>
        <div class="col-md-6">
          <p class="text-justify"> <b>Saya membuat web php ini dengan tujuan untuk memenuhi tugas akhir matakuliah pemrograman web dinamis yang diampu oleh Bu Maryam , S.Kom., M.Eng.</b></p>
        </div>
      </div>
    </div>
  </section>
  <!-- End of About me -->



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
          <div class="footer_sub_copyright"> Input <i class="fa-xs fas fa-circle"></i> Update <i class="fa-xs fas fa-circle"></i> Delete <i class="fa-xs fas fa-circle"></i> view <i class="fa-xs fas fa-circle"></i> Search <i class="fa-xs fas fa-circle"></i> ENJOY on this site</div>
        </div>
      </div>
  </footer>


  <!-- javascript -->
  <script type="text/javascript" src="js/popper.js"></script>
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
</body>

</html>