<?php

$dataPoints = array(
    array("label"=>"Blue", "y"=>15),
    array("label"=>"Red", "y"=>25),
    array("label"=>"Green", "y"=>60),

)

?>
<?php

$dataPoints1 = array();
$dataPoints2 = array();
$dataPoints3 = array();
$updateInterval = 200; //in millisecond
$initialNumberOfDataPoints = 1000;
$x = time() * 1000 - $updateInterval * $initialNumberOfDataPoints;
$y1 = 65;
$y2 = 80;
$y3 = 45;
// generates first set of dataPoints
for($i = 0; $i < $initialNumberOfDataPoints; $i++){
    $y1 += round(rand(-2, 2));
    $y2 += round(rand(-2, 2));
    $y3 += round(rand(-2, 2));
    array_push($dataPoints1, array("x" => $x, "y" => $y1));
    array_push($dataPoints2, array("x" => $x, "y" => $y2));
    array_push($dataPoints3, array("x" => $x, "y" => $y3));
    $x += $updateInterval;
}

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

                              html, body {
                                  height: 100%;
                                  margin: 0;
                              }

        #wrapper {
            min-height: 100%;
        }

    </style>
    <script>
        window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer", {

                backgroundColor: "#28487a",
                title: {
                    text: "Temperature of Each Chiller",
                    fontColor: "white"
                },
                legend: {
                    fontColor: "#ffffff"
                },
                axisY: {
                    labelFontColor: "#ffffff",
                    title: "Temperature (°C)",
                    suffix: " °C"
                },
                axisX: {
                    labelFontColor: "#ffffff"
                },
                data: [{
                    type: "column",
                    yValueFormatString: "#,### °C",
                    indexLabel: "{y}",
                    dataPoints: [
                        { label: "boiler1", y: 20},
                        { label: "boiler2", y: 30 },
                        { label: "boiler3", y: 50 },
                        { label: "boiler4", y: 60 },
                        { label: "boiler5", y: 25 },
                        { label: "boiler6", y: 35 },
                        { label: "boiler7", y: 12 },
                        { label: "boiler8", y: 37 },
                        { label: "boiler9", y: 67 },
                        { label: "boiler10", y: 90 },
                        { label: "boiler11", y: 50 },
                        { label: "boiler12", y: 45}
                    ]
                }]
            });
            var chart1 = new CanvasJS.Chart("chartContainer1", {
                animationEnabled: true,
                backgroundColor: "#28487a",
                title: {
                    fontColor:"#ffffff",
                    text: "CMS Sensor's Average Temp of Month"
                },
                subtitles: [{
                    fontColor:"#ffffff",

                    text: "November 2019"
                }],
                data: [{
                    indexLabelFontColor: "#ffffff",
                    type: "pie",
                    yValueFormatString: "#,##0.00\"%\"",
                    indexLabel: "{label} ({y})",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });


            var updateInterval = <?php echo $updateInterval ?>;
            var dataPoints1 = <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>;
            var dataPoints2 = <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>;
            var dataPoints3 = <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>;
            var yValue1 = <?php echo $y1 ?>;
            var yValue2 = <?php echo $y2 ?>;
            var yValue3 = <?php echo $y3 ?>;
            var xValue = <?php echo $x ?>;

            var chart2 = new CanvasJS.Chart("chartContainer2", {
                zoomEnabled: true,
                backgroundColor: "#28487a",
                title: {
                    fontColor: "#ffffff",
                    text: "Live Temperature Graph of all Chillers"
                },
                axisX: {
                    labelFontColor: "#ffffff",
                    title: "chart updates every " + updateInterval / 1000 + " secs"
                },
                axisY:{
                    labelFontColor: "#ffffff",
                    suffix: "°C",
                    includeZero: false
                },
                toolTip: {

                    shared: true
                },
                legend: {
                    cursor:"pointer",
                    verticalAlign: "top",
                    fontSize: 22,
                    fontColor: "#ffffff",
                    itemclick : toggleDataSeries
                },
                data: [{
                    type: "line",
                    name: "Blue(<70°C)",
                    xValueType: "dateTime",
                    yValueFormatString: "#,### watts",
                    xValueFormatString: "hh:mm:ss TT",
                    showInLegend: true,
                    legendText: "{name} " ,
                    dataPoints: dataPoints1
                },
                    {
                        type: "line",
                        name: "Red(>70°C)" ,
                        xValueType: "dateTime",
                        yValueFormatString: "#,### watts",
                        showInLegend: true,
                        legendText: "{name} ",
                        dataPoints: dataPoints2
                    },
                    {
                        type: "line",
                        name: "Green(<50°C)" ,
                        xValueType: "dateTime",
                        yValueFormatString: "#,### watts",
                        showInLegend: true,
                        legendText: "{name} ",
                        dataPoints: dataPoints3
                    }]
            });

            chart.render();


            chart1.render();
            chart2.render();



            function toggleDataSeries(e) {
                if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                }
                else {
                    e.dataSeries.visible = true;
                }
                chart2.render();
            }

            function updateChart() {
                var deltaY1, deltaY2;
                xValue += updateInterval;
                // adding random value
                yValue1 += Math.round(2 + Math.random() *(-2-2));
                yValue2 += Math.round(2 + Math.random() *(-2-2));
                yValue3 += Math.round(2 + Math.random() *(-2-2));

                // pushing the new values
                dataPoints1.push({
                    x: xValue,
                    y: yValue1
                });
                dataPoints2.push({
                    x: xValue,
                    y: yValue2
                });
                dataPoints3.push({
                    x: xValue,
                    y: yValue3
                });

                // updating legend text with  updated with y Value
                chart.options.data[0].legendText = "Building A " + yValue1 + " watts";
                chart.options.data[1].legendText = " Building B " + yValue2+ " watts";
                chart.render();
            }
            function updateChart1() {
                var boilerColor, deltaY, yVal;
                var dps = chart.options.data[0].dataPoints;
                var deltaY1, deltaY2;
                xValue += updateInterval;
                // adding random value
                yValue1 += Math.round(2 + Math.random() *(-2-2));
                yValue2 += Math.round(2 + Math.random() *(-2-2));
                yValue3 += Math.round(2 + Math.random() *(-2-2));
                // pushing the new values
                dataPoints1.push({
                    x: xValue,
                    y: yValue1
                });
                dataPoints2.push({
                    x: xValue,
                    y: yValue2
                });
                dataPoints3.push({
                    x: xValue,
                    y: yValue3
                });

                for (var i = 0; i < dps.length; i++) {
                    deltaY = 2 + Math.random() *(-2-2);
                    yVal = deltaY + dps[i].y > 0 ? dps[i].y + deltaY : 0;
                    boilerColor = yVal > 60 ? "#FF2500" : yVal > 50 ? "#727bf7" : yVal < 50? "#6B8E23 " : null;
                    dps[i] = {label: "Chiller "+(i+1) , y: yVal, color: boilerColor};
                }
                chart.options.data[0].dataPoints = dps;
                chart.render();
                chart2.render();
            };

            updateChart1();


            setInterval(function() {updateChart1()}, 1000);


        }
    </script>

</head>
<body>



<div class="container-fluid " style="background-color: #3b6ab4;height:100% ">

    <div class="row content">



        <div class="col-sm-12" style="background-color:#3b6ab4 ;padding:5px">
            <div class="row">
                <div class="col-sm-12" >
                    <div class="" style="height:50px;background-color:#28487a ;padding:5px;margin-bottom:10px"><h4 align="center" style="color: white">Dashboard</h4></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 " style="padding-right:0;" >
                    <div class="" style="background-color: black;border-color: transparent">
                        <div id="chartContainer1" style="height: 300px; width: 100%;"></div>
                        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                    </div>
                </div>
                <div class="col-md-8" style="">
                    <div  class="" style="background-color: black;border-color: transparent">
                        <div id="chartContainer" style="height: 300px; width: 100%;""></div>
                        <script src="scripts/canvasjs.min.js"></script>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div  class="" style="background-color: black;margin-top:10px;margin-bottom:5px;border-color: transparent">

                        <div id="chartContainer2" style="height: 370px; width: 100%;"></div>
                        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

</body>
</html>
