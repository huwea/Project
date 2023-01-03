<?php  
require"../function.php";
$jumlahDataPerHalaman = 8;
$jumlahData = count(query("SELECT * FROM anime"));

$jumlahHalaman = ceil($jumlahData/$jumlahDataPerHalaman);

$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;

$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
$anime = query("SELECT * FROM anime LIMIT $awalData, $jumlahDataPerHalaman");

if (isset($_POST["cari"])){
  $anime = cari($_POST["keyword"]);
}

$keyword = $_GET["keyword"];



$query = "SELECT * FROM anime WHERE title LIKE'%$keyword%'
  OR type LIKE '%$keyword%' OR status LIKE '%$keyword%' OR premiered LIKE '%$keyword%' OR studios LIKE'%$keyword%' OR source LIKE'%$keyword%' OR genres LIKE'%$keyword%' OR score LIKE'$keyword%' LIMIT $awalData, $jumlahDataPerHalaman";
$anime = query($query);

?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>

</body>
</html>
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
          <div class="col-xl-2 col-lg-3 col-md-6 col-sm-6 col-12">
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