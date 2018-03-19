new Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'morris-area-chart',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [
    { year: '2018-01-18 9:00', value: 1 },
    { year: '2018-01-18 10:00', value: 2 },
    { year: '2018-01-18 11:00', value: 7 },
    { year: '2018-01-18 12:00', value: 4 },
    { year: '2018-01-18 13:00', value: 1 },
    { year: '2018-01-18 14:00', value: 6 }
  ],
  // The name of the data record attribute that contains x-values.
  xkey: 'year',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['value'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Transactions']
});
