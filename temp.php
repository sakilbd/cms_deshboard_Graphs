<!DOCTYPE HTML>
<html>
<head>
    <script>


        window.onload = function () {



            var chart = new CanvasJS.Chart("chartContainer", {
                title: {
                    text: "Temperature of Each Chiller"
                },
                axisY: {
                    title: "Temperature (°C)",
                    suffix: " °C"
                },
                data: [{
                    type: "column",
                    yValueFormatString: "#,### °C",
                    indexLabel: "{y}",
                    dataPoints: [
                        { label: "boiler1", y: 206.6 },
                        { label: "boiler2", y: 163 },
                        { label: "boiler3", y: 154 },
                        { label: "boiler4", y: 176 },
                        { label: "boiler5", y: 184 },
                        { label: "boiler6", y: 122 },
                        { label: "boiler7", y: 206 },
                        { label: "boiler8", y: 163 },
                        { label: "boiler9", y: 154 },
                        { label: "boiler10", y: 176 },
                        { label: "boiler11", y: 184 },
                        { label: "boiler12", y: 122 }
                    ]
                }]
            });

            function updateChart() {

                var boilerColor, deltaY, yVal;
                var dps = chart.options.data[0].dataPoints;
                for (var i = 0; i < dps.length; i++) {

                    deltaY = 2 + Math.random() *(-2-2);


                    yVal = deltaY + dps[i].y > 0 ? dps[i].y + deltaY : 0;
                    boilerColor = yVal > 170 ? "#FF2500" : yVal >= 100 ? "#0004fc" : yVal < 170 ? "#6B8E23 " : null;
                    dps[i] = {label: "Chiller "+(i+1) , y: yVal, color: boilerColor};
                }
                chart.options.data[0].dataPoints = dps;
                chart.render();
            };
            updateChart();

            setInterval(function() {updateChart()}, 50);

        }
    </script>
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 50%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>