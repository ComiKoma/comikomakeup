<?php
if(!isset($_SESSION["korisnik"]) || !$_SESSION["korisnik"]->admin) {
    header("Location: ?page=404.php");
}
require_once "models/meni/adminFunctions.php";
require_once "models/cenovnik/cenovnik.php";
?>
<ul class="nav nav-tabs">
  <?php
    $q = dohvatiZaAdminPanel();
    foreach($q as $h):
  ?>
    <li class="nav-item">
    <a class="nav-link <?= (($_SERVER['PHP_SELF'] == SERVER.$h->hrefLinka) ? 'active' : '');?>" href="?page=<?=$h->hrefLinka?>"><?=$h->nazivLinka?></a>
    </li>
  <?php endforeach; ?>
</ul>

<div class="container">

<div class="form-group">
    <a href="#" class="btn btn-outline-secondary" data-toggle="modal" data-target="#modalCenovnikIzmena">Dodaj uslugu</a>
</div>

<table class="table table-hover text-center">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET" id="formCenovnik">
  <input type="hidden" id="idHidden" />
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Naziv usluge</th>
      <th scope="col">Cena</th>
      <th scope="col">Izmeni</th>
      <th scope="col">Obriši look</th>
    </tr>
  </thead>
  <tbody id="izmenaCenovnika">
  <?php
        $sveUsluge = dohvatiCenovnik();
        foreach($sveUsluge as $l):
    ?>
    <tr>
      <th data-id="<?= $l->id ?>" scope="row"><?= $l->id ?></th>
      <td><input type="text" data-id="<?= $l->id?>" name="izmenaNameU" class="izmenaNameU form-control" value="<?= $l->nazivUsluge ?>"></td>
      <td><input type="text" data-id="<?= $l->id?>" name="izmenaCenaU" class="izmenaCenaU form-control" value="<?= $l->cena ?>"></td>
      <td>
        <div class="text-center form-sm mt-2">
        <input type="hidden" name="">
        <a href="#" data-id="<?= $l->id?>" class="btn btn-outline-secondary uslugaIzmena">Sačuvaj izmene</a>
        </div>
    </td>
    <td>
        <div class="text-center form-sm mt-2">
        <input type="hidden" name="">
        <a href="#" data-id="<?= $l->id?>" class="btn btn-outline-secondary uslugaBrisanje">Obriši</a>
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
