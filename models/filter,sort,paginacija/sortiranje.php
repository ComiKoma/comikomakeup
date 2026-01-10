<?php
if(isset($_GET['sort'])){
    include "../../config/konekcija.php";
    include "fsp.php";
    include "../look/lookFunctions.php";
    include_once "dohvatiPaginaciju.php";


    $sort = $_GET['sort'];

    if($sort == 0){
        $upit = executeQuery("SELECT * FROM look l INNER JOIN img i ON l.idNaslovneSlike=i.id ORDER BY datumKacenja ASC LIMIT ".postOffset);

        if($upit) {
            if(count($upit) > 0) {
                $lookovi = $upit;
                $brojLookova = dohvatiZaPaginacijuSort($sort);
            } else {
                return "Look ne postoji";
            }
        } else {
            return "server error";
    }
    }else{
        $upit = executeQuery("SELECT * FROM look l INNER JOIN img i ON l.idNaslovneSlike=i.id ORDER BY datumKacenja DESC LIMIT ".postOffset);
    
        if($upit) {
            if(count($upit) > 0) {
                $lookovi = $upit;
                $brojLookova = dohvatiZaPaginacijuSort($sort);
            } else {
                return "Look ne postoji";
            }
        } else {
            return "server error";
        }    
    }

    echo json_encode([
        "lookovi" => $lookovi,
        "brojLookova" => $brojLookova
    ]);
} else {
    http_response_code(400);
}