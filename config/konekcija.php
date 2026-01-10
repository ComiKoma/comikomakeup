<?php

require_once "config.php";

zabeleziPristupStranici();
pristupStranicamaUProcentima();

try {
    $conn = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8", USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){
    echo $ex->getMessage();
}

function executeQuery($query){
    global $conn;
    return $conn->query($query)->fetchAll();
}

function executeQueryOneRow($query){
    global $conn;
    return $conn->query($query)->fetch();
}

function zabeleziPristupStranici(){

    // $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";  
    // $CurPageURL = $_SERVER['REQUEST_URI'];

    $trenutniUrl = $_SERVER['REQUEST_URI'];
    $strana = substr($trenutniUrl, 7); //kada ode online bice 7
    $open = fopen(LOG_FAJL, "a");
    if($strana=="" || $strana == "/user/odjavljivanje.php" || $strana == "php"){
        return $strana="home.php";
    }

    if($open){
        $date = date('d/m/Y H:i:s');
        if(isset($_SESSION['korisnik'])){
            fwrite($open, "Strana:\t{$strana}\t{$date}\tKorisnikIP:{$_SERVER['REMOTE_ADDR']}\tNalog:{$_SESSION['korisnik']->username}\tIdKorisnika:{$_SESSION['korisnik']->id}\n");
            fclose($open);
        }else {
            fwrite($open, "Strana:\t{$strana}\t{$date}\tServer:{$_SERVER['REMOTE_ADDR']}\t{$_SERVER['HTTP_HOST']}\n");
            fclose($open);
        }
        //echo $strana;
    }
}



function trenutnoAktivni($idK){
    @$open=fopen(TRENUTNO_AKTIVNI,"a");
    if($open){
        $ulogovan = $idK."\n";
        @fwrite($open,$ulogovan);
        @fclose($open);
    }
}

function brAktivnih(){
    $broj = count(file(TRENUTNO_AKTIVNI));
    echo $broj;
}

function odjavioSe($idK){

    $idKor=(int)$idK;
    $brisanje="";
    @$fajl=file(TRENUTNO_AKTIVNI);
    if(count($fajl)){
        foreach($fajl as $f){
            $id=trim((int)$f);
            if($id!=$idKor){
                $brisanje.=$id."\n";
            }
        }
    }
    @$open=fopen(TRENUTNO_AKTIVNI,"w");
    if($open){
        @fwrite($open,$brisanje);
        @fclose($open);
    }
}


function pristupStranicamaUProcentima(){
    $str = "1 day ago";
    $timestamp = strtotime($str, time());
    $juce = date('d/m/Y H:i:s', $timestamp);
    
    $fajl=file(LOG_FAJL);
    if(count($fajl)){

    $brojRedova = count($fajl);

    $pocetna = 0;
    $makeup = 0;
    $autor = 0;
    $zakazi = 0;
    $cenovnik = 0;
    $admin = 0;
    $look = 0;
    $statistika = 0;
    $cenovnika = 0;


    for($i=0; $i < $brojRedova; $i++){
        
        $element = explode("\t", $fajl[$i]);
        //echo $element[2]; -> sviDatumiSpojeno

            $stranica = $element[1];
            
            //echo $stranica; -> sve stranice jedna uz drugu
            switch($stranica){
                case "":
                    $pocetna++;
                    //$vNiz++;
                break;
                case "home.php":
                    $pocetna++;
                    //$vNiz++;
                break;
                case "makeup.php":
                    $makeup++;
                    //$vNiz++;
                break;
                case "autor.php":
                    $autor++;
                    //$vNiz++;
                break;
                case "zakazi.php":
                    $zakazi++;
                    //$vNiz++;
                case "cenovnik.php":
                    $cenovnik++;
                    //$vNiz++;
                break;
                case "admin.php":
                    $admin++;
                    //$vNiz++;
                break;
                case "adminLook.php":
                    $look++;
                    //$vNiz++;
                break;
                case "adminStatistika.php":
                    $statistika++;
                    //$vNiz++;
                break;
                                case "adminCenovnik.php":
                    $cenovnika++;
                    //$vNiz++;
                break;
            }

        }
            
}
    
    $ukupno = $pocetna+$makeup+$autor+$zakazi+$cenovnik+$admin+$look+$statistika;
    
    $pristupPocetnoj = round($pocetna*100/$ukupno, 2);
    $pristupMakeup = round($makeup*100/$ukupno, 2);
    $pristupAutor = round($autor*100/$ukupno, 2);
    $pristupZakazi = round($zakazi*100/$ukupno, 2);
    $pristupCenovnik = round($cenovnik*100/$ukupno, 2);
    $pristupAdmin = round($admin*100/$ukupno, 2);
    $pristupLook = round($look*100/$ukupno, 2);
    $pristupStatistika = round($statistika*100/$ukupno, 2);
        $pristupCenovnikA = round($cenovnika*100/$ukupno, 2);

    
    $pristupUProcentima = [$pristupPocetnoj,$pristupMakeup,$pristupAutor,$pristupZakazi,$pristupCenovnik,$pristupAdmin,$pristupLook,$pristupCenovnikA,$pristupStatistika];
    return $pristupUProcentima;
    
}



function upisGresakaUTxtFajl($ex){
    
$open = fopen(ERROR_LOG, "a");
    if($open){
        $date = date('Y/m/d H:i:s');
        fwrite($open, "{$_SERVER['REQUEST_URI']}\t{$date}\t{$ex}\t\n");
        fclose($open);
    }
}