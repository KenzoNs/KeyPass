<?php
include_once __DIR__."/../../include/connection.php";

/**
 * Modele header
 */
class ModeleHeader extends Connection {
    /**
     * Retourne l'utilisateur connecté
     */
    function getUtilisateurConnecte($nomUtilisateur) {
        if($nomUtilisateur != null) {
            $query = self::$bdd->prepare("SELECT * FROM utilisateur WHERE nom_utilisateur = :nom_utilisateur");
            if(!$query->execute(array("nom_utilisateur" => $nomUtilisateur))) {
                return null;
            }
            else {
                return $query->fetch(PDO::FETCH_ASSOC);
            }
        }
        else {
            return null;
        }
    }
}