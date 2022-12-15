<?php

class ArticleAdmin extends AbstractController
{
    function articles(){
        $role = getUserRole();

//        if($role != "admin") {
//            http_response_code(403);
//            echo("Désolé la page n'existe pas");
//            exit;
//        }

        $articleModel = new ArticleModel();
        $articles = $articleModel ->getAllArticles();
        $statutModel = new StatusModel();
        $statut = $statutModel->getAllstatusArticle();

        if(!empty($_POST['articleSearch'])){
            $articleSearch = $_POST['articleSearch'];
            $_SESSION['articleSearch'] = searchArticle($articleSearch,$articles);
            $params['articleSearch']=$articleSearch;

        }else{
            unset( $_SESSION['articleSearch']);
        }
        $params['articles']=$articles;
        $params['statutArticle']=$statut;
        $params['title']="Admin - Liste des articles";
        $this->render($this->file, $this->page, $this->base, $params);
    }

    function addArticle(){
        $label='';
        $origine='';
        $prix='';
        $poids='';
        $error=[];

        $familleModel = new FamilleModel();
        $familles = $familleModel ->getAllFamille();
        $uniteModel = new UniteModel();
        $unites = $uniteModel ->getAllUnite();
        $statutModel = new StatusModel();
        $statut = $statutModel->getAllstatusArticle();

        if(!empty($_POST)){
            $label = strip_tags(trim($_POST['label']));
            $origine = strip_tags(trim($_POST['origine']));
            $prix =  strip_tags(trim($_POST['prix']));
            $poids =  strip_tags(trim($_POST['poids']));
            $famille = strip_tags(trim($_POST['famille']));
            $unite =  strip_tags(trim($_POST['unite']));
            $statut = strip_tags(trim($_POST['statut']));

            if(!$label){
                $error['label']="Le champ est vide";
            }
            if(!$origine){
                $error['origine']="Le champ est vide";
            }
            if(!$prix){
                $error['prix']="Le champ est vide";
            }
            if(!$poids){
                $error['poids']="Le champ est vide";
            }
            if($famille == 0){
                $error['famille']="Veuillez sélectionner un champ";
            }
            if($unite == 0){
                $error['unite']="Veuillez sélectionner un champ";
            }
            if($statut == 0){
                $error['unite']="Veuillez sélectionner un champ";
            }

            if(empty($error)){
                $articleModel = new ArticleModel();
                $articleModel ->addArticle($label,$poids,$unite,($prix*100),$origine,$famille,$statut);

                header('location: articles_admin');
                exit;
            }
        }
        $params=[
            'label'=>$label,
            'origine'=>$origine,
            'prix'=>$prix,
            'poids'=>$poids,
            'unites'=>$unites,
            'familles'=>$familles,
            'statut'=>$statut,
            'error'=>$error,
            'title'=>"Ajouter un article"
        ];
        $this->render($this->file, $this->page, $this->base, $params);
    }

    function editArticle(){
//        $role = getUserRole();
//
//        if($role != "admin") {
//            http_response_code(403);
//            echo("Désolé la page n'existe pas");
//            exit;
//        }
        $idArticle = $_GET['id'];
        $errors=[];

        $articleModel = new ArticleModel();
        $article = $articleModel ->getOneArticle($idArticle);
        $statutModel = new StatusModel();
        $statut = $statutModel->getAllstatusArticle();

        if(!$article){
            http_response_code(404);
            echo("Article introuvable");
            exit;
        }

        $familleModel = new FamilleModel();
        $familles = $familleModel ->getAllFamille();

        $uniteModel = new UniteModel();
        $unites = $uniteModel ->getAllUnite();

        $statutArticle = $article['statutArticle'];
        $label = $article['article'];
        $origine = $article['origine'];
        $prix = $article['prix'];
        $poids = $article['poids'];

        if(!empty($_POST)){
            $label = $_POST['label'];
            $origine = $_POST['origine'];
            $prix = $_POST['prix']*100;
            $poids = $_POST['poids'];
            $unite = $_POST['unite'];
            $famille = $_POST['famille'];
            $statutArticle = $_POST['statutArticle'];

            if(empty($errors)){
                $articleModel->editArticle($label,$poids,$unite,$prix,$origine,$famille,$statutArticle,$idArticle);
                header('location: articles_admin');
                exit;
            }
        }
        $params=[
            'article'=>$article,
            'label'=>$label,
            'origine'=>$origine,
            'prix'=>$prix,
            'poids'=>$poids,
            'statut'=>$statut,
            'unites'=>$unites,
            'familles'=>$familles,
            'statutArticle'=>$statutArticle,
            'title'=>"Modification d'un article"
        ];
        $this->render($this->file, $this->page, $this->base, $params);
    }

    function deleteArticle(){
        $role = getUserRole();
        if($role != "admin") {
            http_response_code(403);
            echo("Désolé la page n'existe pas");
            exit;
        }
        $idArticle = $_GET['id'];
        $articleModel = new ArticleModel();
        $articleModel->deleteArticle($idArticle);

        header('location: articles_admin');
        exit;
    }
}