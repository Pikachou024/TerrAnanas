<?php

    $articleModel = new ArticleModel();
    $articles = $articleModel ->getAllArticles();


include'../templates/articles.phtml';