<?php
include_once ("./resources/include/Connection.php");

/**
 * Modele utilisateur
 */
class ModeleUtilisateur extends Connection {

    function getById($nom_utilisateur) {
        $query = self::$bdd->prepare("SELECT * FROM utilisateur WHERE nom_utilisateur = :nom_utilisateur");
        if(!$query->execute(array("nom_utilisateur" => $nom_utilisateur))) {
            return false;
        }
        else {
            return $query->fetch(PDO::FETCH_ASSOC);
        }
    }

    /**
     * Recupere le détail d'un utilisateur via son mail
     */
    function getByMail($email) {
        $query = self::$bdd->prepare("SELECT * FROM utilisateur WHERE email = :email");
        if(!$query->execute(array("email" => $email))) {
            return false;
        }
        else {
            return $query->fetch(PDO::FETCH_ASSOC);
        }
    }

    /**
     * Change le mot de passe d'un utilisateur
     */
    function changemotdepasse($nom_utilisateur, $mot_de_passe) {
        $hash = hash("sha256", $mot_de_passe);
        $query = self::$bdd->prepare("UPDATE utilisateur ".
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
     * Login d'un utilisateur
     */
    function login($id_utilisateur, $mot_de_passe) {
        self::connection();
        $query = self::$bdd->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = :id_utilisateur AND mot_de_passe = :mot_de_passe");
        $query->execute(array("id_utilisateur" => $id_utilisateur, "mot_de_passe" => $mot_de_passe));
        self::deconnection();
        if(!$query) {
            return false;
        }
        else {
            return $query->fetch(PDO::FETCH_ASSOC);
        }
    }

    /**
     * Enregistrement d'un nouvel utilisateur
     */
    function insert($nom_utilisateur, $nom, $prenom, $sexe, $jour, $mois, $annee, $email, $mot_de_passe, $pays, $description) {
        $hash = hash("sha256", $mot_de_passe);
        $query = self::$bdd->prepare("INSERT INTO utilisateur (is_admin, nom_utilisateur, nom, prenom, sexe, date_de_naissance, email, mot_de_passe, pays, description)".
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
     * Modification d'un utilisateur
     */
    function update($nom_utilisateur, $nom, $prenom, $sexe, $jour, $mois, $annee, $pays, $description, $photo_profil) {
        $query = self::$bdd->prepare("UPDATE utilisateur ".
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

    /**
     * Mes videos
     */
    function videosDe($nom_utilisateur) {
        $query = self::$bdd->prepare("SELECT video.id_video, video.date_publication, video.titre, video.description, video.nombre_likes,".
            " video.vignette_video, categorie_speedrun.nom_categorie, jeu.nom ".
            "FROM video INNER JOIN categorie_speedrun ON video.id_categorie_speedrun = categorie_speedrun.id_categorie ".
            "INNER JOIN jeu ON video.id_jeu = jeu.id_jeu ".
            "WHERE video.nom_utilisateur = :nom_utilisateur ".
            "ORDER BY video.date_publication DESC");
        if(!$query->execute(array("nom_utilisateur" => $nom_utilisateur))) {
            return false;
        }
        else {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    /**
     * Liste des catégories
     */
    function listeCategories() {
        $query = self::$bdd->query("SELECT * FROM categorie_speedrun");
        if(!$query) {
            return null;
        }
        else {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    /**
     * Liste des jeux
     */
    function listeJeux() {
        $query = self::$bdd->query("SELECT * FROM jeu ORDER BY nom ASC");
        if(!$query) {
            return null;
        }
        else {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    /**
     * Ajouter une vidéo
     */
    function addvideo($nom_utilisateur, $titre, $id_categorie_speedrun, $id_jeu,
                      $heure, $minute, $seconde, $description, $vignette_video, $fichier_video) {
        $query = self::$bdd->prepare("INSERT INTO video (nom_utilisateur, titre, id_categorie_speedrun, id_jeu, date_publication, temps_run, ".
            "description, vignette_video, fichier_video)".
            "VALUES (:nom_utilisateur, :titre, :id_categorie_speedrun, :id_jeu, NOW(), :temps_run, ".
            ":description, :vignette_video, :fichier_video)");
        if(!$query->execute(array("nom_utilisateur" => $nom_utilisateur, "titre" => $titre, "id_categorie_speedrun" => intval($id_categorie_speedrun),
            "id_jeu" => intval($id_jeu), "temps_run" => $heure.":".$minute.":".$seconde, "description" => $description,
            "vignette_video" => $vignette_video, "fichier_video" => $fichier_video))) {
            return $query->errorInfo()[2];
        }
        else {
            return true;
        }
    }

    /**
     * Liste les abonnés
     */
    function listeAbonnes($nom_utilisateur) {
        $query = self::$bdd->prepare("SELECT utilisateur.nom_utilisateur, utilisateur.nom, utilisateur.prenom, ".
            "utilisateur.email ".
            "FROM abonnement INNER JOIN utilisateur ON abonnement.nom_utilisateur_abonne = utilisateur.nom_utilisateur ".
            "WHERE abonnement.nom_utilisateur_speedrunner = :nom_utilisateur AND utilisateur.email IS NOT NULL");
        if(!$query->execute(array("nom_utilisateur" => $nom_utilisateur))) {
            return false;
        }
        else {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}
