// Visual Object
function full_trans_details_visual(div_id, option) {
  this.div_id = div_id;
  this.start = option
}

// visual method for table
full_trans_details_visual.prototype.table_get_response = function() {
  div_id = this.div_id;
  if (this.option == "") {
      document.getElementById(div_id).innerHTML = "";
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
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById(div_id).innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET","../admin/reports/trans_by_devices/"+div_id+".php?q="+this.option,true);
      xmlhttp.send();
  }
};
