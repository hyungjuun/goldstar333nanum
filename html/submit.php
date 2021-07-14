<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Max-Age: 86400');
header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

$CUS_NM = $_REQUEST['name'];
$HP =  $_REQUEST['mobile'];
$AGE = $_REQUEST['age'];
$GENDER = $_REQUEST['gender'];
$AREA1 = $_REQUEST['province'];
$AREA2 = $_REQUEST['city'];


//$CUS_NM = "1";
//$HP =  "2";
//$AGE = "3";
//$GENDER = "4";
//$AREA1 = "5";
//$AREA2 = "6";

$conn = mysqli_connect(
  'localhost',
  'librenms',
  'libre!#57',
  'librenms');

$sql = "INSERT INTO TB_USER(
        NAME,
        HP ,
        AGE,
        SEX,
        AREA1,
        AREA2
    ) VALUES (
        '$CUS_NM',
        '$HP',
        $AGE,
        '$GENDER',
        '$AREA1',
        '$AREA2'
    )";

//echo $sql;

$result = mysqli_query($conn, $sql);

if($result === false){
    echo mysqli_error($conn);
}

// person.php �������� �̵�
echo ("<meta http-equiv='Refresh' content='1; URL=index3.html'>");
?>
