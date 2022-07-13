<?php

$idArticle = $_GET['id'];

$articleModel = new ArticleModel();
$articleModel->deleteArticle($idArticle);

header('location: articles');
exit;