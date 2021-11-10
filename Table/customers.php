<?php
$connect = mysqli_connect("localhost", "root", "", "Hospital");

$result = mysqli_query($connect, "select * from patientdetails");

$data = array();

while ($row = mysqli_fetch_array($result)) {
  $data[] = $row;
}
    print json_encode($data);
 ?>