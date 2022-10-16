<?php
session_start();
$pdo = new PDO("mysql:host=database;dbname=data", "root", "password");
if (isset($_POST['valider'])){
    if(!empty($_POST['contenu'])){
//        faire en sorte que le name soit celui lors de la creation
        $name = htmlspecialchars($_SESSION['name']);
        $contenu= nl2br(htmlspecialchars($_POST['contenu']));

        $insererpost= $pdo->prepare('INSERT INTO post (name, contenu) VALUES(?, ?)');
        $insererpost->execute(array($name, $contenu));
    }else{
        echo "veuillez compléter tous les champs";
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="post.php">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>postrie instantané</title>
</head>
<body>
<form method="POST" action="">
    <textarea name="post"></textarea>
    <input type="submit" name="valider">
</form>
<section id="post">
<!--    c'est fais expres qu'il n'y a pas d'automatisation pour le reload de la page puisque c'est pas le but de l'exo-->
    <?php
    $pdo = new PDO("mysql:host=database;dbname=data", "root", "password");
    $recuppost= $pdo->query('SELECT * FROM post');
    while($post = $recuppost->fetch()){
        ?>
        <div class="post">
            <h4><?= $post['name']; ?></h4>
            <p><?= $post['post']; ?></p>
        </div>
        <?php
    }


    ?>
</section>




    <a href="deconnexion.php">
        <button>Se déconnecter</button>
    </a>
</body>
</html>