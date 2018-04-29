// Load classes
$.getScript( "reports/trans_by_devices/trans_by_devices_visual.js" );
$.getScript( "reports/failed_pie_chart/failed_pie_chart_visual.js" );
$.getScript( "reports/weekly_trans_by_hour/weekly_trans_by_hour_visual.js" );

//test loading scripts
/*$.getScript( "https://code.jquery.com/jquery-1.12.4.js" )
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

function get_todays_date() {
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth()+1;
  var yyyy = today.getFullYear();

  if(dd < 10) {
    dd = '0'+dd
  }
  if( mm < 10) {
    mm = '0'+mm
  }
  today = yyyy+'-'+mm+'-'+dd;

  //uncomment below and delete the second ling in prod
  //return today;
  return '2017-11-15';
}

// interactions
$( '#trans_by_devices_button' ).on('click', function() {
  // transaction by device selector
  var div_id_table = "trans_by_devices_table";
  var div_id_donut = "trans_by_devices_donut";

  // clearning and showing load
  show_load(div_id_table);
  document.getElementById(div_id_donut).innerHTML = "";

  // getting values from date input
  var start = document.getElementById("trans_by_devices_datepicker_start").value;
  var end = document.getElementById("trans_by_devices_datepicker_end").value;

  var table = new trans_by_devices_visual(div_id_table, start, end);
  var donut = new trans_by_devices_visual(div_id_donut, start, end);

  donut.donut_get_response();
  table.table_get_response();
});

$( '#failed_pie_chart_dropdown li' ).on('click', function() {
  // transaction by device selector
  var div_id_table = "failed_pie_chart_pie"

  // clearning and showing load
  show_load(div_id);

  // getting values from date input
  var start = document.getElementById("failed_pie_chart_datepicker_start").value;
  var end = document.getElementById("failed_pie_chart_datepicker_end").value;
  var group = $(this).text();

  var pie = new failed_pie_chart_visual(div_id, group, start, end);
  pie.pie_get_response();
});

$( function() {
  $( "#weekly_trans_by_hour_datepicker" ).datepicker({
    onSelect: function(date) {
      var div_id = "weekly_trans_by_hour_chart";

      show_load(div_id);
      var chart = new weekly_trans_by_hour_visual(div_id, date);
      chart.chart_get_response();
    },
    dateFormat: 'yy-mm-dd',
    showWeek: true,
    firstDay: 1
  });
} );

$( function() {
  $( "#trans_by_devices_datepicker_start" ).datepicker({
    dateFormat: 'yy-mm-dd'
  });
} );

$( function() {
  $( "#trans_by_devices_datepicker_end" ).datepicker({
    dateFormat: 'yy-mm-dd'
  });
} );

$( function() {
  $( "#failed_pie_chart_datepicker_start" ).datepicker({
    dateFormat: 'yy-mm-dd',
  });
} );

$( function() {
  $( "#failed_pie_chart_datepicker_end" ).datepicker({
    dateFormat: 'yy-mm-dd',
  });
} );

$(document).ready(function() {
  setTimeout(function() {
    setTimeout(function() {
      var table = new trans_by_devices_visual("trans_by_devices_table", get_todays_date(), get_todays_date());
      table.table_get_response();
    }, 500);
    setTimeout(function() {
      var donut = new trans_by_devices_visual("trans_by_devices_donut", get_todays_date(), get_todays_date());
      donut.donut_get_response();
    }, 1500);
  }, 0);

  setTimeout(function() {
    var line_chart = new weekly_trans_by_hour_visual("weekly_trans_by_hour_chart", get_todays_date());
    line_chart.chart_get_response();
  }, 2500);

  setTimeout(function() {
    var failed_pie = new failed_pie_chart_visual("failed_pie_chart_pie", "All", get_todays_date(), get_todays_date());
    failed_pie.pie_get_response();
  }, 3000);
});
