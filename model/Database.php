<?php

class Database {
    private static $bdd = NULL;
    /**
     * Réalise la connexion à la base de donnée
     * @return \PDO Une variable de connexion à la base de donnée
     */
    private static function connect(){ 
      $account = "root";
      //$password = "";
      $password = "";
        try{ 
            return new PDO('mysql:host=localhost;dbname=upsTransport', $account, $password);
        } catch (Exception $e){ 
            die('Erreur : ' . $e->getMessage()); 
        } 
    } 
    
    /**
     * Donne la connexion à la base de donnée, et la crée si elle n'existe pas.
     * @return \PDO Une variable de connexion à la base de donnée.
     */
    public static function getConnection(){
        if(Database::$bdd == NULL){
            Database::$bdd = Database::connect();
        }
        return Database::$bdd;
    }
    
    public static function getOneData($req){
        $bdd = Database::getConnection();
        $reponse = $bdd->query($req);
        $donnees = $reponse->fetch();
        $reponse->closeCursor();
        return $donnees;
    }
    
    public static function getAllData($req){
        $bdd = Database::getConnection();
        $reponse = $bdd->query($req);
        return $reponse;
    }
    
    
}

?>
