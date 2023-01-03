<?php  
session_start();
//cek dulu ada tidak session nya atau user sudah login atau belum
if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}
require 'function.php';

$idanime= $_GET["idanime"];
$gambar = $_GET["gambar"];
hapus_gambar($gambar);

if( hapus($idanime) > 0){
	echo "
			<script>
				alert('data berhasil dihapus!');
				document.location.href = 'gallery.php';
			</script>
		";
} else{
	echo "
			<script>
				alert('data gagal dihapus!');
				document.location.href = 'gallery.php';
			</script>
		";
}


?>