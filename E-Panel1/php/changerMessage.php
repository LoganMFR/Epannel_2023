<?php
if (isset($_POST['action']) && $_POST['action'] == 'executer') {
  $texte = $_POST['nouveauMessage']; // Récupère le texte de la zone de texte
  $arg = escapeshellarg($texte); // Échappe les caractères spéciaux pour l'utiliser dans la commande
  $command = 'cd C:\xampp\htdocs\E-Panel\php && start /B pano3-0.exe ' . $arg;
  exec($command);
}
exit;
?>
