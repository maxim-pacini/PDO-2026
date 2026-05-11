<?php
// Ce fichier contiendre les fonctions
// pour gérer la table livre (future class en OO)

// fonction d'insertion
function insertLivre(PDO $connect, array $datas) :bool
{
    // $_POST['email'],$_POST['title'],$_POST['text']
    // traitement des variables $_POST en variables locales
    $email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
    // return false si incorrect sinon le mail en string si correct
    $title = htmlspecialchars(trim(strip_tags($_POST['title'])));
    $text = htmlspecialchars(trim(strip_tags($_POST['text'])));


    if($email === false || empty($title) || empty($text)){
        return false;
    }
    
    // on va préparer notre requete avec des marqueurs nommés (:nom)
    $sql = "INSERT INTO `livre`(`email`,`title`,`text`) VALUE (:mail,:titre,:dutexte);";
    // attente des valeurs de marqueurs
    $prepare = $connect->prepare($sql);
    // on va utiliser le binValue() par défaut
    $prepare->bindValue(":mail",$email);
    $prepare->bindValue(":dutexte",$text);
    $prepare->bindValue(":titre",$title);
    // on va executer la requete
    $prepare->execute();
    return $prepare->rowCount()===1 ? true : false;

    
    
}
function readLivres(){
    return "Nos Livres";
}