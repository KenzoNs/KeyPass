<?php
include_once ("./resources/include/Connection.php");
include_once ("./resources/include/Security.php");

/**
 * Modele user
 */
class UserModel extends Connection {

    /**
     * Recupere le détail d'un user via son mail
     */
    function getByMail($email) {
        $query = self::$bdd->prepare("SELECT * FROM user WHERE email = :email");
        if(!$query->execute(array("email" => $email))) {
            return false;
        }
        else {
            return $query->fetch(PDO::FETCH_ASSOC);
        }
    }

    /**
     * Retourne vrai si l'email utilisateur existe
     */
    function isUserEmailExist($email) {
        $email = Security::encrypt($email);
        self::connection();
        $query = self::$bdd->prepare("SELECT * FROM utilisateur WHERE email = :email");
        $query->execute(array("email" => $email));
        self::disconnection();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Change le mot de passe d'un user
     */
    function changemotdepasse($nom_utilisateur, $mot_de_passe) {
        $hash = hash("sha256", $mot_de_passe);
        $query = self::$bdd->prepare("UPDATE user ".
            "SET mot_de_passe = :mot_de_passe ".
            "WHERE nom_utilisateur = :nom_utilisateur");
        if(!$query->execute(array("mot_de_passe" => $hash, "nom_utilisateur" => $nom_utilisateur))) {
            return $query->errorInfo()[2];
        }
        else {
            return true;
        }
    }

    /**
     * Login d'un user
     */
    function login($userId, $password) {
        $userId = Security::encrypt($userId);
        $password = Security::encrypt($password);
        self::connection();
        $query = self::$bdd->prepare("SELECT * FROM utilisateur WHERE identifiant_utilisateur = :userId AND mot_de_passe_utilisateur = :password");
        $query->execute(array("userId" => $userId, "password" => $password));
        self::disconnection();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * recherche d'un user
     */
    function search($content) {
        $content = Security::encrypt($content);
        self::connection();
        $query = self::$bdd->prepare("SELECT DISTINCT * FROM utilisateur WHERE nom_utilisateur LIKE :content OR prenom_utilisateur LIKE :content OR identifiant_utilisateur LIKE :content");
        $query->execute(array(":content" => $content . '%'));
        self::disconnection();
        return $query;
    }



    /**
     * Enregistrement d'un nouvel user
     */
    function insert($nom_utilisateur, $nom, $prenom, $sexe, $jour, $mois, $annee, $email, $mot_de_passe, $pays, $description) {
        $hash = hash("sha256", $mot_de_passe);
        $query = self::$bdd->prepare("INSERT INTO user (is_admin, nom_utilisateur, nom, prenom, sexe, date_de_naissance, email, mot_de_passe, pays, description)".
            "VALUES (0, :nom_utilisateur, :nom, :prenom, :sexe, :date_de_naissance, :email, :hash, :pays, :description)");
        if(!$query->execute(array("nom_utilisateur" => $nom_utilisateur, "nom" => $nom, "prenom" => $prenom,
            "sexe" => $sexe, "date_de_naissance" => $annee."-".$mois."-".$jour, "email" => $email, "hash" => $hash,
            "pays" => $pays, "description" => $description))) {
            return $query->errorInfo()[2];
        }
        else {
            return true;
        }
    }

    /**
     * Modification d'un user
     */
    function update($nom_utilisateur, $nom, $prenom, $sexe, $jour, $mois, $annee, $pays, $description, $photo_profil) {
        $query = self::$bdd->prepare("UPDATE user ".
            "SET nom = :nom, prenom = :prenom, sexe = :sexe, date_de_naissance = :date_de_naissance, pays = :pays, description = :description, photo_profil = :photo_profil ".
            "WHERE nom_utilisateur = :nom_utilisateur");
        if(!$query->execute(array("nom_utilisateur" => $nom_utilisateur, "nom" => $nom, "prenom" => $prenom,
            "sexe" => $sexe, "date_de_naissance" => $annee."-".$mois."-".$jour,
            "pays" => $pays, "description" => $description, "photo_profil" => $photo_profil))) {
            return $query->errorInfo()[2];
        }
        else {
            return true;
        }
    }
}
