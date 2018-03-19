function show_table(str) {
    if (str == "") {
        document.getElementById("trans_table").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          document.getElementById("trans_table").innerHTML = this.responseText;
        };
        xmlhttp.open("GET","../admin/reports/transactions_report.php?q="+str,true);
        xmlhttp.send();
    }
}

// selectors
$('#trans_date li').on('click', function(){
  var range = $(this).text();
  show_table(range);
});

$(document).ready(show_table("Today"));
