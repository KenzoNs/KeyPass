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
    function isUserMatExist($mat) {
        self::connection();
        $query = self::$bdd->prepare("SELECT matricule_utilisateur FROM utilisateur WHERE matricule_utilisateur = :mat");
        $query->execute(array("mat" => $mat));
        self::disconnection();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Login d'un user
     */
    function login($userMat, $password) {
        $userMat = Security::encrypt($userMat);
        $password = Security::encrypt($password);
        self::connection();
        $query = self::$bdd->prepare("SELECT * FROM utilisateur WHERE matricule_utilisateur = :userMat AND mot_de_passe_utilisateur = :password");
        $query->execute(array("userMat" => $userMat, "password" => $password));
        self::disconnection();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * recherche d'un user
     */
    function search($content) {
        $content = Security::encrypt($content);
        self::connection();
        $query = self::$bdd->prepare("SELECT DISTINCT * FROM utilisateur WHERE nom_utilisateur LIKE lower(:content) OR prenom_utilisateur LIKE lower(:content) OR identifiant_utilisateur LIKE lower(:content) OR grade_utilisateur LIKE lower(:content) OR fonction_utilisateur LIKE lower(:content) OR email_utilisateur LIKE lower(:content) OR bip_utilisateur LIKE lower(:content) OR telephone_utilisateur LIKE lower(:content) OR nom_groupe_utilisateur LIKE lower(:content)");
        $query->execute(array(":content" => $content . '%'));
        self::disconnection();
        return $query;
    }

    /**
     * Enregistrement d'un nouvel user
     */
    function insert($cuser_infos) {
        self::connection();
        $query = self::$bdd->prepare("INSERT INTO utilisateur (matricule_utilisateur, identifiant_utilisateur, nom_groupe_utilisateur, nom_utilisateur, prenom_utilisateur, grade_utilisateur, fonction_utilisateur, mot_de_passe_utilisateur, privilege_utilisateur, email_utilisateur, bip_utilisateur, telephone_utilisateur)".
            "VALUES (:matricule, :identifiant, :group, :fname, :name, :rank, :function, :password, :power, :mail, :bip, :phone)");
        if(!$query->execute(array("matricule" => $cuser_infos['mat'], "identifiant" => $cuser_infos['identifiant'], "fname" => $cuser_infos['fname'], "name" => $cuser_infos['name'],
            "rank" => $cuser_infos['rank'], "function" => $cuser_infos['function'], "group" => $cuser_infos['group'], "power" => $cuser_infos['rules'],
            "password" => $cuser_infos['pass'], "mail" => $cuser_infos['mail'], "phone" => $cuser_infos['phone'], "bip" => $cuser_infos['bip']))) {
            self::disconnection();
            return $query->errorInfo()[2];
        }
        else {
            self::disconnection();
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
