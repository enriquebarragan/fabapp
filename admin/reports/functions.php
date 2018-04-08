<?php

//functions
function get_week_start_end($week, $year) {
  // gets first and last day of the $week and $year
  $dto = new DateTime();
  $dto->setISODate($year, $week);

  // returning as string to be put directly into sql statement
  $ret['week_start'] = date_to_sqldate($dto);
  $dto->modify('+6 days');
  $ret['week_end'] = date_to_sqldate($dto);
  return $ret;
}

function get_year_month_week($todays_date) {
  $date = new DateTime($todays_date);
  $ret['today'] = $date;
  $ret['week'] = $date->format("W");
  $ret['year'] = $date->format("Y");
  $ret['month'] = $date->format("m");
  $ret['days'] = $date->format("t");
  return $ret;
}

function date_to_sqldate($date) {
  return "'" . $date->format('Y-m-d') . "'";
}

function get_quarter($todays_date) {
  $month = $todays_date->format("m");
  $year = $todays_date->format("Y");

  // The periods that we use are Jan-May, June-Aug, & Sept-Dec.
  if($month < 6){
    $ret['q_start'] = "'" . $year . "-01-01'";
    $ret['q_end'] = "'" . $year . "-05-31'";
  }
  elseif($month > 5 && $month <= 8){
    $ret['q_start'] = "'" . $year . "-06-01'";
    $ret['q_end'] = "'" . $year . "-08-31'";
  }
  else {
    $ret['q_start'] = "'" . $year . "-09-01'";
    $ret['q_end'] = "'" . $year . "-12-31'";
  }
  return $ret;
}
?>
