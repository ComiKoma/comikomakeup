<?php
require "models/meni/headerFunctions.php";
require "models/user/user.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>comikomakeup</title>
        <meta name="author" content="Milica Pavlović"/>
        <meta name="keywords" content="make, makeup, makeupcomi, comikomakeup, comi, makeupCOMI, damu, naše, pogledajte, prilike, proizvode, svaku, sminkanje, šminkanje, šminkica, Šminka, šminka, proizvodi, cena proizvodi, proizvod, puder, paleta, senki, konture, konturisanje, cetkice,cetke, četke, četkice, bredovi, huda,too faced, cala, makeup revolution, dodaj u korpu, sortiraj, kategorije, kategoriji, korpu, korpa">
        <meta name="description" content="COMIKOMAKEUP - Make up artist Milica Pavlović">
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="assets/img/logo/logo.png" id="logo">
      </head>
    <body>
        <div id="wrapper">
          
            <div id="header">
                <nav class="navbar navbar-expand-lg">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="?page=home.php">C O M I K O M A K E U P</a>
                  
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                      <?php
                        $q = dohvatiHeader();
                        foreach($q as $h):
                      ?>
                        <li class="nav-item">
                          <a class="nav-link" href="?page=<?=$h->hrefLinka?>"><?=$h->nazivLinka?><span class="sr-only">(current)</span></a>
                        </li>
                      <?php
                        endforeach;
                      ?>
                      <?php
                      if(isset($_SESSION['id']) && isset($_SESSION["korisnik"]) && $_SESSION["korisnik"]->admin):
                        $link = dohvatiHeaderZaAdmina();
                        foreach($link as $l):
                      ?>
                      <li class="nav-item">
                          <a class="nav-link" href="?page=<?=$l->hrefLinka?>"><?=$l->nazivLinka?><span class="sr-only">(current)</span></a>
                      </li>
                      <?php
                          endforeach;
                        endif;
                      ?>
                      
                      </ul>


                      <ul class="nav navbar-nav ml-auto levo">
                          <?php
                            if(isset($_SESSION['id']) ):
                              $korisnik = dohvatiKorisnikaPoId($_SESSION['id']);
                          ?>
                            
                            <li class="liProfilna"><a href="#" class="liProfilna"><img class="img-fluid rounded-circle mx-2 userLogin" alt="profilna slika" src="<?= $korisnik->profilna ?>"/></a></li>
                            <li><a href="?page=korisnik.php" class="nav-link"><?= $korisnik->username ?> </a></li>
                            <li><a href="models/user/odjavljivanje.php" class="nav-link"> Odjava</a></li>
                          <?php
                            endif;
                          ?>

                          <?php if(!isset($_SESSION['id'])): ?>

                          <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#modalLRForm">Prijava<span class="sr-only">(current)</span></a>
                          </li>

                          <?php
                            endif;
                          ?>
                      </ul>
                    </div>
                  </nav>
            </div>