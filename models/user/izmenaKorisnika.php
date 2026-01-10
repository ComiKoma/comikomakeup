<?php
function promenaKorImena($korIme, $id){
    global $conn;

    try {
        $update_user = $conn->prepare("UPDATE korisnik SET username = ? WHERE id = ?");
               
        $update_user->execute([$korIme, $id]);

        return true;

    } catch(PDOException $ex){
        upisGresakaUTxtFajl($ex->getMessage());
        return false;
    }
}

function promenaLozinke($pass, $id){
    global $conn;

    try {
        $update_user = $conn->prepare("UPDATE korisnik SET pass = ? WHERE id = ?");
               
        $update_user->execute([$pass, $id]);

        return true;

    } catch(PDOException $ex){
        upisGresakaUTxtFajl($ex->getMessage());
        return false;
    }
}

function promenaProfilne($novaSlika, $novaSlikaManja, $id){
    global $conn;

    try {
        $update_user = $conn->prepare("UPDATE korisnik SET profilna = ?, manjaProfilna = ? WHERE id = ?");
               
        $uspelo = $update_user->execute([$novaSlika, $novaSlikaManja, $id]);

        return $uspelo;

    } catch(PDOException $ex){
        echo $ex;
        return false;
    }
}

?>