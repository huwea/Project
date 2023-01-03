<?php
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "cobaanime");

function query($query)
{
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}


function hapus_gambar($gambar)
{

	unlink("img/" . $gambar);
}

function hapus($idanime)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM anime WHERE idanime = $idanime");
	return mysqli_affected_rows($conn);
}

function ubah($data)
{
	global $conn;
	error_reporting(E_ALL ^ E_NOTICE);
	$idanime = $data["idanime"];
	$title = htmlspecialchars($data["title"]);
	$type = htmlspecialchars($data["type"]);
	$episodes = htmlspecialchars($data["episodes"]);
	$status = htmlspecialchars($data["status"]);
	$aired = htmlspecialchars($data["aired"]);
	$premiered = htmlspecialchars($data["premiered"]);
	$studios = htmlspecialchars($data["studios"]);
	$source = htmlspecialchars($data["source"]);
	$genres = implode(",", $data["genres"]);

	$duration = htmlspecialchars($data["duration"]);
	$score = htmlspecialchars($data["score"]);
	$sinopsis = htmlspecialchars($data["sinopsis"]);


	$gambarLama = htmlspecialchars($data["gambarLama"]);
	//cek apakah user pilih gambar baru atau tidak
	if ($_FILES['gambar']['error'] === 4) {

		$gambar = $gambarLama;
	} else {
		unlink("img/" . $gambarLama);
		$gambar = upload();
	}

	$query = "UPDATE anime SET 
				title = '$title',
				type = '$type',
				episodes = '$episodes',
				status = '$status',
				aired = '$aired', 
				premiered = '$premiered',
				studios = '$studios',
				source = '$source',
				genres = '$genres',
				duration = '$duration',
				score = '$score',
				sinopsis = '$sinopsis',
				gambar = '$gambar'
				WHERE idanime = $idanime";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function upload()
{
	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']["tmp_name"];


	if ($error === 4) {
		echo "	<script>
					alert('pilih gambar terlebih dahulu!')
				<script>";
		return false;
	}


	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "	<script>
					alert('yang anda upload bukan gambar!')
				<script>";
		return false;
	}

	if ($ukuranFile > 1000000) {
		echo "	<script>
					alert('ukuran gambar terlalu besar!')
				<script>";
		return false;
	}

	$namaFileBaru = $namaFile;


	move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
	return $namaFileBaru;
}

function cari($keyword)
{
	$jumlahDataPerHalaman = 8;
	$jumlahData = count(query("SELECT * FROM anime"));

	$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
	$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
	$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

	$query = "SELECT * FROM anime WHERE title LIKE'%$keyword%'
	OR type LIKE '%$keyword%' OR status LIKE '%$keyword%' OR premiered LIKE '%$keyword%' OR studios LIKE'%$keyword%' OR source LIKE'%$keyword%' OR genres LIKE'%$keyword%' OR score LIKE'$keyword%' LIMIT $awalData, $jumlahDataPerHalaman";
	return query($query);
}

function registrasi($data)
{
	global $conn;
	$username = strtolower(stripslashes($data["username"]));


	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);
	$level = strtolower(stripslashes($data["level"]));

	$result = mysqli_query($conn, "SELECT username FROM user2 WHERE username = '$username'");
	if (mysqli_fetch_assoc($result)) {
		echo "	<script>
					alert('username sudah terdaftar!');
				</script>";
		return false;
	}


	if ($password !== $password2) {
		echo "	<script>
					alert('konfirmasi password tidak sesuai!');
				</script>";
		return false;
	}


	$password = password_hash($password, PASSWORD_DEFAULT);


	mysqli_query($conn, "INSERT INTO  user2 VALUES('','$username', '$password', '$level')");

	return mysqli_affected_rows($conn);
}


function limit_words($string, $word_limit)
{
	$words = explode(" ", $string);
	return implode(" ", array_splice($words, 0, $word_limit));
}
