// Visual Object
function weekly_trans_by_hour_visual(div_id, option) {
  this.div_id = div_id;
  this.option = option
}

// visual method for chart chart
weekly_trans_by_hour_visual.prototype.chart_get_response = function() {
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
          var chart_data = this.responseText;
          var chart_data_obj = eval(chart_data);
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);

          function drawChart() {
            try {
              var data = google.visualization.arrayToDataTable(chart_data_obj);
            }
            catch(error) {
              alert(error);
            }
            var options = {
              legend: { position: 'bottom' },
              title: 'Count by Hour',
              curveType: 'function',
              vAxis: {
                title: 'Transactions',
                viewWindow: { min: 0 }
              }
            };
            var chart = new google.visualization.LineChart(document.getElementById(div_id));
            chart.draw(data, options);
          }
        }
      };
      xmlhttp.open("GET","../admin/reports/weekly_trans_by_hour/"+div_id+".php?q="+this.option,true);
      xmlhttp.send();
  }
};
