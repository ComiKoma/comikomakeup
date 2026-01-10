<?php
require "models/filter,sort,paginacija/fsp.php";
?>

<h2 class="h1-responsive text-center my-4">Dobrodošla u svet mejkapa</h2>
<p class="text-center w-responsive mx-auto mb-5">Zaviri u svet kreative COMIKOMAKEUP!</p>

<div class="container">

<div class="row text-center justify-content-center">
<div class="form-group form-inline">

        <!-------------- FILTRIRANJE PO KATEGORIJI -------------->
        <div id="kategorijeFilter" class ="col">
        <select id="ddlFilter" class="form-control selectpicker show-tick">
        
        <option value="0">Sve kategorije</option>
        <?php
            $sveKat = dohvatiSveKategorije();
            foreach($sveKat as $k):
        ?>
        <option value="<?= $k->idK?>"><?= $k->imeKat?></option>
        <?php
        endforeach;
        ?>
        </select>
        </div>


        <!------------------- SORTIRANJE PO DATUMU ---------------------->
        <div id="sortiranje" class ="col">
        <select id="ddlSort" class="form-control selectpicker show-tick">
        <option value="0">Prvo najstarije</option>
        <option value="1">Prvo najnovije</option>
        </select>
        </div>
</div>
</div>

<!------------------- PRIKAZ OBJAVA ---------------------->
<div id="makeup" class="flexic text-center justify-content-center">
<?php
    $lookovi = sviLookovi(0);
    function ispisDatum($ts){
        $date = new dateTime($ts);
        $dt = $date->format("d.m.Y.");
        return $dt;
      }
    foreach($lookovi as $l):
?>

<div class="card px-0 m-1 col-md-3 col-sm-4">
  <a href="?page=getone&id=<?= $l->idL?>">
  <img class="card-img-top" src="assets/img/look/<?= $l->src?>" alt="Card image cap">
  <div class="card-body">
  <p class="card-text"><?= $l->nazivLooka?></p></a>
  <p class="card-text"><small class="text-muted"><?= ispisDatum($l->datumKacenja); ?></small></p>
  </div>
</div>

<?php
endforeach;
?>
</div>
<!------------------- PRIKAZ OBJAVA - KRAJ ---------------------->


<!------------------- PAGINACIJA ---------------------->

<nav aria-label="...">
        <ul class="pagination justify-content-center m-4"  id="pagination">
            <?php
                $brojProizvoda = dohvatiZaPaginaciju();
                for($i = 1; $i <= $brojProizvoda; $i++):
            ?>
                <li class="page-item">
                    <a class="page-link post-pagination" href="#" data-page="<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>

<!------------------- PAGINACIJA - KRAJ ---------------------->


</div>

