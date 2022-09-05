<?php

$commandeModel = new CommandeModel();
$commandes = $commandeModel -> getAllCommandes();

$title = "Listes des commandes";
$template="commande_admin";
include "../templates/base_admin.phtml";