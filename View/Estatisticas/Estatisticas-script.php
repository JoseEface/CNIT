<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<!--[if lt IE 9]>
<script src="https://code.highcharts.com/modules/oldie.js"></script>
<![endif]-->
<script src="js/Estatistica/EstatisticaCont.js"> </script>
<script src="js/Estatistica/EstatisticaView.js"> </script>


<script>

$(document).ready(function(){

//EstatisticaView.InicieComponentes();  

Highcharts.chart('container', {
  exporting: { enabled: false },
  chart: {
    type: 'column'
  },
  title: {
    text: "Quantidades de solicitações mês novembro"
  },
  subtitle: {
    text: 'Totais de consertos'
  },
  xAxis: {
    type: 'category',
    labels: {
      rotation: -45,
      style: {
        fontSize: '13px',
        fontFamily: 'Verdana, sans-serif'
      }
    }
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Quantidade'
    }
  },
  legend: {
    enabled: false
  },
  tooltip: {
    pointFormat: 'Quantidade em 2018: <b>{point.y:.1f} consertos</b>'
  },
  series: [{
    name: 'Quantidade',
    data: [
      ['02/11/2018', 24.2],
      ['Beijing', 20.8],
      ['Karachi', 14.9],
      ['Shenzhen', 13.7],
      ['Guangzhou', 13.1],
      ['Istanbul', 12.7],
      ['Mumbai', 12.4],
      ['Moscow', 12.2],
      ['São Paulo', 12.0],
      ['Delhi', 11.7],
      ['Kinshasa', 11.5],
      ['Tianjin', 11.2],
      ['Lahore', 11.1],
      ['Jakarta', 10.6],
      ['Dongguan', 10.6],
      ['Lagos', 10.6],
      ['Bengaluru', 10.3],
      ['Seoul', 9.8],
      ['Foshan', 9.3],
      ['Lagos', 10.6],
      ['Teste', 10.3],
      ['Salame', 9.8],
      ['Rahisa', 9.3],
      ['Lagos', 10.6],
      ['Bengaluru', 10.3],
      ['Seoul', 9.8],
      ['Foshan', 9.3],
      ['Tokyo', 9.3]
    ],
    dataLabels: {
      enabled: true,
      rotation: -90,
      color: '#FFFFFF',
      align: 'right',
      format: '{point.y:.1f}', // one decimal
      y: 10, // 10 pixels down from the top
      style: {
        fontSize: '13px',
        fontFamily: 'Verdana, sans-serif'
      }
    }
  }]
});

});

</script>