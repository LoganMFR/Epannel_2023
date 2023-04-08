<?php
// Vérifie si le formulaire a été soumis avec une action "executer" en utilisant la méthode POST
if (isset($_POST['action']) && $_POST['action'] == 'executer') {

  // Récupère le texte de la zone de texte
  $texte = $_POST['nouveauMessage'];

  // Échappe les caractères spéciaux pour l'utiliser dans la commande
  $arg = escapeshellarg($texte);

  // Définit la commande à exécuter pour lancer l'application avec l'argument correspondant 
  $command = 'cd C:\xampp\htdocs\E-Panel\php && start /B pano3-0.exe ' . $arg;
  exec($command);
}
// Arrête l'exécution du script PHP
exit;
?>
