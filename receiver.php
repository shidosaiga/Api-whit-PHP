<?php

date_default_timezone_set('Asia/Bangkok');

include_once dirname(__FILE__) . '/database.php';
$now = new DateTime();

if(
    Empty($_REQUEST['temp']) ||
    Empty($_REQUEST['humidity'])
){
    print "Request is Not Working.";
    exit();
}

$temp = $_REQUEST['temp'];
$humidity = $_REQUEST['humidity'];

$datenow = $now->format("Y-m-d H:i:s");
$sql = "INSERT INTO `temp` (`temp`,`humidity`,`date`) VALUES (:temp,:humidity,:datestamp)";

$query = $db->prepare($sql);

try {
    $db->beginTransaction();
    $query->bindParam(":temp",$temp,PDO::PARAM_INT);
    $query->bindParam(":humidity",$humidity,PDO::PARAM_INT);
    $query->bindParam(":datestamp",$datenow,PDO::PARAM_STR);

    $query->execute();
    // $db-.lastInsertId();
    $db->commit();

    print 'Date Has Been Saved.';

} catch (PDOException $e) {
    $db->rollback();
    print "ERROR!: ". $e->getMessage()."</br>";
}

?>