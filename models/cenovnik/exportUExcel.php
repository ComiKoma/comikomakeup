<?php
$filename = "Cenovnik.xls";
header("Content-type: application/vnd.ms-excel");
header( "Content-Disposition: attachment; filename=".basename($filename));
header( "Content-Description: File Transfer");

require_once "../../config/konekcija.php";
require_once "../../config/config.php";
include "cenovnik.php";

$output = '';
try{
$cenovnik = dohvatiCenovnik();

$output .= '
<table class="table" bordered="1">  
<tr>  
    <th>Naziv usluge</th>  
    <th>Cena</th>  
</tr>
';
foreach($cenovnik as $c)
{
$output .= '
<tr>
    <td>'.$c->nazivUsluge.'</td>  
    <td>'.$c->cena.'</td>  
</tr>
';
}
$output .= '</table>';

echo $output;
}catch(PDOException $ex){
    upisGresakaUTxtFajl($ex->getMessage());
}