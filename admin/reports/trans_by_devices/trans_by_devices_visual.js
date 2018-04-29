// Visual Object
function trans_by_devices_visual(div_id, start, end) {
  this.div_id = div_id;
  this.start = start;
  this.end = end;
}

// visual method for table
trans_by_devices_visual.prototype.table_get_response = function() {
  div_id = this.div_id;
  if (this.start == "") {
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
      xmlhttp.open("GET","../admin/reports/trans_by_devices/"+div_id+".php?s="+this.start+"&e="+this.end,true);
      xmlhttp.send();
  }
};

// visual method for donut
trans_by_devices_visual.prototype.donut_get_response = function() {
  div_id = this.div_id;
  if (this.start == "") {
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
          var donut_data = this.responseText;
          var donut_data_obj = eval(donut_data);
          new Morris.Donut({
            element: 'trans_by_devices_donut',
            data: donut_data_obj
          });
        }
      };
      xmlhttp.open("GET","../admin/reports/trans_by_devices/"+div_id+".php?s="+this.start+"&e="+this.end,true);
      xmlhttp.send();
  }
};
