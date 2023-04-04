
<?php
// Connexion à la base de données
$host = "localhost";
$username = "Panneau";
$password = "1234";
$dbname = "e-panel";
$conn = mysqli_connect($host, $username, $password, $dbname);

// Vérifier si la connexion a réussi
if (!$conn) {
  die("La connexion a échoué : " . mysqli_connect_error());
}

// Vérifier si une action est spécifiée
if(isset($_POST['action'])){
  // Récupérer l'action
  $action = $_POST['action'];

  // Effectuer différentes actions en fonction de la valeur de $action
  switch($action){
    case 'executer':
      // Récupérer le numéro du bouton pressé
      $numero = $_POST['numero'];
      // Effectuer les actions spécifiques à ce bouton
      switch($numero){
        case '1':
            // ID à sélectionner
            $id = 1;

            // Requête SQL pour sélectionner les valeurs correspondant à l'ID
            $sql = "SELECT * FROM infopanneau WHERE id = $id";

            // Exécution de la requête
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
                    $arg = $valeur_1; // Définition de la variable
                    $command = 'cd C:\xampp\htdocs\E-Panel\php && start /B pano3-0.exe "'.$arg.'"';;
                    exec($command);
                }
                else {
                    echo "Aucun résultat trouvé pour cet ID";
                }
            }  

          break;
        case '2':
            // ID à sélectionner
            $id = 2;

            // Requête SQL pour sélectionner les valeurs correspondant à l'ID
            $sql = "SELECT * FROM infopanneau WHERE id = $id";

            // Exécution de la requête
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
                    $arg = $valeur_1; // Définition de la variable
                    $command = 'cd C:\xampp\htdocs\E-Panel\php && start /B pano3-0.exe "'.$arg.'"';;
                    exec($command);
                }
                else {
                    echo "Aucun résultat trouvé pour cet ID";
                }
            }  
          break;
        case '3':
            // ID à sélectionner
            $id = 3;

            // Requête SQL pour sélectionner les valeurs correspondant à l'ID
            $sql = "SELECT * FROM infopanneau WHERE id = $id";

            // Exécution de la requête
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
                    $arg = $valeur_1; // Définition de la variable
                    $command = 'cd C:\xampp\htdocs\E-Panel\php && start /B pano3-0.exe "'.$arg.'"';;
                    exec($command);
                }
                else {
                    echo "Aucun résultat trouvé pour cet ID";
                }
            }
          break;
        case '4':
            // ID à sélectionner
            $id = 4;

            // Requête SQL pour sélectionner les valeurs correspondant à l'ID
            $sql = "SELECT * FROM infopanneau WHERE id = $id";

            // Exécution de la requête
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
                    $arg = $valeur_1; // Définition de la variable
                    $command = 'cd C:\xampp\htdocs\E-Panel\php && start /B pano3-0.exe "'.$arg.'"';;
                    exec($command);
                }
                else {
                    echo "Aucun résultat trouvé pour cet ID";
                }
            }
          break;
        case '5':
            // ID à sélectionner
            $id = 5;

            // Requête SQL pour sélectionner les valeurs correspondant à l'ID
            $sql = "SELECT * FROM infopanneau WHERE id = $id";

            // Exécution de la requête
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
                    $arg = $valeur_1; // Définition de la variable
                    $command = 'cd C:\xampp\htdocs\E-Panel\php && start /B pano3-0.exe "'.$arg.'"';;
                    exec($command);
                }
                else {
                    echo "Aucun résultat trouvé pour cet ID";
                }
            }
          break;
        case '6':
            // ID à sélectionner
            $id = 6;

            // Requête SQL pour sélectionner les valeurs correspondant à l'ID
            $sql = "SELECT * FROM infopanneau WHERE id = $id";

            // Exécution de la requête
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
                    $arg = $valeur_1; // Définition de la variable
                    $command = 'cd C:\xampp\htdocs\E-Panel\php && start /B pano3-0.exe "'.$arg.'"';;
                    exec($command);
                }
                else {
                    echo "Aucun résultat trouvé pour cet ID";
                }
            }
          break;
        case '7':
            // ID à sélectionner
            $id = 7;

            // Requête SQL pour sélectionner les valeurs correspondant à l'ID
            $sql = "SELECT * FROM infopanneau WHERE id = $id";

            // Exécution de la requête
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
                    $arg = $valeur_1; // Définition de la variable
                    $command = 'cd C:\xampp\htdocs\E-Panel\php && start /B pano3-0.exe "'.$arg.'"';;
                    exec($command);
                }
                else {
                    echo "Aucun résultat trouvé pour cet ID";
                }
            }
          break;
        case '8':
            // ID à sélectionner
            $id = 8;

            // Requête SQL pour sélectionner les valeurs correspondant à l'ID
            $sql = "SELECT * FROM infopanneau WHERE id = $id";

            // Exécution de la requête
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
                    $arg = $valeur_1; // Définition de la variable
                    $command = 'cd C:\xampp\htdocs\E-Panel\php && start /B pano3-0.exe "'.$arg.'"';;
                    exec($command);
                }
                else {
                    echo "Aucun résultat trouvé pour cet ID";
                }
            }
          break;
        default:
        //Action par défaut si le numéro de bouton n'est pas reconnu
        break;
        }
    }
}


// Fermer la connexion à la base de données
mysqli_close($conn);
?>