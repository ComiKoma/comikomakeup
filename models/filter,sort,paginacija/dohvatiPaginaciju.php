<?php

header("Content-Type: application/json");
if(isset($_POST['strana'])){
    
    $strana = $_POST['strana'];
    include "../../config/konekcija.php";
    include "fsp.php";

    if(isset($_POST['id']) && ($_POST['id'])>0){
        $id = $_POST['id'];
        $l = sviLookoviPoKategoriji($strana, $id);
        $brojL = dohvatiZaPaginacijuPoKategoriji($id);

    }else if(isset($_POST['id']) && ($_POST['id'])>0 && isset($_POST['sort'])){
        $id = $_POST['id'];
        $sort = $_POST['sort'];
        $l = sviLookoviPoKategorijiISort($sort, $strana, $id);
        $brojL = dohvatiZaPaginacijuPoKategorijiISort($sort, $id);
    }else{
        $l = sviLookovi($strana);
        $brojL = dohvatiZaPaginaciju();
    }

    echo json_encode([
        "lookovi" => $l,
        "brojLookova" => $brojL
    ]);
}