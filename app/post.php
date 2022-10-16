<?php
session_start();
$pdo = new PDO("mysql:host=database;dbname=data", "root", "password");
if (isset($_POST['send'])){
    if(!empty($_POST['post'])){

        $name_user = htmlspecialchars($_POST['name_user']);
        $content= nl2br(htmlspecialchars($_POST['post']));

        $insert_post= $pdo->prepare('INSERT INTO post (name_user, contenu) VALUES(?, ?)');
        $insert_post->execute(array($name_user, $content));
    }else{
        echo "Veuillez compléter tous les champs";
    }
}

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>postrie instantané</title>
</head>
<body>
<form method="POST">
    <input type="text" name='name_user'>
    <br><br>
    <textarea name="post"></textarea>
    <input type="submit" name="send">
</form>

<?php
$pdo = new PDO("mysql:host=database;dbname=data", "root", "password");
$recover_post= $pdo->query('SELECT * FROM post');
while($post = $recover_post->fetch()){
    ?>
    <div class="post">
        <h4><?= $post['name_user']; ?> </h4>
        <p><?= $post['contenu']; ?></p>
    </div>
    <?php
}
?>

<a href="deconnexion.php">
    <button>Se déconnecter</button>
</a>

</body>
</html>