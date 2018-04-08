// Visual Object
function trans_by_devices_visual(type, div_id, option) {
  this.type = type;
  this.div_id = div_id;
  this.option = option;
}

// visual method for table
trans_by_devices_visual.prototype.table_get_response = function() {
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

// visual method for barchart
trans_by_devices_visual.prototype.barchart_get_response = function() {
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
          var bar_data = this.responseText;
          var bar_data_obj = eval(bar_data);
          alert("test 4")
          alert(typeof bar_data_obj);
          alert(bar_data_obj);
          new Morris.Bar({
            element: 'trans_by_devices_barchart',
            data: bar_data_obj,
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Transactions'],
            xLabelMargin: 8
          });
        }
      };
      xmlhttp.open("GET","../admin/reports/trans_by_devices/"+div_id+".php?q="+this.option,true);
      xmlhttp.send();
  }
};
