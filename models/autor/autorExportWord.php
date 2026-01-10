<?php
require_once "../../config/konekcija.php";
include "autor.php";

$filename = 'MilicaPavlovic7317.doc';
header("Content-type: application/vnd.ms-word");
header( "Content-Disposition: attachment; filename=".basename($filename));
header( "Content-Description: File Transfer");
@readfile($filename);

$autor = dohvatiSveOAutoru();
foreach($autor as $a){
    $content = "<html><head><meta charset='utf-8'><style>
    @page
    {
    font-family: Arial;
    size:215.9mm 279.4mm; / A4 /
    margin:14.2mm 17.5mm 14.2mm 16mm; / Margins: 2.5 cm on each side /
    }
    h2 { font-family: Arial; font-size: 18px; text-align:center; }
    p.para {font-family: Arial; font-size: 13.5px; text-align: justify;}
    </style></head><body><h2>$a->naslov</h2><br/><p>$a->opis</p></body></html>";
}

echo $content;
?>
