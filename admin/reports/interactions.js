// Load classes
$.getScript( "reports/trans_by_devices/trans_by_devices_visual.js" );

/* test loading scripts
$.getScript( "reports/trans_by_devices/trans_by_devices_visual.js" )
  .done(function( script, textStatus ) {
    alert( textStatus );
  })
  .fail(function( jqxhr, settings, exception ) {
    alert(exception);
}); */

// spinner to show loading
function show_load(div_id) {
  document.getElementById(div_id).innerHTML = "<i class='fa fa-spinner fa-spin' style='font-size:48px'></i>";
}

// selectors
$('#trans_date li').on('click', function(){
  // transaction by device selector
  var div_id_table = "trans_by_devices_table";
  var div_id_barchart = "trans_by_devices_barchart";

  show_load(div_id_table);

  var range = $(this).text();

  var table = new trans_by_devices_visual("table", div_id_table, range);
  var barchart = new trans_by_devices_visual("barchart", div_id_barchart, range);

  //title
  document.getElementById("trans_by_devices_table_title").innerHTML = "<h3>" + range +"</h3>";
  document.getElementById(div_id_barchart).innerHTML = "";


  barchart.barchart_get_response();
  table.table_get_response();

});

$(document).ready(function() {

  /* transactions by device
  delay introduced to make sure everything is loaded
  before writing table in */
  document.getElementById("trans_by_devices_table_title").innerHTML = "<h3>Today</h3>";
  setTimeout(function() {
    var table = new trans_by_devices_visual("table", "trans_by_devices_table", "Today");
    table.table_get_response();
  }, 500);
});
