<?php

$userModel = new userModel();
$users = $userModel ->getAllUsers();

$title="Liste clients";
$template="users";

include "../templates/base_admin.phtml";