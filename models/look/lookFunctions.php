<?php
function dohvatiLookSvi(){
    try {
        return executeQuery("SELECT * FROM look l INNER JOIN img i ON l.idL=i.idLook WHERE l.idNaslovneSlike=i.id");
    }catch(PDOException $ex){
        return null;
    }
}

function dohvatiLookJedan($id){
    try {
        return executeQueryOneRow("SELECT * FROM look l INNER JOIN img i ON l.idL=i.idLook WHERE l.idL = $id");
    }catch(PDOException $ex){
        return null;
    }
}

function dohvatiSveSlikeZaLook($id){
    try{
        return executeQuery("SELECT i.* FROM look l INNER JOIN img i ON l.idL=i.idLook WHERE l.idL= $id ORDER BY l.idNaslovneSlike Desc");
    }catch(PDOException $ex){
        return null;
    }
}


function dohvatiSveSlikeZaLookKojeNisuNaslovna($id){
    try{
        return executeQuery("SELECT i.* FROM look l INNER JOIN img i ON l.idL=i.idLook WHERE l.idL= $id AND l.idNaslovneSlike!=i.id ");
    }catch(PDOException $ex){
        return null;
    }
}

function dohvatiLookSaKat(){
    try {
        return executeQuery("SELECT * FROM look l INNER JOIN img i ON l.idL=i.idLook INNER JOIN kategorijeLook k on l.idKat=k.idK WHERE l.idNaslovneSlike=i.id");
    }catch(PDOException $ex){
        return null;
    }
}

function dohvatiLookSaKatSveSlikeKojeNisuNaslovna(){
    try {
        return executeQuery("SELECT * FROM look l INNER JOIN img i ON l.idL=i.idLook INNER JOIN kategorijeLook k on l.idKat=k.idK WHERE l.idNaslovneSlike!=i.id");
    }catch(PDOException $ex){
        return null;
    }
}

function dohvatiKategorije(){
    try {
        return executeQuery("SELECT * FROM kategorijeLook");
    }catch(PDOException $ex){
        return null;
    }
}

function dodavanjeNaslovne($src){

    $rezultat = $conn->prepare("INSERT INTO img VALUES (NULL, ?, ?, ?, now(), 0)");

    try {
        $rezultat->execute( [ $naziv, $opis, $idKat ] );

        http_response_code(201); // 201 - Created

        echo json_encode(["uspeh"=> "Uspesno kreirana kategorija!"]);
    }
    catch(PDOException $ex){
        echo json_encode(['greska'=> 'Problem sa bazom: ' . $ex->getMessage()]);
        http_response_code(500);
    }
}