<?php

require_once 'config.php';

abstract class Database
{
   protected static function connect () {

      $dsn = DB_TYPE .':host='. DB_HOST .';dbname='. DB_NAME .';charset='. DB_CHARSET;      
      $options = [
         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
         PDO::ATTR_EMULATE_PREPARES => false
      ];

      try {

         $pdo = new PDO ( $dsn, DB_USER, DB_PASS, $options );
         return $pdo;

      } catch ( PDOException $e ) { echo $e->getMessage(); }

   }

   protected static function query ( $query, $params = array() ) {

      try {

         $stmt = self::connect()->prepare($query);
         $stmt->execute($params);
         return $stmt;

      } catch ( PDOException $e ) { echo $e->getMessage(); }
   }
}