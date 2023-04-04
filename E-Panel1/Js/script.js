// Attendre que la page soit prête pour exécuter le code
$(document).ready(function() {

  // Lorsque le formulaire avec l'id 'formMessage' est soumis
  $('#formMessage').submit(function(event) {

    // Empêcher le comportement par défaut du formulaire
    event.preventDefault();

    // Récupérer la valeur de l'élément avec l'id 'nouveauMessage'
    var nouveauMessage = $('#nouveauMessage').val();

    // Envoyer une requête AJAX au fichier 'changerMessage.php' en utilisant la méthode POST
    // et envoyer les données 'nouveauMessage' et 'action'
    $.ajax({
      type: 'POST',
      url: 'php/changerMessage.php',
      data: {nouveauMessage: nouveauMessage, action: 'executer'},

      // Si la requête est réussie, exécuter cette fonction
      success: function(response) {

        // Afficher la réponse dans la console du navigateur
        console.log(response);

        // Mettre la valeur de l'élément 'nouveauMessage' dans l'élément avec l'id 'MessageActuel'
        $('#MessageActuel').text(nouveauMessage);
      },

      // Si la requête échoue, exécuter cette fonction
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
      }
    });
  });
});
