@extends('layouts.admin_template')
@push('stylesheet')
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}
#chartdiv2 {
  width: 100%;
  height: 500px;
}
#chartdiv3 {
  width: 100%;
  height: 500px;
}
</style>
@endpush
@section('content')
<div class="card mb-10">
  <div class="card-header">
    <h3 class="card-title">Grafik Data Penyuluh</h3>
  </div>
    <div class="card-body">
        <div id="chartdiv"></div>
    </div>
</div>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Grafik Data Penyuluh</h3>
  </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div id="chartdiv2"></div>
        </div>
        <div class="col-md-6">
          <div id="chartdiv3"></div>
        </div>
      </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script>
am5.ready(function() {

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv");

// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);


// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(am5xy.XYChart.new(root, {
  panX: true,
  panY: true,
  wheelX: "panX",
  wheelY: "zoomX",
  pinchZoomX: true,
  paddingLeft:0,
  layout: root.verticalLayout
}));

chart.set("colors", am5.ColorSet.new(root, {
  colors: [
    am5.color(0x73556E),
    am5.color(0x9FA1A6),
    am5.color(0xF2AA6B),
    am5.color(0xF28F6B),
    am5.color(0xA95A52),
    am5.color(0xE35B5D),
    am5.color(0xFFA446)
  ]
}))

// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xRenderer = am5xy.AxisRendererX.new(root, {
  minGridDistance: 50,
  minorGridEnabled: true
});

xRenderer.grid.template.setAll({
  location: 1,
});

xRenderer.labels.template.setAll({
  rotation: -75,
  centerY: am5.p50,
  centerX: am5.p100,
  paddingRight: 15
});

var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
  maxDeviation: 0.3,
  categoryField: "kabupaten",
  renderer: xRenderer,
  tooltip: am5.Tooltip.new(root, {})
}));

var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
  maxDeviation: 0.3,
  min: 0,
  renderer: am5xy.AxisRendererY.new(root, {
    strokeOpacity: 0.1
  })
}));

// Create series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series = chart.series.push(am5xy.ColumnSeries.new(root, {
  name: "Series 1",
  xAxis: xAxis,
  yAxis: yAxis,
  valueYField: "value",
  categoryXField: "kabupaten",
  tooltip: am5.Tooltip.new(root, {
    labelText: "{valueY}"
  }),
}));

series.columns.template.setAll({
  tooltipY: 0,
  tooltipText: "{categoryX}: {valueY}",
  shadowOpacity: 0.1,
  shadowOffsetX: 2,
  shadowOffsetY: 2,
  shadowBlur: 1,
  strokeWidth: 2,
  stroke: am5.color(0xffffff),
  shadowColor: am5.color(0x000000),
  cornerRadiusTL: 50,
  cornerRadiusTR: 50,
  fillGradient: am5.LinearGradient.new(root, {
    stops: [
      {}, // will use original column color
      { color: am5.color(0x000000) }
    ]
  }),
  fillPattern: am5.GrainPattern.new(root, {
    maxOpacity: 0.15,
    density: 0.5,
    colors: [am5.color(0x000000), am5.color(0x000000), am5.color(0xffffff)]
  })
});

series.columns.template.states.create("hover", {
  shadowOpacity: 1,
  shadowBlur: 10,
  cornerRadiusTL: 10,
  cornerRadiusTR: 10
})

series.columns.template.adapters.add("fill", function (fill, target) {
  return chart.get("colors").getIndex(series.columns.indexOf(target));
});

// Fetch and set data from JSON endpoint
fetch('{{ route('dashboard.chart-data') }}')
  .then(response => response.json())
  .then(data => {
    xAxis.data.setAll(data);
    series.data.setAll(data);
    
    // Make stuff animate on load
    series.appear(1000);
    chart.appear(1000, 100);
  });

  // Create root element
var root2 = am5.Root.new("chartdiv2");

// Set themes
root2.setThemes([
  am5themes_Animated.new(root2)
]);

// Create chart
var chart2 = root2.container.children.push(
  am5percent.PieChart.new(root2, {
    endAngle: 270,
    layout: root2.verticalLayout,
    innerRadius: am5.percent(60)
  })
);

