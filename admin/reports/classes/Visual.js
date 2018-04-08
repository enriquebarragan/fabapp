// Visual Object
function Visual(type, div_id, option) {
  this.type = type;
  this.div_id = div_id;
  this.option = option;
}
// Visual method
Visual.prototype.get_response = function() {
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
      new Morris.Bar({
        element: 'morris-area-chart',
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
  }
};
