<?php
// Connexion à la base de données
$host = "localhost";
$username = "Panneau";
$password = "1234";
$dbname = "e-panel";
$conn = mysqli_connect($host, $username, $password, $dbname);

// Vérification de la connexion
if (!$conn) {
  die("La connexion a échoué : " . mysqli_connect_error());
}

// Vérifier si action 
if(isset($_POST['action'])){
  // Récup l'action
  $action = $_POST['action'];

  // Effectuer actions en fonction de la valeur 
  switch($action){
    case 'executer':
      // Récupérer le numéro du bouton pressé
      $numero = $_POST['numero'];
      // Effectuer les actions spécifiques à ce bouton
      switch($numero){
        case '1':
            // ID à sélectionner
            $id = 1;

            // Commande SQL pour sélectionner les valeurs correspondant à l'ID
            $sql = "SELECT * FROM infopanneau WHERE id = $id";

            // Exécution de la commande
            $result = mysqli_query($conn, $sql);

            // Vérification des résultats
            if (mysqli_num_rows($result) > 0) {
                // Parcourir les résultats et afficher les valeurs
                while($row = mysqli_fetch_assoc($result)) {
                    $valeur_1 = $row["Message"];
                    // etc...
                }
                // Exécuter la commande shell/cmd avec les valeurs récupérées
                if (isset($_POST['action']) && $_POST['action'] == 'executer') {
                    $arg = $valeur_1 ; // Récupération de la valeur
                    echo ''.$arg.''; // Transfert de la valeur à JavaScript
                    $command = 'cd C:\xampp\htdocs\E-Panel\php && start /B pano3-0.exe "'.$arg.' ->"'; //Commande d'execution 
                    exec($command);
                    // Afficher la valeur de $arg dans la balise HTML avec l'ID MessageActuel
                    
                }
                else {
                    echo "Aucun résultat...";
                }
            }
            else {
                echo "Aucun résultat...";
            }
          break;
          case '2':
            // ID à sélectionner
            $id = 2;

            // Commande SQL pour sélectionner les valeurs correspondant à l'ID
            $sql = "SELECT * FROM infopanneau WHERE id = $id";

            // Exécution de la commande
            $result = mysqli_query($conn, $sql);

            // Vérification des résultats
            if (mysqli_num_rows($result) > 0) {
                // Parcourir les résultats et afficher les valeurs
                while($row = mysqli_fetch_assoc($result)) {
                    $valeur_1 = $row["Message"];
        
                    // etc...
                }
                // Exécution la commande shell/cmd avec les valeurs récupérées
                if (isset($_POST['action']) && $_POST['action'] == 'executer') {
                    $arg = $valeur_1; // Récupération de la valeur
                    echo ''.$arg.''; // Transfert de la valeur à JavaScript
                    $command = 'cd C:\xampp\htdocs\E-Panel\php && start /B pano3-0.exe "'.$arg.' ->"'; //Commande d'execution 
                    exec($command);
                    // Afficher la valeur de $arg dans la balise HTML avec l'ID MessageActuel
                    
                }
                else {
                    echo "Aucun résultat...";
                }
            }
            else {
                echo "Aucun résultat...";
            }
            break;
        case '3':
            // ID à sélectionner
            $id = 3;

            // Commande SQL pour sélectionner les valeurs correspondant à l'ID
            $sql = "SELECT * FROM infopanneau WHERE id = $id";

            // Exécution de la Commande
            $result = mysqli_query($conn, $sql);

            // Vérification des résultats
            if (mysqli_num_rows($result) > 0) {
                // Parcourir les résultats et afficher les valeurs
                while($row = mysqli_fetch_assoc($result)) {
                    $valeur_1 = $row["Message"];
        
                    // etc...
                }
                // Exécuter la commande shell ou cmd avec les valeurs récupérées
                if (isset($_POST['action']) && $_POST['action'] == 'executer') {
                    $arg = $valeur_1; // Récupération de la valeur
                    echo ''.$arg.''; // Transfert de la valeur à JavaScript
                    $command = 'cd C:\xampp\htdocs\E-Panel\php && start /B pano3-0.exe "'.$arg.' ->"'; //Commande d'execution
                    exec($command);
                    // Afficher la valeur de $arg dans la balise HTML avec l'ID MessageActuel
                    
                }
                else {
                    echo "Aucun résultat...";
                }
            }
            else {
                echo "Aucun résultat...";
            }
          break;
          case '4':
            // ID à sélectionner
            $id = 4;

            // commande SQL pour sélectionner les valeurs correspondant à l'ID
            $sql = "SELECT * FROM infopanneau WHERE id = $id";

            // Exécution de la commande
            $result = mysqli_query($conn, $sql);

            // Vérification des résultats
            if (mysqli_num_rows($result) > 0) {
                // Parcourir les résultats et afficher les valeurs
                while($row = mysqli_fetch_assoc($result)) {
                    $valeur_1 = $row["Message"];
        
                    // etc...
                }
                // Exécuter la commande shell ou cmd avec les valeurs récupérées
                if (isset($_POST['action']) && $_POST['action'] == 'executer') {
                    $arg = $valeur_1; // Récupération de la valeur
                    echo ''.$arg.''; // Transfert de la valeur à JavaScript
                    $command = 'cd C:\xampp\htdocs\E-Panel\php && start /B pano3-0.exe "'.$arg.' ->"'; //Commande d'execution
                    exec($command);
                    // Afficher la valeur de $arg dans la balise HTML avec l'ID MessageActuel
                    
                }
                else {
                    echo "Aucun résultat...";
                }
            }
            else {
                echo "Aucun résultat...";
            }
          break;
          case '5':
            // ID à sélectionner
            $id = 5;

            // commande SQL pour sélectionner les valeurs correspondant à l'ID
            $sql = "SELECT * FROM infopanneau WHERE id = $id";

            // Exécution de la commande
            $result = mysqli_query($conn, $sql);

            // Vérification des résultats
            if (mysqli_num_rows($result) > 0) {
                // Parcourir les résultats et afficher les valeurs
                while($row = mysqli_fetch_assoc($result)) {
                    $valeur_1 = $row["Message"];
        
                    // etc...
                }
                // Exécuter la commande shell ou cmd avec les valeurs récupérées
                if (isset($_POST['action']) && $_POST['action'] == 'executer') {
                    $arg = $valeur_1; // Récupération de la valeur
                    echo ''.$arg.''; // Transfert de la valeur à JavaScript
                    $command = 'cd C:\xampp\htdocs\E-Panel\php && start /B pano3-0.exe "'.$arg.' ->"';  //Commande d'execution
                    exec($command);
                    // Afficher la valeur de $arg dans la balise HTML avec l'ID MessageActuel
                    
                }
                else {
                    echo "Aucun résultat...";
                }
            }
            else {
                echo "Aucun résultat...";
            }
          break;
          case '6':
            // ID à sélectionner
            $id = 6;

            // commande SQL pour sélectionner les valeurs correspondant à l'ID
            $sql = "SELECT * FROM infopanneau WHERE id = $id";

            // Exécution de la commande
            $result = mysqli_query($conn, $sql);

            // Vérification des résultats
            if (mysqli_num_rows($result) > 0) {
                // Parcourir les résultats et afficher les valeurs
                while($row = mysqli_fetch_assoc($result)) {
                    $valeur_1 = $row["Message"];
        
                    // etc...
                }
                // Exécuter la commande shell ou cmd avec les valeurs récupérées
                if (isset($_POST['action']) && $_POST['action'] == 'executer') {
                    $arg = $valeur_1; // Récupération de la valeur
                    echo ''.$arg.''; // Transfert de la valeur à JavaScript
                    $command = 'cd C:\xampp\htdocs\E-Panel\php && start /B pano3-0.exe "'.$arg.' ->"'; //Commande d'execution
                    exec($command);
                    // Afficher la valeur de $arg dans la balise HTML avec l'ID MessageActuel
                    
                }
                else {
                    echo "Aucun résultat...";
                }
            }
            else {
                echo "Aucun résultat...";
            }
          break;
          case '7':
            // ID à sélectionner
            $id = 7;

            // commande SQL pour sélectionner les valeurs correspondant à l'ID
            $sql = "SELECT * FROM infopanneau WHERE id = $id";

            // Exécution de la commande
            $result = mysqli_query($conn, $sql);

            // Vérification des résultats
            if (mysqli_num_rows($result) > 0) {
                // Parcourir les résultats et afficher les valeurs
                while($row = mysqli_fetch_assoc($result)) {
                    $valeur_1 = $row["Message"];
        
                    // etc...
                }
                // Exécuter la commande shell ou cmd avec les valeurs récupérées
                if (isset($_POST['action']) && $_POST['action'] == 'executer') {
                    $arg = $valeur_1; // Récupération de la valeur
                    echo ''.$arg.''; // Transfert de la valeur à JavaScript
                    $command = 'cd C:\xampp\htdocs\E-Panel\php && start /B pano3-0.exe "'.$arg.' ->"'; //Commande d'execution
                    exec($command);
                    // Afficher la valeur de $arg dans la balise HTML avec l'ID MessageActuel
                    
                }
                else {
                    echo "Aucun résultat...";
                }
            }
            else {
                echo "Aucun résultat...";
            }
          break;
          case '8':
            // ID à sélectionner
            $id = 8;

            // commande SQL pour sélectionner les valeurs correspondant à l'ID
            $sql = "SELECT * FROM infopanneau WHERE id = $id";

            // Exécution de la commande
            $result = mysqli_query($conn, $sql);

            // Vérification des résultats
            if (mysqli_num_rows($result) > 0) {
                // Parcourir les résultats et afficher les valeurs
                while($row = mysqli_fetch_assoc($result)) {
                    $valeur_1 = $row["Message"];
        
                    // etc...
                }
                // Exécuter la commande shell ou cmd avec les valeurs récupérées
                if (isset($_POST['action']) && $_POST['action'] == 'executer') {
                    $arg = $valeur_1; // Récupération de la valeur
                    echo ''.$arg.''; // Transfert de la valeur à JavaScript
                    $command = 'cd C:\xampp\htdocs\E-Panel\php && start /B pano3-0.exe "'.$arg.' ->"'; //Commande d'execution
                    exec($command);
                    // Afficher la valeur de $arg dans la balise HTML avec l'ID MessageActuel
                    
                }
                else {
                    echo "Aucun résultat...";
                }
            }
            else {
                echo "Aucun résultat...";
            }
          break;
        default:
            break;
      }
      break;
    }
  }
?>
