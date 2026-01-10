<?php

function dohvatiHeader(){
    return executeQuery("SELECT * FROM meniLink WHERE meniId=1 AND adminLink = 0");
}

function dohvatiHeaderZaAdmina(){
    return executeQuery("SELECT * FROM meniLink WHERE meniId=1 AND nazivLinka='Admin panel'");
}

function dohvatiHeaderSvi(){
    return executeQuery("SELECT * FROM meniLink");
}