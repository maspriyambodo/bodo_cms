@extends('layouts.admin_template')
@push('stylesheet')
<style>
    #chartdiv {
        width: 100%;
        height: 500px;
    }
</style>
@endpush
@section('content')
<div class="card">
    <div class="card-body">
        <h1>Download Speed Gauge</h1>
        <div id="chartdiv"></div>
        <div class="text-center my-4">
            <button id="start-test" class="btn btn-success">Start Speed Test</button>
            <button id="stop-test" class="btn btn-secondary" disabled>Stop Speed Test</button>
        </div>
    </div>
</div>
@endsection
@push('scripts')

<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<script>
        am4core.ready(function() {
            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart
            var chart = am4core.create("chartdiv", am4charts.GaugeChart);
            chart.innerRadius = am4core.percent(82);

            // Create axis
            var axis = chart.xAxes.push(new am4charts.ValueAxis());
            axis.min = 0;
            axis.max = 100;
            axis.strictMinMax = true;
            axis.renderer.radius = am4core.percent(80);
            axis.renderer.inside = true;
            axis.renderer.line.strokeOpacity = 1;
            axis.renderer.ticks.template.disabled = false;
            axis.renderer.ticks.template.strokeOpacity = 1;
            axis.renderer.ticks.template.length = 10;
            axis.renderer.grid.template.disabled = true;
            axis.renderer.labels.template.radius = 40;
            axis.renderer.labels.template.adapter.add("text", function(text) {
                return text + " Mbps";
            });

            // Axis for ranges
            var colorSet = new am4core.ColorSet();
            var axis2 = chart.xAxes.push(new am4charts.ValueAxis());
            axis2.min = 0;
            axis2.max = 100;
            axis2.strictMinMax = true;
            axis2.renderer.labels.template.disabled = true;
            axis2.renderer.ticks.template.disabled = true;
            axis2.renderer.grid.template.disabled = true;

            var range0 = axis2.axisRanges.create();
            range0.value = 0;
            range0.endValue = 10;
            range0.axisFill.fillOpacity = 1;
            range0.axisFill.fill = colorSet.getIndex(0);

            var range1 = axis2.axisRanges.create();
            range1.value = 10;
            range1.endValue = 50;
            range1.axisFill.fillOpacity = 1;
            range1.axisFill.fill = colorSet.getIndex(2);
            
            var range2 = axis2.axisRanges.create();
            range2.value = 50;
            range2.endValue = 100;
            range2.axisFill.fillOpacity = 1;
            range2.axisFill.fill = colorSet.getIndex(3);

            // Label
            var label = chart.radarContainer.createChild(am4core.Label);
            label.isMeasured = false;
            label.fontSize = 45;
            label.x = am4core.percent(50);
            label.y = am4core.percent(100);
            label.horizontalCenter = "middle";
            label.verticalCenter = "bottom";
            label.text = "0 Mbps";

            // Hand
            var hand = chart.hands.push(new am4charts.ClockHand());
            hand.axis = axis2;
            hand.innerRadius = am4core.percent(20);
            hand.startWidth = 10;
            hand.pin.disabled = true;
            hand.value = 0;

            // Variables to manage the speed test
            let speedTestInterval;

            // Start speed test on button click
            document.getElementById('start-test').addEventListener('click', function() {
                // Disable the start button and enable the stop button
                this.disabled = true;
                document.getElementById('stop-test').disabled = false;

                // Start the speed test
                speedTestInterval = setInterval(function() {
                    fetch('speed-test-json')
                        .then(response => response.json())
                        .then(data => {
                            var value = data.download_speed_mbps;
                            var animation = new am4core.Animation(hand, {
                                property: "value",
                                to: value
                            }, 1000, am4core.ease.cubicOut).start();
                            label.text = value + " Mbps";
                        })
                        .catch(error => console.error('Error fetching speed test:', error));
                }, 2000);
            });

            // Stop speed test on button click
            document.getElementById('stop-test').addEventListener('click', function() {
                // Disable the stop button and enable the start button
                this.disabled = true;
                document.getElementById('start-test').disabled = false;

                // Clear the interval to stop the speed test
                clearInterval(speedTestInterval);
            });
        }); // end am4core.ready()
    </script>
@endpush