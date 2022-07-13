<?php

$userModel = new userModel();
$users = $userModel ->getAllUsers();

include "../templates/users.phtml";