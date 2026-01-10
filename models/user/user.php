<?php

function dohvatiKorisnikaPoMailu($mail){
    global $conn;

        try {
            $dohvatiKorisnika = $conn->prepare("SELECT * FROM korisnik WHERE email = ?");
            $dohvatiKorisnika->execute([$mail]);
            
            $korisnik= $dohvatiKorisnika->fetch();
    
            return $korisnik;
    
        } catch(PDOException $ex){
            return null;
        }
}

function dohvatiKorisnikaPoId($id){
    global $conn;

        try {
            $dohvatiKorisnika = $conn->prepare("SELECT * FROM korisnik WHERE id = ?");
            $dohvatiKorisnika->execute([$id]);
            
            $korisnik= $dohvatiKorisnika->fetch();
    
            return $korisnik;
    
        } catch(PDOException $ex){
            return null;
        }
}

function dohvatiKorisnikaPoIdZaIzmenu($id){
    try {
        return executeQueryOneRow("SELECT * FROM korisnik WHERE id = $id");

    } catch(PDOException $ex){
        return null;
    }
}

function dohvatiKorisnikaPoKorisnickomImenu($korIme){
    global $conn;

    try {
        $dohvatiKorisnika = $conn->prepare("SELECT * FROM korisnik WHERE username = ?");
        $dohvatiKorisnika->execute([$korIme]);
        
        $user= $dohvatiKorisnika->fetch();

        return $user;

    } catch(PDOException $ex){
        return null;
    }
}

/******************************* REGISTROVANJE *************************************/

function dodajKorisnika($username, $email, $pass){
    global $conn;

    try {
        $dodajKorisnika = $conn->prepare("INSERT INTO korisnik (username, email, pass, profilna, manjaProfilna) VALUES(?, ?, ?, 'assets/img/user/default.png','assets/img/user/novi_159249800431.png')");
               
        $dodajKorisnika->execute([$username, $email, md5($pass)]);

        return "UPISAN JE U BAZU !";

    } catch(PDOException $ex){
        echo $ex;
        return null;
    }
}

/*********** Slanje maila *************/

function slanjeMaila($mail){
    global $conn;
    
     $dohvatiMejl = $conn->prepare("SELECT * FROM korisnik WHERE email=?");
     $dohvatiMejl->execute([$mail]);
     
     $mejl= $dohvatiMejl->fetch();
    
     try{
         $email=$mail;
         $naslov="COMIKOMAKEUP - login";
         $poruka="Poštovani, neko je pokušao da se prijavi na COMIKOMAKEUP sajt koristeći Vaš e-mail.";
         $zaglavlje="From: comikomakeup.ml/";
         mail($email, $naslov, $poruka, $zaglavlje);
     }catch(Exception $ex){
         echo $ex->getMessage();
         upisGresakaUTxtFajl($ex->getMessage());
     }



}

/*****************     Regularni izrazi       *****************/ 

function validate_username($regUsername){
    if( !preg_match("/^[ŠĐĆČŽA-zšđćžč\d_]{2,20}$/", $regUsername))
    {
        return false;
    }	
    return true;

}

function validate_email($regMail){
    if( !preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $regMail))
    {
        return false;
    }	
    return true;
}

function validate_pass($regPass){
    if( !preg_match("/^(?=.*\d).{4,32}$/", $regPass))
    {
         return false;
    }	
    return true;
}
?>