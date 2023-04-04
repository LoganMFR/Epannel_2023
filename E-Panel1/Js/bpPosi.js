// Attendre que la page soit prête pour exécuter le code
$(document).ready(function() {

    // 'bpPosi' est cliqué
    $('.bpPosi').click(function(event) {
  
      // Empêcher le comportement par défaut du lien
      event.preventDefault();
  
      // Récup la valeur de l'attribut 'value' de l'élément cliqué
      var btnValue = $(this).val();
  
      // Envoyer une requête AJAX au fichier 'boutonPHP.php' en utilisant la méthode POST
      // et envoyer les données 'numero' et 'action'
      $.ajax({
        type: 'POST',
        url: 'php/boutonPHP.php',
        data: {numero: btnValue, action: 'executer'},
  
        // Si la requête est réussie, exécuter cette fonction
        success: function(response) {
  
          // Afficher la réponse dans la console du navigateur
          console.log(response);
  
          // Mettre la réponse dans l'élément avec l'id 'MessageActuel'
          $('#MessageActuel').text(response);
        },
  
        // Si la requête échoue, exécuter cette fonction
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
      });
    });
  });