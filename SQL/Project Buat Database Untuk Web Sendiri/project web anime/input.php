<?php 
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  
 
  exit;
}
require 'function.php';
if (isset($_SESSION["popup"])) {
    $username =$_SESSION['popup'];
            
}

if (isset($_COOKIE["popup"])) {
   $username =$_COOKIE['popup'];
  
}

//koneksi ke DBMS 
$conn = mysqli_connect("localhost", "root","","cobaanime");
//cek apakah tombol submit sudah diklik atau belum
if( isset($_POST["submit"])){
  // var_dump($_POST);//data nya dikirim dihalam ini sendiri karena action nya kosong
  //ambil data dari tiap element dalam form
  $title = $_POST["title"];
  $type = $_POST["type"];
  $episodes = $_POST["episodes"];
  $status = $_POST["status"];
  $aired = $_POST["aired"];
  $premiered = $_POST["premiered"];
  $studios = $_POST["studios"];
  $source = $_POST["source"];
  $genres= implode(",", $_POST["genres"]);
  $duration = $_POST["duration"];
  $score = $_POST["score"];
  $sinopsis = $_POST["sinopsis"];
  //UPLOAD GAMBAR
  $gambar = upload();

  if(!$gambar){
    return false;
  }

//query insert data
$query = "INSERT INTO anime VALUES('', '$title', '$type', '$episodes', '$status', '$aired', '$premiered', '$studios', '$source', '$genres', '$duration', '$score', '$sinopsis', '$gambar') ";

mysqli_query($conn, $query);

  //cek apakah data berhasil ditambahkan atau tidak
  // var_dump(mysqli_affected_rows($conn));//bila berhasil ditambahkan akan menghasilkan int 1 , tapi apabila gagal akan menghasilkan int -1
  if( mysqli_affected_rows($conn) > 0){
    echo "
      <script>
        alert('data berhasil ditambahkan!');
        document.location.href = 'gallery.php';
      </script>
    ";
  }else {
    echo "
      <script>
        alert('data gagal ditambahkan!');
        document.location.href = 'gallery.php';
      </script>
    ";
  }



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
  	        <a class="nav-link text-white mr-5" data-toggle="tooltip" data-placement="bottom" title="ini adalah tab home" href="index_admin.php">HOME <span class="sr-only">(current)</span></a>
  	      </li>
  	      
  	      <li class="nav-item active"  style="text-decoration: underline;">
  	        <a class="nav-link text-white mr-5" data-toggle="tooltip" data-placement="bottom" title="ini adalah tab input data" href="input.php">INPUT DATA</a>
  	      </li>
          <li class="nav-item">
            <a class="nav-link text-white mr-5" data-toggle="tooltip" data-placement="bottom" title="ini adalah tab list anime" href="gallery.php">LIST ANIME</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white mr-5" data-toggle="tooltip" data-placement="bottom" title="ini adalah tab about me" href="about.php">ABOUT ME</a>
          </li>
          <li class="nav-item dropdown" data-toggle="tooltip" data-placement="right" title="ini adalah menu logout">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class=" fas fa-user text-white">&nbsp;<?=  $username; ?></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              
              <a class="dropdown-item" href="logout.php">LOGOUT</a>
              
            </div>
          </li>
  	      
  	    </ul>
  	    <!-- <form class="form-inline my-2 my-lg-0">
  	      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
  	      <button class="btn btn-outline-success my-2 my-sm-0 text-white" type="submit">Search</button>
  	    </form> -->
  	  </div>
  	</nav>

    <div class="container-fluid bg-input">
      <div class="row mr-auto ml-auto p-5">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
        </div>  
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
         <h2 class="text-center mt-3">INPUTKAN DATA ANIME</h2>
            <form action="" name="" method="post" enctype="multipart/form-data" onsubmit="return !!( isCheckedpremiered() & isCheckedgenres() & isCheckedstatus() & isCheckedduration() & isCheckedtype());">
              <div class="form-group">
                <label> Title </label>
                <input type="text" name="title" class="form-control" placeholder="Masukkan title" autofocus required>
              </div>
              <div class="form-group">
                <label> Type </label>
                <div style="visibility:hidden; color:red; display: inline;" id="chk_option_error_type">
                Please select at least one option.
                </div>
                <table border="0" cellpadding="5" cellspacing="0">
                  <tr>
                    <td>
                      <div class="form-check-inline">
                        <input type="radio" class="form-check-input" value="tv" name="type" id="tv">
                        <label for="tv">tv</label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check-inline">
                        <input type="radio" class="form-check-input" value="movie" name="type" id="movie">
                        <label for="movie">movie</label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check-inline">
                        <input type="radio" class="form-check-input" value="streaming" name="type" id="streaming">
                        <label for="streaming">streaming</label>
                      </div>
                    </td>
                  </tr>
                </table>
              </div>
              <div class="form-group">
                <label> Episodes</label>
                <input type="number" name="episodes" class="form-control" placeholder="Masukkan Episodes" required>       
              </div>
              <div class="form-group">
                <label> Status</label>
                <div style="visibility:hidden; color:red;  display: inline;" id="chk_option_error_status">
                Please select at least one option.
                </div>
                <table border="0" cellpadding="5" cellspacing="0">
                  <tr>
                    <td>
                      <div class="form-check-inline">
                        <input type="radio" class="form-check-input" value="ongoing" name="status" id="ongoing">
                        <label for="ongoing">ongoing</label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check-inline">
                        <input type="radio" class="form-check-input" value="finished" name="status" id="finished">
                        <label for="finished">finished</label>
                      </div>
                    </td>
                  </tr>
                </table> 
                           
              </div>
              <div class="form-group">
                <label> Aired</label>
                <input type="date" name="aired" name="aired" class="form-control" placeholder="Masukkan Aired" required>       
              </div>
              <div class="form-group">
                
                <label> Premiered</label>
                <div style="visibility:hidden; color:red;  display: inline;" id="chk_option_error_premiered">
                Please select at least one option.
                </div>
                <table border="0" cellpadding="5" cellspacing="0">
                  <tr>
                    <td>
                      <div class="form-check-inline">
                        <input type="radio" class="form-check-input" value="spring" name="premiered" id="spring">
                        <label for="spring">spring</label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check-inline">
                        <input type="radio" class="form-check-input" value="summer" name="premiered" id="summer">
                        <label for="summer">summer</label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check-inline">
                        <input type="radio" class="form-check-input" value="fall" name="premiered" id="fall">
                        <label for="fall">fall</label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check-inline">
                        <input type="radio" class="form-check-input" value="winter" name="premiered" id="winter">
                        <label for="winter">winter</label>
                      </div> 
                    </td>
                  </tr>
                </table>              
              </div>
              
              
              <div class="form-group">
                <label> Studios</label>
                <input type="text" name="studios" class="form-control" placeholder="Masukkan Studios" required>       
              </div>
              <div class="form-group">
                <label> Source</label>
                <input type="text" name="source" class="form-control" placeholder="Masukkan Source" required>       
              </div>
              <div class="form-group">
                <label for="">Genres</label>
                <div style="visibility:hidden; color:red;  display: inline;" id="chk_option_error_genres">
                Please select at least one option.
                </div>
                <table border="0" cellpadding="5" cellspacing="0">
                  <tr>
                    <td>
                      <div class="form-check-inline">
                        <input type="checkbox" class="form-check-input" name="genres[]" id="romance" value="romance">
                        <label for="romance">Romance</label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check-inline">
                        <input type="checkbox" class="form-check-input" name="genres[]" id="adventure" value="adventure">
                        <label for="adventure">Adventure</label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check-inline">
                        <input type="checkbox" class="form-check-input" name="genres[]" id="comedy" value="comedy">
                        <label for="comedy">Comedy</label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check-inline">
                        <input type="checkbox" class="form-check-input" name="genres[]" id="drama" value="drama">
                        <label for="drama">Drama</label>
                      </div>
                    </td>

                    
                  </tr>

                  <tr>
                    <td>
                      <div class="form-check-inline">
                        <input type="checkbox" class="form-check-input" name="genres[]" id="fantasy" value="fantasy">
                        <label for="fantasy">Fantasy</label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check-inline">
                        <input type="checkbox" class="form-check-input" name="genres[]" id="game" value="game">
                        <label for="game">Game</label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check-inline">
                        <input type="checkbox" class="form-check-input" name="genres[]" id="magic" value="magic">
                        <label for="magic">Magic</label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check-inline">
                        <input type="checkbox" class="form-check-input" name="genres[]" id="mystery" value="mystery">
                        <label for="mystery">Mystery</label>
                      </div>
                    </td>

                  </tr>

                  <tr>
                    <td>
                      <div class="form-check-inline">
                        <input type="checkbox" class="form-check-input" name="genres[]" id="school" value="school">
                        <label for="school">School</label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check-inline">
                        <input type="checkbox" class="form-check-input" name="genres[]" id="seinen" value="seinen">
                        <label for="seinen">Seinen</label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check-inline">
                        <input type="checkbox" class="form-check-input" name="genres[]" id="shoujo" value="shoujo">
                        <label for="shoujo">Shoujo</label>
                      </div>  
                    </td>
                    <td>
                      <div class="form-check-inline">
                        <input type="checkbox" class="form-check-input" name="genres[]" id="shounen" value="shounen">
                        <label for="shounen">Shounen</label>
                      </div>
                    </td>

                  </tr>

                  <tr>
                    <td>
                      <div class="form-check-inline">
                        <input type="checkbox" class="form-check-input" name="genres[]" id="supernatural" value="supernatural">
                        <label for="supernatural">Supernatural</label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check-inline">
                        <input type="checkbox" class="form-check-input" name="genres[]" id="vampire" value="vampire">
                        <label for="vampire">Vampire</label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check-inline">
                        <input type="checkbox" class="form-check-input" name="genres[]" id="zombie" value="zombie">
                        <label for="zombie">Zombie</label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check-inline">
                        <input type="checkbox" class="form-check-input" name="genres[]" id="mecha" value="mecha">
                        <label for="mecha">Mecha</label>
                      </div>
                    </td>

                  </tr>  

                  <tr>
                    <td>
                      <div class="form-check-inline">
                        <input type="checkbox" class="form-check-input" name="genres[]" id="action" value="action">
                        <label for="action">Action</label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check-inline">
                        <input type="checkbox" class="form-check-input" name="genres[]" id="Sci-Fi" value="Sci-Fi">
                        <label for="Sci-Fi">Sci-Fi</label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check-inline">
                        <input type="checkbox" class="form-check-input" name="genres[]" id="ecchi" value="ecchi">
                        <label for="ecchi">Ecchi</label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check-inline">
                        <input type="checkbox" class="form-check-input" name="genres[]" id="Super Power" value="Super Power">
                        <label for="Super Power">Super Power</label>
                      </div>
                    </td>

                  </tr>

                </table>
              </div>

              <div class="form-group">
                <label> Duration</label>
                <div style="visibility:hidden; color:red;  display: inline;" id="chk_option_error_duration">
                Please select at least one option.
                </div>
                <table border="0" cellpadding="5" cellspacing="0">
                  <tr>
                    
                    <td>
                      <div class="form-check-inline">
                        <input type="radio" class="form-check-input" value="5" name="duration" id="lima">
                        <label for="lima">5 menit</label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check-inline">
                        <input type="radio" class="form-check-input" value="10" name="duration" id="sepuluh">
                        <label for="sepuluh">10 menit</label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check-inline">
                        <input type="radio" class="form-check-input" value="20" name="duration" id="duapuluh">
                        <label for="duapuluh">20 menit</label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-check-inline">
                        <input type="radio" class="form-check-input" value="30" name="duration" id="tigapuluh">
                        <label for="tigapuluh">30 menit</label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check-inline">
                        <input type="radio" class="form-check-input" value="60" name="duration" id="enampuluh">
                        <label for="enampuluh">60 menit</label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check-inline">
                        <input type="radio" class="form-check-input" value="90" name="duration" id="sembilanpuluh">
                        <label for="sembilanpuluh">90 menit</label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check-inline">
                        <input type="radio" class="form-check-input" value="120" name="duration" id="seratusduapuluh">
                        <label for="seratusduapuluh">120 menit</label>
                      </div>   
                    </td> 
                  </tr>
                </table>             
              </div>
       
              <div class="form-group">
                <label> Score</label>
                <input type="number" step="0.1" name="score" class="form-control" placeholder="Masukkan Score" min="0" max="10" required>
              </div>       
              <div class="form-group">
                <label> Gambar</label><br>
                <input type="file" name="gambar" required>
              </div> 
              
              
              <div class="form-group">
                <label for="">Sinopsis</label>
                <textarea class="form-control" name="sinopsis" id="" cols="30" rows="5" placeholder="Masukkan sinopsis" required></textarea>
              </div>
              <button type="submit" class="btn-primary" name="submit">SIMPAN</button>
              <button type="reset" class="btn-danger" name="batal">BATAL</button>
              </form>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
        </div> 
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
            <div class="footer_main_copyright"><i class="far fa-copyright"></i> 2020 Canonical Ltd. Kayon and Canonical are registered trademarks of Canonical Ltd.</div>
          </div>
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center text-white">
            <div class="footer_sub_copyright">Legal information  <i class="fas fa-circle"></i>  Data privacy  <i class="fas fa-circle"></i>  Report a bug on this site</div>
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