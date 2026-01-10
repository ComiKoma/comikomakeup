 <?php

define("postOffset", 6);

function dohvatiZaPaginaciju(){
    try{
        global $conn;
        $result = $conn->query("SELECT COUNT(*) AS broj FROM look")->fetch();
        $broj = $result->broj;

        return ceil($broj / postOffset);

    }catch(PDOException $ex){

        return null;
    }
}


function dohvatiSveKategorije(){
    try{
        return executeQuery("SELECT * FROM kategorijeLook");

    }catch(PDOException $ex){

        return null;
    }
}

function sviLookovi($limit){
    try{
        global $conn;

        $select = $conn->prepare("SELECT *, l.idL FROM look l INNER JOIN img i ON l.idNaslovneSlike=i.id LIMIT :limit, :postOffset");
        $limit = $limit * postOffset;
        $select->bindParam(":limit", $limit,PDO::PARAM_INT);

        $offset = postOffset;
        $select->bindParam(":postOffset", $offset, PDO::PARAM_INT);

        $select->execute();
        return $select->fetchAll();

    }catch(PDOException $ex){

        return null;
    }
}

function dohvatiZaPaginacijuPoKategoriji($id){
    try{
        global $conn;
        $result = $conn->query("SELECT COUNT(*) AS brojLookova FROM look WHERE idKat = ".$id)->fetch();
        $brojLookova = $result->brojLookova;

        return ceil($brojLookova / postOffset);
        
    }catch(PDOException $ex){

        return null;
    }
    
}

function dohvatiZaPaginacijuSort($sort){
    if($sort == 0){
        try{
            global $conn;
            $result = $conn->query("SELECT COUNT(*) AS brojLookova FROM look ORDER BY datumKacenja ASC")->fetch();
            $brojLookova = $result->brojLookova;
    
            return ceil($brojLookova / postOffset);
            
        }catch(PDOException $ex){
    
            return null;
        }
    }else{
        try{
            global $conn;
            $result = $conn->query("SELECT COUNT(*) AS brojLookova FROM look ORDER BY datumKacenja DESC")->fetch();
            $brojLookova = $result->brojLookova;
    
            return ceil($brojLookova / postOffset);
            
        }catch(PDOException $ex){
    
            return null;
        }
    }
    
    
}

function dohvatiZaPaginacijuPoKategorijiISort($sort, $id){
    if($sort > 0){
        try{
            global $conn;
            $result = $conn->query("SELECT COUNT(*) AS brojLookova FROM look WHERE idKat = $id  ORDER BY datumKacenja DESC")->fetch();
            $brojLookova = $result->brojLookova;
    
            return ceil($brojLookova / postOffset);
            
        }catch(PDOException $ex){
    
            return null;
        }
    }else{
        try{
            global $conn;
            $result = $conn->query("SELECT COUNT(*) AS brojLookova FROM look WHERE idKat = $id")->fetch();
            $brojLookova = $result->brojLookova;
    
            return ceil($brojLookova / postOffset);
            
        }catch(PDOException $ex){
    
            return null;
        }
    }
}

function sviLookoviPoKategoriji($limit, $id){
    try{
        global $conn;

        $select = $conn->prepare("SELECT *, l.idL FROM look l INNER JOIN img i ON l.idNaslovneSlike=i.id WHERE l.idKat = :id LIMIT :limit, :postOffset");
        $limit = $limit * postOffset;
        $select->bindParam(":limit", $limit,PDO::PARAM_INT);
        $select->bindParam(":id", $id);

        $offset = postOffset;
        $select->bindParam(":postOffset", $offset, PDO::PARAM_INT);

        $select->execute();
        return $select->fetchAll();

    }catch(PDOException $ex){

        return null;
    }
}

function sviLookoviPoKategorijiISort($sort, $limit, $id){
    if($sort > 0){
    try{
        global $conn;

        $select = $conn->prepare("SELECT *, l.idL FROM look l INNER JOIN img i ON l.idNaslovneSlike=i.id WHERE l.idKat = :id LIMIT :limit, :postOffset ORDER BY datumKacenja DESC");
        $limit = $limit * postOffset;
        $select->bindParam(":limit", $limit,PDO::PARAM_INT);
        $select->bindParam(":id", $id);

        $offset = postOffset;
        $select->bindParam(":postOffset", $offset, PDO::PARAM_INT);

        $select->execute();
        return $select->fetchAll();

    }catch(PDOException $ex){

        return null;
    }
}else{
    try{
        global $conn;

        $select = $conn->prepare("SELECT *, l.idL FROM look l INNER JOIN img i ON l.idNaslovneSlike=i.id WHERE l.idKat = :id LIMIT :limit, :postOffset");
        $limit = $limit * postOffset;
        $select->bindParam(":limit", $limit,PDO::PARAM_INT);
        $select->bindParam(":id", $id);

        $offset = postOffset;
        $select->bindParam(":postOffset", $offset, PDO::PARAM_INT);

        $select->execute();
        return $select->fetchAll();

    }catch(PDOException $ex){

        return null;
    }
}
}
?>