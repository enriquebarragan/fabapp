// Visual Object
function failed_pie_chart_visual(div_id, option, start, end) {
  this.div_id = div_id;
  this.option = option;
  this.start = start;
  this.end = end;
}

// visual method for pie chart
failed_pie_chart_visual.prototype.pie_get_response = function() {
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
          var pie_data = this.responseText;
          var pie_data_obj = eval(pie_data);
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);

          function drawChart() {
            var data = google.visualization.arrayToDataTable(pie_data_obj);
            // Optional; add a title and set the width and height of the chart
            var options = {is3D: true,
              'width':340, 'height':250,
              slices: {
                0: { color: '#4C944C'},
                1: { color: '#9E0D0D'}
              }
            };
            document.getElementById(div_id).innerHTML = ""
            var chart = new google.visualization.PieChart(document.getElementById(div_id));
            chart.draw(data, options);
          }
        }
      };
      xmlhttp.open("GET","../admin/reports/failed_pie_chart/"+div_id+".php?q="+this.option+"&s="+this.start+"&e="+this.end,true);
      xmlhttp.send();
  }
};
