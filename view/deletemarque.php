<?php
include '../controller/marquec.php';
$marquec = new marquec();
$marquec->deletemarque($_GET["idmarque"]);
header('Location:Listmarque.php');