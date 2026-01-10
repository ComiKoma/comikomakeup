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

<div class="jumbotron">
    <div class="container">
        <p class="lead">Dobrodošli u admin panel, izaberite jednu od ponuđenih kategorija!</p>
    </div>
</div>