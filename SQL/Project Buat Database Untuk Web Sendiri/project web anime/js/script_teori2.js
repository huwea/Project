//ambil elemen-elemen yang ada di html
var keyword = document.getElementById('keyword');
var tombolCari = document.getElementById('tombolcari');
var container = document.getElementById('container');

//menambahkan suatu ivent di dalam field keyword
keyword.addEventListener('keyup', function(){
	// console.log(keyword.value);

	//membuat object ajax
	var xhr = new XMLHttpRequest();
	//cek kesiapan ajax
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200) {
			container.innerHTML = xhr.responseText;
		}
	}

	//buat ajax
	xhr.open('GET', 'ajax/anime2.php?keyword=' +keyword.value,true);
	xhr.send();













});