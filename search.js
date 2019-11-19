$(document).ready(function(){
    $("button").click(function(e){
        $.ajax({
          url :'viewDateTime.php',
          type: 'GET',
          dataType : 'html',
          success : function(data, statut)
          {
            $("#result").html(data); 
          }
        });
    });
});

function showFoundPatient(searchEntry) {
  if (searchEntry.length == 0) {
    document.getElementById("searchPatient").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("searchPatient").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "trouvepatient.php?q=" + searchEntry, true);
    xmlhttp.send();
  }
}