<?php
function dohvatiZaAdminPanel(){
    try{
        return executeQuery("SELECT * FROM meniLink WHERE meniId=2");
    }catch(PDOException $ex){
        if($ex) {
            return "Server je vratio grešku: ".$ex;
        } else {
            return "Link u admin panelu ne postoji";
        }
    }
}


function dohvatiZaAdminPanelSveStranice(){
    try{
        return executeQuery("SELECT * FROM meniLink WHERE hrefLinka NOT LIKE 'dokumentacija.pdf' AND hrefLinka NOT LIKE 'sitemap.xml'");
    }catch(PDOException $ex){
        if($ex) {
            return "Server je vratio grešku: ".$ex;
        } else {
            return "Link u admin panelu ne postoji";
        }
    }
}