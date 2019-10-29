<?php

$cdeCliquee = $_GET['numcde'];

require('modele/fonctions.php');

$detailCde = detailCommande($cdeCliquee);

$detailClient = Client($cdeCliquee);


include('utilities/header.phtml');
include('template/detail_cmde.phtml');
include('utilities/footer.phtml');

?>





