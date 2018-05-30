<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
        $q = intval($_GET['q']);

        $con = mysqli_connect('localhost','root','124123','dierenambulance');
        if (!$con) {
            die('Could not connect: ' . mysqli_error($con));
        }

        mysqli_select_db($con,"dierenambulance");
        $sql="SELECT * FROM knowns WHERE id = '".$q."'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);

        echo $row ['location_name'];
?>
</body>
</html>