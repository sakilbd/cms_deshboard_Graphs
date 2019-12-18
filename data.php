<?php

$dataPoints = array(
    array("label"=>"Blue", "y"=>50.02),
    array("label"=>"Red", "y"=>50.55),
    array("label"=>"Green", "y"=>20.47),

)

?>

<?php
$dataPoints1 = array();
$dataPoints2 = array();
$updateInterval = 2000; //in millisecond
$initialNumberOfDataPoints = 100;
$x = time() * 1000 - $updateInterval * $initialNumberOfDataPoints;
$y1 = 1500;
$y2 = 1550;
// generates first set of dataPoints
for($i = 0; $i < $initialNumberOfDataPoints; $i++){
$y1 += round(rand(-2, 2));
$y2 += round(rand(-2, 2));
array_push($dataPoints1, array("x" => $x, "y" => $y1));
array_push($dataPoints2, array("x" => $x, "y" => $y2));
$x += $updateInterval;
}

?>
<?php

$dataPoints3 = array(
    array("x" => 1451586600000, "y" => 96.709),
    array("x" => 1454265000000, "y" => 94.918),
    array("x" => 1456770600000, "y" => 95.152),
    array("x" => 1459449000000, "y" => 97.070),
    array("x" => 1462041000000, "y" => 97.305),
    array("x" => 1464719400000, "y" => 89.854),
    array("x" => 1467311400000, "y" => 88.158),
    array("x" => 1469989800000, "y" => 87.989),
    array("x" => 1472668200000, "y" => 86.366),
    array("x" => 1475260200000, "y" => 81.650),
    array("x" => 1477938600000, "y" => 85.789),
    array("x" => 1480530600000, "y" => 83.846),
    array("x" => 1483209000000, "y" => 84.927),
    array("x" => 1485887400000, "y" => 82.609),
    array("x" => 1488306600000, "y" => 81.428),
    array("x" => 1490985000000, "y" => 83.259),
    array("x" => 1493577000000, "y" => 83.153),
    array("x" => 1496255400000, "y" => 84.180),
    array("x" => 1498847400000, "y" => 84.840),
    array("x" => 1501525800000, "y" => 82.671),
    array("x" => 1504204200000, "y" => 87.496),
    array("x" => 1506796200000, "y" => 86.007),
    array("x" => 1509474600000, "y" => 87.233),
    array("x" => 1512066600000, "y"=> 86.276)
);

$dataPoints4 = array(
    array("x"=> 1451586600000, "y" => 73.5555),
    array("x"=> 1454265000000, "y" => 74.1625),
    array("x"=> 1456770600000, "y" => 75.3980),
    array("x"=> 1459449000000, "y" => 76.0965),
    array("x"=> 1462041000000, "y" => 74.8165),
    array("x"=> 1464719400000, "y" => 74.9660),
    array("x"=> 1467311400000, "y" => 74.4805),
    array("x"=> 1469989800000, "y" => 74.7355),
    array("x"=> 1472668200000, "y" => 74.8155),
    array("x"=> 1475260200000, "y" => 73.2275),
    array("x"=> 1477938600000, "y" => 72.6315),
    array("x"=> 1480530600000, "y" => 71.4610),
    array("x"=> 1483209000000, "y" => 72.9025),
    array("x"=> 1485887400000, "y" => 70.5750),
    array("x"=> 1488306600000, "y" => 69.0955),
    array("x"=> 1490985000000, "y" => 70.0565),
    array("x"=> 1493577000000, "y" => 72.5320),
    array("x"=> 1496255400000, "y" => 73.8350),
    array("x"=> 1498847400000, "y" => 76.0255),
    array("x"=> 1501525800000, "y" => 76.1465),
    array("x"=> 1504204200000, "y" => 77.1570),
    array("x"=> 1506796200000, "y" => 75.4075),
    array("x"=> 1509474600000, "y" => 76.7690),
    array("x"=> 1512066600000, "y" => 76.5950)
);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {height: 550px}

        /* Set gray background color and 100% height */
        .sidenav {
            background-color: #f1f1f1;
            height: 100%;
        }

        /* On small screens, set height to 'auto' for the grid */
        @media screen and (max-width: 767px) {
            .row.content {height: auto;}
        }
    </style>
    <script>
        window.onload = function () {



            var chart2 = new CanvasJS.Chart("chartContainer2", {
                animationEnabled: true,
                title:{
                    text: "AveRage Temperature of Chillers"
                },
                subtitles: [{
                    text: "",
                    fontSize: 18
                }],
                axisY: {
                    includeZero: false,
                    prefix: ""
                },
                legend:{
                    cursor: "pointer",
                    itemclick: toggleDataSeries
                },
                toolTip: {
                    shared: true
                },
                data: [
                    {
                        type: "area",
                        name: "Blue",
                        showInLegend: "true",
                        xValueType: "dateTime",
                        xValueFormatString: "MMM YYYY",
                        yValueFormatString: "#,##0.##",
                        dataPoints: <?php echo json_encode($dataPoints1); ?>
                    },
                    {
                        type: "area",
                        name: "Red",
                        showInLegend: "true",
                        xValueType: "dateTime",
                        xValueFormatString: "MMM YYYY",
                        yValueFormatString: ",##0.##",
                        dataPoints: <?php echo json_encode($dataPoints2); ?>
                    }
                ]
            });

            chart2.render();

            function toggleDataSeries(e){
                if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                }
                else{
                    e.dataSeries.visible = true;
                }
                chart2.render();
            }

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
            var chart1 = new CanvasJS.Chart("chartContainer1", {
                animationEnabled: true,
                title: {
                    text: "CMS Sensor Temperature"
                },
                subtitles: [{
                    text: "November 2017"
                }],
                data: [{
                    type: "pie",
                    yValueFormatString: "#,##0.00\"%\"",
                    indexLabel: "{label} ({y})",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });



            chart.render();
            chart1.render();



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



<div class="container-fluid">
    <div class="row content">

        <br>

        <div class="col-sm-12">
            <div class="well">
                <h4>Dashboard</h4>
                <p>Some text..</p>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="well">
                        <div id="chartContainer1" style="height: 300px; width: 100%;"></div>
                        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="well">
                        <div id="chartContainer" style="height: 300px; width: 100%;""></div>
                    <script src="scripts/canvasjs.min.js"></script>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="well">

                    <div id="chartContainer2" style="height: 370px; width: 100%;"></div>
                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="well">
                    <p>Text</p>
                    <p>Text</p>
                    <p>Text</p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="well">
                    <p>Text</p>
                    <p>Text</p>
                    <p>Text</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <div class="well">
                    <p>Text</p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="well">
                    <p>Text</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

</body>
</html>
