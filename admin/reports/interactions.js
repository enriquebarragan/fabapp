// Load classes
$.getScript( "reports/trans_by_devices/trans_by_devices_visual.js" );
$.getScript( "reports/failed_pie_chart/failed_pie_chart_visual.js" );
$.getScript( "reports/weekly_trans_by_hour/weekly_trans_by_hour_visual.js" );

//test loading scripts
/*$.getScript( "reports/failed_pie_chart/failed_pie_chart_visual.js" )
  .done(function( script, textStatus ) {
    alert( textStatus );
  })
  .fail(function( jqxhr, settings, exception ) {
    alert(exception);
});*/

// spinner to show loading
function show_load(div_id) {
  document.getElementById(div_id).innerHTML = "<i class='fa fa-spinner fa-spin' style='font-size:48px'></i>";
}

// selectors
$('#trans_date li').on('click', function(){
  // transaction by device selector
  var div_id_table = "trans_by_devices_table";
  var div_id_donut = "trans_by_devices_donut";

  show_load(div_id_table);

  var range = $(this).text();

  var table = new trans_by_devices_visual("table", div_id_table, range);
  var donut = new trans_by_devices_visual("donut", div_id_donut, range);

  //title
  document.getElementById("trans_by_devices_table_title").innerHTML = "<h3>" + range +"</h3>";
  document.getElementById(div_id_donut).innerHTML = "";

  donut.donut_get_response();
  table.table_get_response();
});

$(document).ready(function() {

  document.getElementById("trans_by_devices_table_title").innerHTML = "<h3>Today</h3>";
  setTimeout(function() {
    var table = new trans_by_devices_visual("table", "trans_by_devices_table", "Today");
    table.table_get_response();
    setTimeout(function() {
      var donut = new trans_by_devices_visual("donut", "trans_by_devices_donut", "Today");
      donut.donut_get_response();
    }, 1000);
  }, 500);

  setTimeout(function() {
    var failed_pie = new failed_pie_chart_visual("failed_pie_chart_pie", "test");
    failed_pie.pie_get_response();
  }, 2000);

  setTimeout(function() {
    var line_chart = new weekly_trans_by_hour_visual("weekly_trans_by_hour_chart", "test");
    line_chart.chart_get_response();
  }, 2500);
});
