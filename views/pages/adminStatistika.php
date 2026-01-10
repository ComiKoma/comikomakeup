<?php
if(!isset($_SESSION["korisnik"]) || !$_SESSION["korisnik"]->admin) {
    header("Location: ?page=404.php");
}
require_once "models/meni/adminFunctions.php";
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

<table class="table table-hover">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET" id="formLook">
<input type="hidden" id="idHidden" />
  <thead>
    <tr>
    <th scope="col">Trenutno aktivnih</th>
      <th scope="col">Strana</th>
      <th scope="col">Posećenost</th>
 
    </tr>
  </thead>
  <tbody id="adminStatistika">
      
    <tr>
      <td scope="row" rowspan="0"><?php brAktivnih();?></td>
    </tr>

    <?php
        $str = dohvatiZaAdminPanelSveStranice();
        $proc = pristupStranicamaUProcentima();  
        for($i = 0; $i < count($str); $i++):
    ?>
        <tr>
          <td data-id="" scope="row"><?= $str[$i]->nazivLinka?></td>
          <td scope="row"><?= $proc[$i]; ?>%</td>  
        </tr>
     <?php endfor;?>

    </tbody>
  </form>
</table>
</div>

