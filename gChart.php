<?php
$con = mysqli_connect("localhost",'root','','aqualnbn_cms');

if($con){
    echo "connected to aqualnbn_cms Database";
}




/*if(isset($_GET)){
    if(isset($_POST)){
       #$sql = "SELECT * FROM `cms` where DATE(updated_at) between '$a' and '$b' ";}
    else{

    } }


$fire = mysqli_query($con, $sql);
#while ($result = mysqli_fetch_assoc($fire)) {


    #echo date('d-M-Y', strtotime($result['updated_at']));
}
*/

?>

<html>

<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Date', 'Temperature','Humidity'],

                <?php
                    $a = $_POST['range1'];
                $b = $_POST['range2'];

            $c=$_POST['name'];
                $divID="select device_id from cms,devices where devices.id=cms.device_id and name='$c'";
                $div="";

                $fire = mysqli_query($con, $divID);
                while ($result = mysqli_fetch_assoc($fire)) {
                    #echo $result['device_id'];
                    $div = $result['device_id'];
                    BREAK;
                }
                    if(isset($_GET)){
                        if(isset($_POST)){
                        $sql = "SELECT * FROM `cms` where device_id='$div' AND DATE(updated_at) between '$a' and '$b'  ";}
                        else{

                        } }


                $fire = mysqli_query($con, $sql);
                while ($result = mysqli_fetch_assoc($fire)) {
                    echo "['" .date('m-d-y', strtotime($result['updated_at'])) . "'," . (double)$result['temperature'] . "," . (double)$result['humidity'] . "],";
                }

                ?>
            ]);

            var options = {
                title: 'Chiller Temperature Graph',
                hAxis: {title: '<?php echo $_POST['name'] ?>',  titleTextStyle: {color: '#333'}},
                vAxis: {minValue: 0}
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }
    </script>
</head>
<body>
<div class="container">
<div class="row">
<div class="col-sm-10" id="curve_chart" style="width: 100%; height: 500px">
</div>
<form action="" method="post">
    <input type ="date" name="range1" placeholder="yyyy-mm-dd" ><br>
    <input type ="date" name="range2" placeholder="yyyy-mm-dd" ><br>
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
</div>
</div>
</body>
</html>