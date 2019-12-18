<?php
$con = mysqli_connect("localhost",'root','','aqualnbn_cms');
if(isset($_POST)) {
    $a = $_POST['date1'];
    $b = $_POST['date2'];
    $c= $_POST['name'];
    $d=$_POST['green'];
    $e=$_POST['blue'];
    $f=$_POST['blue1'];
    $g=$_POST['red'];
    #echo $a;
    #echo $c;
    $divID="select device_id from cms,devices where devices.id=cms.device_id and name='$c'";
    $div="";
    $redAvg="";
    $bluAvg="";
    $yelAvg="";
    $fire = mysqli_query($con, $divID);
    while ($result = mysqli_fetch_assoc($fire)) {
        #echo $result['device_id'];
        $div = $result['device_id'];
        BREAK;
    }
#echo "$div";
#echo "redAvg $redAvg";
    $red="SELECT COUNT(temperature) FROM `cms` where device_id='$div' AND temperature>='$g' AND DATE(updated_at) between '$a' and '$b'";
    $blu="SELECT COUNT(temperature) FROM `cms` where device_id='$div' AND temperature between '$e' and '$f' AND DATE(updated_at) between '$a' and '$b';";
    $green ="SELECT COUNT(temperature) FROM `cms` where device_id='$div' AND temperature<= '$d' AND DATE(updated_at) between '$a' and '$b';";
    $fire1 = mysqli_query($con, $red);
    while ($result1 = mysqli_fetch_assoc($fire1)) {
        #echo $result['device_id'];
        $redAvg = $result1['COUNT(temperature)'];
        echo "red $redAvg";
        BREAK;
    }
    $fire2 = mysqli_query($con, $blu);
    while ($result2 = mysqli_fetch_assoc($fire2)) {
        #echo $result['device_id'];
        $bluAvg = $result2['COUNT(temperature)'];
        echo "blue $bluAvg";
        BREAK;
    }
    $fire3 = mysqli_query($con, $green);
    while ($result3 = mysqli_fetch_assoc($fire3)) {
        #echo $result['device_id'];
        $yelAvg = $result3['COUNT(temperature)'];
        echo "yel $yelAvg";
        BREAK;
    }


    ?>

    <?php

}
?>



<html>
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],

                ['Temp Less Than : blu 0',  <?php echo (int)$bluAvg;?>],
                ['Temp More than :  red 20',   <?php echo (int)$redAvg;?>],
                ['Temp More than : yel 20',   <?php echo (int)$yelAvg;?>],


            ]);
            var data1 = google.visualization.arrayToDataTable([
                ['Date', 'Temperature','Humidity'],

                <?php
                $a = $_POST['range1'];
                $b = $_POST['range2'];

                if(isset($_GET)){
                    if(isset($_POST)){
                        $sql = "SELECT * FROM `cms` where device_id='12' AND DATE(updated_at) between '$a' and '$b'  ";}
                    else{

                    } }


                $fire = mysqli_query($con, $sql);
                while ($result = mysqli_fetch_assoc($fire)) {
                    echo "['" .date('m-d-y', strtotime($result['updated_at'])) . "'," . (double)$result['temperature'] . "," . (double)$result['humidity'] . "],";
                }

                ?>
            ]);
            var options = {
                title: 'My Daily Activities'
            };
            var options1 = {
                title: 'Company Performance',
                hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
                vAxis: {minValue: 0}
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            var chart1 = new google.visualization.LineChart(document.getElementById('curve_chart'));
            chart.draw(data, options);
            chart1.draw(data1, options1);
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script>
</head>
<body ng-app="">
<div id="piechart" style="width: 900px; height: 500px;"></div>
<form action="" method="post">
    <input type ="date" name="date1" placeholder="type device id no from" ><br>
    <input type ="date" name="date2" placeholder="yyyy-mm-dd" ><br>
    <input type ="text" name="green" style="background-color:green;color:white;" placeholder="Set Same temp" ><br>
    <input type ="text" name="blue" style="background-color:blue;color:white;" placeholder="Mention Lower range of Blue zone" ><br>
    <input type ="text" name="blue1" ng-model="name" style="background-color:blue;color:white;" placeholder="Mention Upper range for blue Zone" ><br>
    <input type ="text" name="red" style="background-color:red;color:white" placeholder="Value for RED zone" value="{{name}}" ><br>


    <td>Chiller Name</td>

    <select name="name">
        <?php

        $sql = mysqli_query($con, "SELECT name FROM devices");

        while ($row = $sql->fetch_assoc()){

            ?>
            <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>

            <?php
// close while loop
        }
        ?>
        <br>
        

<div id="curve_chart" style="width: 100%; height: 500px">

    <input type ="date" name="range1" placeholder="type device id no from" ><br>
    <input type ="date" name="range2" placeholder="yyyy-mm-dd" ><br>
    <input type="submit" name="post">
</form>
</div>
</body>
</html>