// Create series
var series2 = chart2.series.push(
  am5percent.PieSeries.new(root2, {
    valueField: "value",
    categoryField: "jenis_kelamin",
    endAngle: 270
  })
);

series2.set("colors", am5.ColorSet.new(root2, {
  colors: [
    am5.color(0x73556E),
    am5.color(0x9FA1A6)
  ]
}))

var gradient = am5.RadialGradient.new(root2, {
  stops: [
    { color: am5.color(0x000000) },
    { color: am5.color(0x000000) },
    {}
  ]
})

series2.slices.template.setAll({
  fillGradient: gradient,
  strokeWidth: 2,
  stroke: am5.color(0xffffff),
  cornerRadius: 10,
  shadowOpacity: 0.1,
  shadowOffsetX: 2,
  shadowOffsetY: 2,
  shadowColor: am5.color(0x000000),
  fillPattern: am5.GrainPattern.new(root2, {
    maxOpacity: 0.2,
    density: 0.5,
    colors: [am5.color(0x000000)]
  })
})

series2.slices.template.states.create("hover", {
  shadowOpacity: 1,
  shadowBlur: 10
})

series2.ticks.template.setAll({
  strokeOpacity: 0.4,
  strokeDasharray: [2,2]
})

series2.states.create("hidden", {
  endAngle: -90
});

// Load data from API
fetch('{{ route('dashboard.chart-data2') }}')
  .then(response => response.json())
  .then(data => {
    series2.data.setAll(data);
    series2.appear(1000, 100);
  })
  .catch(error => console.error('Error:', error));

var legend2 = chart2.children.push(am5.Legend.new(root2, {
  centerX: am5.percent(50),
  x: am5.percent(50),
  marginTop: 15,
  marginBottom: 15,
}));
  
legend2.markerRectangles.template.adapters.add("fillGradient", function() {
  return undefined;
})
legend2.data.setAll(series2.dataItems);

// Create root element for the third chart
var root3 = am5.Root.new("chartdiv3");

// Set themes
root3.setThemes([
  am5themes_Animated.new(root3)
]);

// Create chart
var chart3 = root3.container.children.push(
  am5percent.PieChart.new(root3, {
    endAngle: 270,
    layout: root3.verticalLayout,
    innerRadius: am5.percent(60)
  })
);

// Create series
var series3 = chart3.series.push(
  am5percent.PieSeries.new(root3, {
    valueField: "value",
    categoryField: "status_pegawai",
    endAngle: 270
  })
);

series3.set("colors", am5.ColorSet.new(root3, {
  colors: [
    am5.color(0xF2AA6B),
    am5.color(0xF28F6B),
    am5.color(0xA95A52),
    am5.color(0xE35B5D)
  ]
}))

var gradient3 = am5.RadialGradient.new(root3, {
  stops: [
    { color: am5.color(0x000000) },
    { color: am5.color(0x000000) },
    {}
  ]
})

series3.slices.template.setAll({
  fillGradient: gradient3,
  strokeWidth: 2,
  stroke: am5.color(0xffffff),
  cornerRadius: 10,
  shadowOpacity: 0.1,
  shadowOffsetX: 2,
  shadowOffsetY: 2,
  shadowColor: am5.color(0x000000),
  fillPattern: am5.GrainPattern.new(root3, {
    maxOpacity: 0.2,
    density: 0.5,
    colors: [am5.color(0x000000)]
  })
})

series3.slices.template.states.create("hover", {
  shadowOpacity: 1,
  shadowBlur: 10
})

series3.ticks.template.setAll({
  strokeOpacity: 0.4,
  strokeDasharray: [2,2]
})

series3.states.create("hidden", {
  endAngle: -90
});

// Load data from API
fetch('{{ route('dashboard.chart-data3') }}')
  .then(response => response.json())
  .then(data => {
    series3.data.setAll(data);
    series3.appear(1000, 100);
  })
  .catch(error => console.error('Error:', error));

var legend3 = chart3.children.push(am5.Legend.new(root3, {
  centerX: am5.percent(50),
  x: am5.percent(50),
  marginTop: 15,
  marginBottom: 15,
}));
  
legend3.markerRectangles.template.adapters.add("fillGradient", function() {
  return undefined;
})
legend3.data.setAll(series3.dataItems);

}); // end am5.ready()
</script>
@endpush
