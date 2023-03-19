<?php

class ArticleAdmin extends AbstractController
{
    function index(){

        $role = getUserRole();
        /*
         * Je vérifie que l'utilisateur a le role admin
         */
        if($role != "admin") {
            http_response_code(403);
            header("location:page_403");
            exit;
        }

        /*
         * Je récupères toutes les données liés à mes articles dans ma BDD
         */
        $articleModel = new ArticleModel();
        $articles = $articleModel ->getAllArticles();
        $statutModel = new StatusModel();
        $statut = $statutModel->getAllstatusArticle();
        $params=[];

        /*
         * L'utilisateur a coché la case pour voir les articles archivés
         */
        if (empty($_POST['archive']) ) {

            $articles = $this->filterArticles($articles);
        }

        /*
         * Gestion de la soumission de mon formulaire ( rechercher un article )
         */
        if(!empty($_POST['articleSearch'])){
            $articleSearch = $_POST['articleSearch'];
            $params['articleSearch']=$articleSearch;
            $_SESSION['articleSearch'] = searchArticle($articleSearch,$articles);

        }else{
            unset( $_SESSION['articleSearch']);
        }

        /*
         * Je stock mes données dans tableau params pour le renvoyer dans ma méthode render
         */
        $params['articles']=$articles;
        $params['statutArticle']=$statut;
        $params['title']="Admin - Liste des articles";

        ob_start();
        /*
        * J'utilise ma méthode render pour renvoyer mon template
        */
        $this->render($this->file, 'liste_articles_admin', '', $params);
        $params['view'] = ob_get_clean();

        if(!empty($_GET['ajax'])){
            echo json_encode(['view'=>$params['view']]);
            return ;
        }
        $this->render($this->file, $this->page, $this->base, $params);
    }

    function addArticle()
    {
        /*
         * Je vérifie le role de l'utilisateur
         */
        $role = getUserRole();
        if ($role != "admin") {
            http_response_code(403);
            header("location:page_403");
            exit;
        }
        $error=[];
        /*
         * J'initialise mes variables avec un string vide me permettant (en cas d'erreur)
         * de conserver ce que l'utilisateur aura noté dans le champ
         */
        $label = '';
        $origine = '';
        $prix = '';
        $poids = '';
        $image='';

        /*
         * J'instancie mes Modeles familles, unitées et status
         * Je stock dans plusieurs variables toutes les données de chaque modele
         */
        $familleModel = new FamilleModel();
        $familles = $familleModel->getAllFamille();
        $uniteModel = new UniteModel();
        $unites = $uniteModel->getAllUnite();
        $statutModel = new StatusModel();
        $statuts = $statutModel->getAllstatusArticle();



        if(!empty($_POST)){
            /*
             * Je récupère ensuite les données validées par l’utilisateur dans des variables avec
             * la méthode POST,et j'initialise les variables.
             */
            $label = strip_tags(htmlspecialchars(trim($_POST['label'])));
            $origine = strip_tags(htmlspecialchars(trim($_POST['origine'])));
            $prix =  strip_tags(htmlspecialchars(trim($_POST['prix'])));
            $poids =  strip_tags(htmlspecialchars(trim($_POST['poids'])));
            $famille = strip_tags(htmlspecialchars(trim($_POST['famille'])));
            $unite =  strip_tags(htmlspecialchars(trim($_POST['unite'])));
            $statut = strip_tags(htmlspecialchars(trim($_POST['statut'])));

            /*
             * Je vérifie si tous les champs ont bien été remplis sinon je renvoie un message d'erreur.
             */
            if(!$label){
                $error['label']='Veuillez remplir le champ article';
//                addFlashMessage('Veuillez remplir le champ article','error');
            }
            if(!$origine){
                $error['origine']='Veuillez remplir le champ origine';
//                addFlashMessage('Veuillez remplir le champ origine','error');
            }
            if(!$prix){
                $error['prix']='Veuillez remplir le champ prix';
//                addFlashMessage('Veuillez remplir le champ prix','error');
            }
            if(!$poids){
                $error['poids']='Veuillez remplir le champ poids';
//                addFlashMessage('Veuillez remplir le champ poids','error');
            }
            if($famille == 0){
                $error['famille']='Veuillez sélectionner une famille';
//                addFlashMessage('Veuillez sélectionner une famille','error');
            }
            elseif ($famille == 1){
                $image = 'fruit.png';
            }
            else{
                $image = 'legume.png';
            }
            if($unite == 0){
                $error['unite']='Veuillez sélectionner une unitée';
//                addFlashMessage('Veuillez sélectionner une unitée','error');
            }
            if($statut == 0){
                $error['statut']='Veuillez sélectionner une statut';
//                addFlashMessage('Veuillez sélectionner un statut','error');
            }

            /*
             * Upload d'image
             */
            if ($_FILES['image']['size']>0) {
                uploadImage($_FILES['image']);
                $image=$_FILES['image']['name'];
            }
            /*
             * Si mes vérifications sont validées en ne renvoyant aucun message d’erreur,
             * J'ajouter les données pour mon article dans ma BDD.
             */
//            if(canProceed()) {
            if(empty($error)) {
                $articleModel = new ArticleModel();
                $articleModel ->addArticle($label,$poids,$unite,($prix*100),$origine,$famille,$statut,$image);

                header('location: articles_admin');
                exit;
            }
    }

        /*
         * J'initialise un tableau $params afin de renvoyer toutes mes données sur mon template.
         * La méthode render permet de charger un template.
         */
        $params=[
            'label'=>$label,
            'origine'=>$origine,
            'prix'=>$prix,
            'poids'=>$poids,
            'unites'=>$unites,
            'familles'=>$familles,
            'statut'=>$statuts,
            'error'=>$error,
            'title'=>"Ajouter un article"
        ];
        $this->render($this->file, $this->page, $this->base, $params);
    }

    function editArticle(){
        $role = getUserRole();

        if($role != "admin") {
            http_response_code(403);
            header("location:page_403");
            exit;
        }
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
        $image = $article['image'];

        if(!empty($_POST)){
            $label = strip_tags(htmlspecialchars(trim($_POST['label'])));
            $origine =strip_tags(htmlspecialchars(trim($_POST['origine'])));
            $prix = strip_tags(htmlspecialchars(trim($_POST['prix']*100)));
            $poids = strip_tags(htmlspecialchars(trim($_POST['poids'])));
            $unite = strip_tags(htmlspecialchars(trim($_POST['unite'])));
            $famille = strip_tags(htmlspecialchars(trim($_POST['famille'])));
            $statutArticle = strip_tags(htmlspecialchars(trim($_POST['statutArticle'])));

            if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                uploadImage($_FILES['image']);
                $image=$_FILES['image']['name'];
            }

            if(empty($errors)){
                $articleModel->editArticle($label,$poids,$unite,$prix,$origine,$famille,$statutArticle,$image,$idArticle);
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
            'image'=>$image,
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
            header("location:page_403");
            exit;
        }
        $idArticle = $_GET['id'];
        $articleModel = new ArticleModel();
        $articleModel->archiveArticle(3,$idArticle);

        header('location: articles_admin');
        exit;
    }

    private function filterArticles(array $articles) :array
    {
        return array_filter($articles, function ($item) {
            return $item['id_statutArticle'] !== 3;
        });
    }
}