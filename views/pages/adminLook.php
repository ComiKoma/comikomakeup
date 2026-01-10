<?php
if(!isset($_SESSION["korisnik"]) || !$_SESSION["korisnik"]->admin) {
    header("Location: ?page=404.php");
}
require_once "models/look/lookFunctions.php";
?>
<ul class="nav nav-tabs">
  <?php
    include_once "models/meni/adminFunctions.php";
    $q = dohvatiZaAdminPanel();
    foreach($q as $h):
  ?>
    <li class="nav-item">
    <a class="nav-link <?= (($_SERVER['PHP_SELF'] == SERVER.$h->hrefLinka) ? 'active' : '');?>" href="?page=<?=$h->hrefLinka?>"><?=$h->nazivLinka?></a>
    </li>
  <?php endforeach; ?>
</ul>
<div class="container">

<table class="table table-hover">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET" id="formLook">
  <input type="hidden" id="idHidden" />
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Naziv looka</th>
      <th scope="col">Opis</th>
      <th scope="col">Kategorija</th>
      <th scope="col">Datum kacenja</th>
      <th scope="col">Naslovna slika</th>
      <th scope="col">Izmeni</th>
      <th scope="col">Obriši look</th>
    </tr>
  </thead>
  <tbody id="izmenaLooka">
  <?php
        $sviLookovi = dohvatiLookSaKat();
        function ispisDatum($ts){
          $date = new dateTime($ts);
          $dt = $date->format("d.m.Y.");
          return $dt;
        }
        foreach($sviLookovi as $l):
    ?>
    <tr>
      <th data-id="<?= $l->idL ?>" scope="row"><?= $l->idL ?></th>
      <td><input type="text" data-id="<?= $l->idL?>" name="izmenaNameLooka" class="izmenaNameLooka form-control" value="<?= $l->nazivLooka ?>"></td>
      <td><textarea data-id="<?= $l->idL?>" name="izmenaOpisa" class="izmenaOpisa" form="formLook"><?= $l->opis ?></textarea></td>
      <td><?= $l->imeKat ?></td>
      <td><?= ispisDatum($l->datumKacenja); ?></td>

      <td>        
        <div class="naslovnaSlika">
        <select data-id="<?= $l->idL?>" class="odabirNaslovne form-control form-control-sm selectpicker show-tick">
        
        <option value="0"><?= "assets/img/look/".$l->src?></option>
        <?php
            $sveSlike = dohvatiSveSlikeZaLookKojeNisuNaslovna($l->idL);

            foreach($sveSlike as $s):
        ?>
        <option class="izmenaNaslovne" value="<?= $s->id?>"><?= "assets/img/look/".$s->src?></option>
        <?php
        endforeach;
        ?>
        </select>
        </div>
      </td>
      <td>
        <div class="text-center form-sm mt-2">
        <input type="hidden" name="">
        <a href="#" data-id="<?= $l->idL?>" class="btn btn-outline-secondary lookIzmena">Sačuvaj izmene</a>
        </div>
    </td>
    <td>
        <div class="text-center form-sm mt-2">
        <input type="hidden" name="">
        <a href="#" data-id="<?= $l->idL?>" class="btn btn-outline-secondary lookBrisanje">Obriši</a>
        </div>
    </td>
      
    </tr>
    <?php
        endforeach;
      ?>
  </tbody>
  </form>
</table>
</div>
<div class="container text-center">
      <span id="obavestenje"></span>
</div>
