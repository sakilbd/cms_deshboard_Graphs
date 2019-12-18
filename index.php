<?php

$dataPoints = array(
    array("label"=>"Blue", "y"=>50.02),
    array("label"=>"Red", "y"=>50.55),
    array("label"=>"Green", "y"=>20.47),

)

?>
<!DOCTYPE HTML>
<html>
<head>
    <script>
        window.onload = function() {


            var chart = new CanvasJS.Chart("chartContainer", {
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

        }
    </script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="scripts/canvasjs.min.js"></script>
</body>
</html>