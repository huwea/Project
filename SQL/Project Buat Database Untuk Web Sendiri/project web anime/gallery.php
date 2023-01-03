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

$jumlahDataPerHalaman = 8;
$jumlahData = count(query("SELECT * FROM anime"));

$jumlahHalaman = ceil($jumlahData/$jumlahDataPerHalaman);

$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;

$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
$anime = query("SELECT * FROM anime LIMIT $awalData, $jumlahDataPerHalaman");

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
            <a class="nav-link text-white mr-5" data-toggle="tooltip" data-placement="bottom" title="ini adalah tab home" href="index_admin.php">HOME <span class="sr-only">(current)</span></a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-white mr-5" data-toggle="tooltip" data-placement="bottom" title="ini adalah tab input data" href="input.php">INPUT DATA</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white mr-5" data-toggle="tooltip" data-placement="bottom" title="ini adalah tab list anime" href="gallery.php" style="text-decoration: underline;">LIST ANIME</a>
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

            if( isset($_POST["submit"])){
  
              if (ubah($_POST) > 0 ) {

                echo "
                  <script>
                    alert('data berhasil diubah!');
                    document.location.href = 'gallery.php';
                  </script>
                ";
              } else{
                // echo "data gagal ditambahkan!";
                echo "
                  <script>
                    alert('data gagal diubah!');
                    document.location.href = 'gallery.php';
                  </script>
                ";
              }

            }

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
                <p class="card-text text-white text-justify mt-2"><?= $limited_string;?>....</p>
                <i class="fas fa-star text-warning"></i>
                <i class="fas fa-star text-warning"></i>
                <i class="fas fa-star text-warning"></i>
                <i class="fas fa-star text-warning"></i>
                <i class="fas fa-star text-warning">&ensp;<?= $row["score"] ;?></i><br>
                <a href="#" class="btn btn-primary mt-2" data-target="#produk<?=$row["idanime"];?>" data-toggle="modal">Detail</a>
                <a href="hapus.php?idanime=<?= $row["idanime"]; ?>&gambar=<?= $row["gambar"]; ?>" onclick="return confirm('apakah anda ingin menghapus data?');" class="btn btn-danger mt-2">Delete</a>
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
                  <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button> -->
                  <a href="#" class="btn btn-primary" data-target="#ubah<?=$row["idanime"];?>" data-toggle="modal" data-dismiss="modal">UBAH</a>
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


          <!-- UBAH -->
          <div class="modal fade" id="ubah<?=$row["idanime"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ubah Informasi</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                   
                    <div class="col-md-12">
                      <form action="" name="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="idanime" value="<?= $row["idanime"]; ?>">
                        <input type="hidden" name="gambarLama" value="<?= $row["gambar"]; ?>">
                        <div class="col-md-6 mr-auto ml-auto pb-5">
                          <img src="img/<?=$row["gambar"];?>" alt="" width="80%">

                        </div>
                        <div class="form-group">
                          <label> Title </label>
                          <input type="text" name="title" value="<?= $row["title"] ?>" class="form-control" placeholder="Masukkan title"  autofocus></div>
                        <div class="form-group">

                          <label> Type </label>
                          <table border="0" cellpadding="5" cellspacing="0">
                            <tr>
                              <td>
                                <div class="form-check-inline">
                                  <input type="radio" class="form-check-input" value="tv" <?php if($row["type"] == "tv"){ echo "checked";}?> name="type" id="tv">
                                  <label for="tv">tv</label>
                                </div>
                              </td>
                              <td>
                                <div class="form-check-inline">
                                  <input type="radio" class="form-check-input" value="movie" <?php if($row["type"] == "movie"){ echo "checked";}?> name="type" id="movie">
                                  <label for="movie">movie</label>
                                </div>
                              </td>
                              <td>
                                <div class="form-check-inline">
                                  <input type="radio" class="form-check-input" value="streaming" <?php if($row["type"] == "streaming"){ echo "checked";}?> name="type" id="streaming">
                                  <label for="streaming">streaming</label>
                                </div>
                              </td>
                            </tr>
                          </table>
                        </div>
                        <div class="form-group">
                          <label> Episodes</label>
                          <input type="number" name="episodes" value="<?= $row["episodes"] ?>" class="form-control" placeholder="Masukkan Episodes">       
                        </div>
                        <div class="form-group">
                          <label> Status</label><br>
                          <table border="0" cellpadding="5" cellspacing="0">
                            <tr>
                              <td>
                                <div class="form-check-inline">
                                  <input type="radio" class="form-check-input" value="ongoing" <?php if($row["status"] == "ongoing"){ echo "checked";}?> name="status" id="ongoing">
                                  <label for="ongoing">ongoing</label>
                                </div>
                              </td>
                              <td>
                                <div class="form-check-inline">
                                  <input type="radio" class="form-check-input" value="finished" <?php if($row["status"] == "finished"){ echo "checked";}?> name="status" id="finished">
                                  <label for="finished">finished</label>
                                </div>
                              </td>
                            </tr>
                          </table>          
                        </div>
                        <div class="form-group">
                          <label> Aired</label>
                          <input type="date" name="aired" value="<?= $row["aired"] ?>" class="form-control" placeholder="Masukkan Aired">       
                        </div>

                        <div class="form-group">
                          <label> Premiered</label><br>
                          

                          <table border="0" cellpadding="5" cellspacing="0">
                            <tr>
                              <td>
                                <div class="form-check-inline">
                                  <input type="radio" class="form-check-input" value="spring" <?php if($row["premiered"] == "spring"){ echo "checked";}?> name="premiered" id="spring">
                                  <label for="spring">spring</label>
                                </div>
                              </td>
                              <td>
                                <div class="form-check-inline">
                                  <input type="radio" class="form-check-input" value="summer" <?php if($row["premiered"] == "summer"){ echo "checked";}?> name="premiered" id="summer">
                                  <label for="summer">summer</label>
                                </div>
                              </td>
                              <td>
                                <div class="form-check-inline">
                                  <input type="radio" class="form-check-input" value="fall" <?php if($row["premiered"] == "fall"){ echo "checked";}?> name="premiered" id="fall">
                                  <label for="fall">fall</label>
                                </div>
                              </td>
                              <td>
                                <div class="form-check-inline">
                                  <input type="radio" class="form-check-input" value="winter" <?php if($row["premiered"] == "winter"){ echo "checked";}?> name="premiered" id="winter">
                                  <label for="winter">winter</label>
                                </div> 
                              </td>
                            </tr>
                          </table>

                        </div>
                        
                        
                        <div class="form-group">
                          <label> Studios</label>
                          <input type="text" name="studios" value="<?= $row["studios"] ?>" class="form-control" placeholder="Masukkan Studios">       
                        </div>
                        <div class="form-group">
                          <label> Source</label>
                          <input type="text" name="source" value="<?= $row["source"] ?>" class="form-control" placeholder="Masukkan Source">       
                        </div>
                        <div class="form-group">
                          <label for="">Genres</label><br>
                          


                          <table border="0" cellpadding="5" cellspacing="0">
                            <tr>
                              <td>
                                <div class="form-check-inline">
                                  <input type="checkbox" class="form-check-input" name="genres[]" id="romance" value="romance" <?php if (in_array("romance", $checked)) echo "checked";?>>
                                  <label for="romance">Romance</label>
                                </div>
                              </td>
                              <td>
                                <div class="form-check-inline">
                                  <input type="checkbox" class="form-check-input" name="genres[]" id="adventure" value="adventure" <?php if (in_array("adventure", $checked)) echo "checked";?>>
                                  <label for="adventure">Adventure</label>
                                </div>
                              </td>
                              <td>
                                <div class="form-check-inline">
                                  <input type="checkbox" class="form-check-input" name="genres[]" id="comedy" value="comedy" <?php if (in_array("comedy", $checked)) echo "checked";?>>
                                  <label for="comedy">Comedy</label>
                                </div>
                              </td>
                              

                              
                            </tr>

                            <tr>
                              <td>
                                <div class="form-check-inline">
                                  <input type="checkbox" class="form-check-input" name="genres[]" id="fantasy" value="fantasy" <?php if (in_array("fantasy", $checked)) echo "checked";?>>
                                  <label for="fantasy">Fantasy</label>
                                </div>
                              </td>
                              <td>
                                <div class="form-check-inline">
                                  <input type="checkbox" class="form-check-input" name="genres[]" id="game" value="game" <?php if (in_array("game", $checked)) echo "checked";?>>
                                  <label for="game">Game</label>
                                </div>
                              </td>
                              <td>
                                <div class="form-check-inline">
                                  <input type="checkbox" class="form-check-input" name="genres[]" id="magic" value="magic" <?php if (in_array("magic", $checked)) echo "checked";?>>
                                  <label for="magic">Magic</label>
                                </div>
                              </td>
                              

                            </tr>

                            <tr>
                              <td>
                                <div class="form-check-inline">
                                  <input type="checkbox" class="form-check-input" name="genres[]" id="school" value="school" <?php if (in_array("school", $checked)) echo "checked";?>>
                                  <label for="school">School</label>
                                </div>
                              </td>
                              <td>
                                <div class="form-check-inline">
                                  <input type="checkbox" class="form-check-input" name="genres[]" id="seinen" value="seinen" <?php if (in_array("seinen", $checked)) echo "checked";?>>
                                  <label for="seinen">Seinen</label>
                                </div>
                              </td>
                              <td>
                                <div class="form-check-inline">
                                  <input type="checkbox" class="form-check-input" name="genres[]" id="shoujo" value="shoujo" <?php if (in_array("shoujo", $checked)) echo "checked";?>>
                                  <label for="shoujo">Shoujo</label>
                                </div>  
                              </td>
                              

                            </tr>

                            <tr>
                              <td>
                                <div class="form-check-inline">
                                  <input type="checkbox" class="form-check-input" name="genres[]" id="supernatural" value="supernatural" <?php if (in_array("supernatural", $checked)) echo "checked";?>>
                                  <label for="supernatural">Supernatural</label>
                                </div>
                              </td>
                              <td>
                                <div class="form-check-inline">
                                  <input type="checkbox" class="form-check-input" name="genres[]" id="vampire" value="vampire" <?php if (in_array("vampire", $checked)) echo "checked";?>>
                                  <label for="vampire">Vampire</label>
                                </div>
                              </td>
                              <td>
                                <div class="form-check-inline">
                                  <input type="checkbox" class="form-check-input" name="genres[]" id="zombie" value="zombie" <?php if (in_array("zombie", $checked)) echo "checked";?>>
                                  <label for="zombie">Zombie</label>
                                </div>
                              </td>
                              

                            </tr>
                            <tr>
                                <td>
                                  <div class="form-check-inline">
                                    <input type="checkbox" class="form-check-input" name="genres[]" id="drama" value="drama" <?php if (in_array("drama", $checked)) echo "checked";?>>
                                    <label for="drama">Drama</label>
                                  </div>
                                </td>
                                <td>
                                  <div class="form-check-inline">
                                  <input type="checkbox" class="form-check-input" name="genres[]" id="mystery" value="mystery" <?php if (in_array("mystery", $checked)) echo "checked";?>>
                                  <label for="mystery">Mystery</label>
                                  </div>
                                </td>
                                <td>
                                  <div class="form-check-inline">
                                  <input type="checkbox" class="form-check-input" name="genres[]" id="shounen" value="shounen" <?php if (in_array("shounen", $checked)) echo "checked";?>>
                                  <label for="shounen">Shounen</label>
                                  </div>
                                </td>
                            </tr> 
                            <tr>
                              <td>
                                <div class="form-check-inline">
                                  <input type="checkbox" class="form-check-input" name="genres[]" id="mecha" value="mecha" <?php if (in_array("mecha", $checked)) echo "checked";?>>
                                  <label for="mecha">Mecha</label>
                                </div>
                              </td>
                              <td>
                                <div class="form-check-inline">
                                  <input type="checkbox" class="form-check-input" name="genres[]" id="action" value="action" <?php if (in_array("action", $checked)) echo "checked";?>>
                                  <label for="action">Action</label>
                                </div>
                              </td>
                              <td>
                                <div class="form-check-inline">
                                  <input type="checkbox" class="form-check-input" name="genres[]" id="Sci-Fi" value="Sci-Fi" <?php if (in_array("Sci-Fi", $checked)) echo "checked";?>>
                                  <label for="Sci-Fi">Sci-Fi</label>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              
                              <td>
                                <div class="form-check-inline">
                                  <input type="checkbox" class="form-check-input" name="genres[]" id="ecchi" value="ecchi" <?php if (in_array("ecchi", $checked)) echo "checked";?>>
                                  <label for="ecchi">Ecchi</label>
                                </div>
                              </td>
                              <td>
                                <div class="form-check-inline">
                                  <input type="checkbox" class="form-check-input" name="genres[]" id="Super Power" value="Super Power"  <?php if (in_array("Super Power", $checked)) echo "checked";?>>
                                  <label for="Super Power">Super Power</label>
                                </div>
                              </td>

                            </tr>  

                          </table>
                        </div>

                        <div class="form-group">
                          <label> Duration</label><br>
                           

                          <table border="0" cellpadding="5" cellspacing="0">
                            <tr>
                              <td>
                                <div class="form-check-inline">
                                  <input type="radio" class="form-check-input" value="5" <?php if($row["duration"] == "5"){ echo "checked";}?> name="duration" id="lima">
                                  <label for="lima">5 menit</label>
                                </div>
                              </td>
                              
                              <td>
                                <div class="form-check-inline">
                                  <input type="radio" class="form-check-input" value="10" <?php if($row["duration"] == "10"){ echo "checked";}?> name="duration" id="sepuluh">
                                  <label for="sepuluh">10 menit</label>
                                </div>
                              </td>
                              <td>
                                <div class="form-check-inline">
                                  <input type="radio" class="form-check-input" value="20" <?php if($row["duration"] == "20"){ echo "checked";}?> name="duration" id="duapuluh">
                                  <label for="duapuluh">20 menit</label>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div class="form-check-inline">
                                  <input type="radio" class="form-check-input" value="30" <?php if($row["duration"] == "30"){ echo "checked";}?> name="duration" id="tigapuluh">
                                  <label for="tigapuluh">30 menit</label>
                                </div>
                              </td>
                              <td>
                                <div class="form-check-inline">
                                  <input type="radio" class="form-check-input" value="60" <?php if($row["duration"] == "60"){ echo "checked";}?> name="duration" id="enampuluh">
                                  <label for="enampuluh">60 menit</label>
                                </div>
                              </td>
                              <td>
                                <div class="form-check-inline">
                                  <input type="radio" class="form-check-input" value="90" <?php if($row["duration"] == "90"){ echo "checked";}?> name="duration" id="sembilanpuluh">
                                  <label for="sembilanpuluh">90 menit</label>
                                </div>
                              </td>
                              
                            </tr>
                            <tr>
                              <td>
                                <div class="form-check-inline">
                                  <input type="radio" class="form-check-input" value="120" <?php if($row["duration"] == "120"){ echo "checked";}?> name="duration" id="seratusduapuluh">
                                  <label for="seratusduapuluh">120 menit</label>
                                </div>   
                              </td> 
                            </tr>
                          </table>


                        </div>
                 
                        <div class="form-group">
                          <label> Score</label>
                          <input type="number" step="0.1" name="score" value="<?= $row["score"] ?>" class="form-control" placeholder="Masukkan Score">
                        </div>       
                     
                        
                        <div class="form-group">
                          <label> Gambar</label><br>
                          <input type="file" name="gambar" id="gambar">
                        </div>
                        <div class="form-group">
                          <label for="">Sinopsis</label>
                          <textarea class="form-control" name="sinopsis"  cols="30" rows="5" placeholder="Masukkan sinopsis"><?= $row["sinopsis"] ?></textarea>
                        </div>
                        
                        <button type="submit" class="btn-primary" name="submit">SIMPAN</button>
                        <button type="button" class="btn-danger" data-dismiss="modal">Kembali</button>
                      </form>


                    </div>
                  </div>
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
            
            <!-- &gt; -->
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
    <script type="text/javascript" src="js/script_teori.js"></script>
  </body>
</html>