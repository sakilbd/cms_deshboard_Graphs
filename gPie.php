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

                ['Temperature between  ',  <?php echo (int)$bluAvg;?>],
                ['Temperature More than',   <?php echo (int)$redAvg;?>],
                ['Temperature less than ',   <?php echo (int)$yelAvg;?>]


            ]);
            var options = {
                title: ' <?php echo $_POST['name'] ?>'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script>
</head>
<body ng-app="">
<div id="piechart" style="width: 900px; height: 500px;"></div>
<form action="" method="post">
    <input type ="date" name="date1" placeholder="type device id no from" ><br>
    <input type ="date" name="date2" placeholder="yyyy-mm-dd" ><br>
    <input type ="text" name="green" style="background-color:yellow;color:black;" placeholder="Set Same temp" ><br>
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

    <input type="submit" name="post">
</form>
</body>
</html>