

new Morris.Bar({
  element: 'morris-area-chart2',
  data: [
    { y: '# of Tickets', a: 100},
    { y: '3D Prints', a: 75},
    { y: 'Laser', a: 50},
    { y: 'Vinyl', a: 75},
    { y: 'Elec Station', a: 50 },
    { y: 'Mill', a: 75 },
    { y: 'VR', a: 100},
    { y: 'Sew', a: 130},
    { y: 'Scan', a: 20},
    { y: 'Screen Pess', a: 20}
  ],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['Series A', 'Series B'],
  resize: true,
  xLabelMargin: 7
});
