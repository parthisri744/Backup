<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "parthisri";
try {
  $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
$table_name = "users";
$dir=__DIR__.'/'.date("d-m-Y");
$createdir=system("mkdir '$dir'");
//$permiss= "sudo chmod a+rwx $dir";
system("chmod a+rwx '".$dir."'");
$backup_file  =$dir.'/'.$table_name.'.csv';
echo "<br/>".$backup_file."<pre/>";
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
//$sql = "SELECT * INTO OUTFILE '$backup_file' FROM $table_name";
$sql = "SELECT * FROM  $table_name  INTO OUTFILE '$backup_file' FIELDS TERMINATED BY ',' ENCLOSED BY '' LINES TERMINATED BY '\n'";
try{
$result = $conn->query($sql);
}catch (PDOException $e){
   echo "File Already Exists";
  // echo "File Already Exists".$e->getMessage();
}
?> 