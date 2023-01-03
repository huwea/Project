function isCheckedgenres()
{
    var form_data = new FormData(document.querySelector("form"));
    
    if(!form_data.has("genres[]"))
    {
        document.getElementById("chk_option_error_genres").style.visibility = "visible";
        document.getElementById("chk_option_error_genres").style.display = "block";

        alert('You need to select an option genres!');
      return false;
    }
    else
    {
        document.getElementById("chk_option_error_genres").style.visibility = "hidden";
      return true;
    }
    
}


function isCheckedpremiered(){
	 var checkedspring = document.getElementById('spring').checked;
	 var checkedsummer = document.getElementById('summer').checked;
	 var checkedfall = document.getElementById('fall').checked;
	 var checkedwinter = document.getElementById('winter').checked;

	 if(checkedspring == false && checkedsummer == false && checkedfall == false && checkedwinter == false)
	 {
	 	document.getElementById("chk_option_error_premiered").style.visibility = "visible";
	 	document.getElementById("chk_option_error_premiered").style.display = "block";
	 	alert('You need to select an option premiered!');
      	return false;
	 }
	 else{
	 	document.getElementById("chk_option_error_premiered").style.visibility = "hidden";
      	return true;
	 }
 }

 

 function isCheckedstatus(){
	 var checkedongoing = document.getElementById('ongoing').checked;
	 var checkedfinished = document.getElementById('finished').checked;

	 if(checkedongoing == false && checkedfinished == false)
	 {
	 	document.getElementById("chk_option_error_status").style.visibility = "visible";
	 	document.getElementById("chk_option_error_status").style.display = "block";
	 	alert('You need to select an option status!');
	 	return false;
	 }
	 else{
	 	document.getElementById("chk_option_error_status").style.visibility = "hidden";
	 	return true;
	 }
 }

 function isCheckedduration(){
	 var checkedlima = document.getElementById('lima').checked;
	 var checkedsepuluh = document.getElementById('sepuluh').checked;
	 var checkedduapuluh = document.getElementById('duapuluh').checked;
	 var checkedtigapuluh = document.getElementById('tigapuluh').checked;
	 var checkedenampuluh = document.getElementById('enampuluh').checked;
	 var checkedsembilanpuluh = document.getElementById('sembilanpuluh').checked;
	 var checkedseratusduapuluh = document.getElementById('seratusduapuluh').checked;

	 if(checkedlima == false && checkedsepuluh == false && checkedduapuluh == false && checkedtigapuluh == false && checkedenampuluh == false && checkedsembilanpuluh == false && checkedseratusduapuluh == false)
	 {
	 	document.getElementById("chk_option_error_duration").style.visibility = "visible";
	 	document.getElementById("chk_option_error_duration").style.display = "block";
	 	alert('You need to select an option duration!');
	 	return false;
	 }
	 else{
	 	document.getElementById("chk_option_error_duration").style.visibility = "hidden";
	 	return true;
	 }
 }

 function isCheckedtype(){
	 var checkedtv = document.getElementById('tv').checked;
	 var checkedmovie = document.getElementById('movie').checked;
	 var checkedstreaming = document.getElementById('streaming').checked;
	 

	 if(checkedtv == false && checkedmovie == false && checkedstreaming == false)
	 {
	 	document.getElementById("chk_option_error_type").style.visibility = "visible";
	 	document.getElementById("chk_option_error_type").style.display = "block";
	 	alert('You need to select an option type!');
	 	return false;
	 }
	 else{
	 	document.getElementById("chk_option_error_type").style.visibility = "hidden";
	 	return true;
	 }
 }

 // $('#modal').modal('show');
 $(function (){
	$('[data-toggle = "tooltip"]').tooltip()
})



