<?php

if(isset($_GET['id'])){
    include "../../config/konekcija.php";
    include "fsp.php";
    include "../look/lookFunctions.php";
    include_once "dohvatiPaginaciju.php";


    $id = $_GET['id'];

    if($id == 0){
        $sql = "SELECT * FROM look l INNER JOIN img i ON l.idNaslovneSlike=i.id LIMIT ".postOffset;
        $priprema = $conn->prepare($sql);
        $rezultat = $priprema->execute();

        if($rezultat) {
            if($priprema->rowCount() > 0) {
                $lookovi = $priprema->fetchAll();
                $brojLookova = dohvatiZaPaginaciju();
            } else {
                return "Look ne postoji";
            }
        } else {
            return "server error";
    }
    }else{
        $upit = "SELECT * FROM look l INNER JOIN img i ON l.idNaslovneSlike=i.id WHERE l.idKat LIKE :id LIMIT ".postOffset;
        $rezultat = $conn->prepare($upit);
        $rezultat->bindParam(":id", $id);
        $rezultat->execute();
    
        if($rezultat) {
            if($rezultat->rowCount() > 0) {
                $lookovi = $rezultat->fetchAll();
                $brojLookova = dohvatiZaPaginacijuPoKategoriji($id);
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