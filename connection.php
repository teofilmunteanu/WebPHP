<?php
$host="localhost";
$username="root";
$password="";
$dbName="examen1db";
$con=mysqli_connect($host, $username, $password, $dbName) or die("Failed to connect: ".mysqli_error($con));