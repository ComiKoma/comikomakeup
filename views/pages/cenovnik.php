<?php
require "models/cenovnik/cenovnik.php";
?>
<h2 class="h1-responsive text-center my-4">Spisak usluga - cenovnik</h2>

<div class="container my-4">
    <div class="justify-content-center">
        <ul class="list-group list-group-flush">
        <?php
            $sveUsluge = dohvatiCenovnik();
            foreach($sveUsluge as $u):
        ?>
            <li class="list-group-item list-group-item-action"><p class="levo"><?=$u->nazivUsluge?></p><p class="desno"><?= $u->cena ?> din.</p></li>
        <?php
            endforeach;
        ?>
        </ul>
    </div>
    <div class="justify-content-center my-4">
        <div class="form-group">
            <a href="models/cenovnik/exportUExcel.php" class="btn btn-outline-secondary ">Export cenovnika u excel dokument</a>
            <span class="ispisObavestenja"></span>
        </div>
    </div>
</div>