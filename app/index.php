<?php
session_start();
$pdo = new PDO("mysql:host=database;dbname=data", "root", "password");
//    inscription utilisateur
if(isset($_POST['inscription'])){
    if(!empty($_POST['name']) AND !empty($_POST['password'])){
        $name = htmlspecialchars($_POST['name']);
        $password = md5($_POST['password']);
//        inserer l'utilisateur dans la base de donner
        $insertUser = $pdo->prepare('INSERT INTO utilisateur(name, password)VALUES(?,?)');
        $insertUser->execute(array($name,$password));

///       prendre les informations de l'utilisateur dans la BD
        $recupUser= $pdo->prepare('SELECT * FROM utilisateur WHERE name = ? AND password =?');
        $recupUser->execute(array($name, $password));

//        crée une session pour chaque utilisateur connecter en récupérant les informations name, password et en passant recuperer l'id avec la commande $recupUser
//        rowcount va compter le nombre de donner trouver pour chercher l'utilisateur et declarer les sessions
        if ($recupUser->rowCount() > 0){
            $_SESSION['name'] = $name;
            $_SESSION['password'] = $password;
            $_SESSION['id'] = $recupUser->fetch()['id'];
//            ce fetch permet de juste recuperer l'id

        }
    }else{
        echo "veuillez completer tous les champs";
    }


}

if(isset($_POST['connexion'])){
    if(!empty($_POST['name']) AND !empty($_POST['password'])){
        $name = htmlspecialchars($_POST['name']);
        $password = md5($_POST['password']);
//        recuperer les utilisateur dans la base de donne
        $recupUser = $pdo->prepare('SELECT * FROM utilisateur WHERE name = ? AND password = ?');
//        recuperer lutilisateur qui correspond au name et mot de passe utiliser pour la connexion
        $recupUser->execute(array($name, $password));

        if($recupUser->rowCount() > 0){
            $_SESSION['name'] = $name;
            $_SESSION['password'] = $password;
            $_SESSION['id'] = $recupUser->fetch()['id'];
            header('Location: post.php');
        } else{
            echo "votre mot de passe ou name est inconnu";
        }
    }else{
        echo "veuillez completer tous les champs";
    }
}
?>



<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/style.css">
    <title>Document</title>
</head>
<body>
<h1>inscription</h1>
<form method="POST" action="">
    <input type="text" name="name" placeholder="name" autocomplete="off">
    <input type="password" name="password" placeholder="password" autocomplete="off">
    <input type="submit" name="inscription" value="inscription">
</form>

<h1>connexion</h1>
<form method="POST" action="">
    <input type="text" name="name" placeholder="name" autocomplete="off">
    <input type="password" name="password" placeholder="password" autocomplete="off">
    <input type="submit" name="connexion" value="connexion">

</form>
</body>
<body>
</html>

