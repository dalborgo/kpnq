<?php
/**
 * Created by IntelliJ IDEA.
 * User: Asten
 * Date: 13/06/2017
 * Time: 15:50
 */
include_once "sqlkit.php";
$id = $_GET['id'];
$dr = query("SELECT (IFNULL(SUM(prepagato),0)-IFNULL(SUM(costo_totale),0)) as totale FROM `kqi` where cliente_id ='" . $id . "' ;", $conn, true);
if ($dr["totale"] > 0)
    $cols = 'green';
else
    $cols = 'red';
echo '<span style="color:' . $cols . '">€' . ' ' . number_format($dr["totale"], 2, ',', '.') . '</span>';