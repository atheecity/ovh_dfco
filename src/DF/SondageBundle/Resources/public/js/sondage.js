function newReponse()
{
	$(document).ready(function() 
	{
		var $container = $('div#df_sondagebundle_question_reponses');
		 
		  var $lienAjout = $('<a href="#" id="ajout_reponse" class="btn">Ajouter une réponse</a>');
		  $container.append($lienAjout);
		  
		  $lienAjout.click(function(e) {
		    ajouterReponse($container);
		    e.preventDefault(); // évite qu'un # apparaisse dans l'URL
		    return false;
		  });
		 
		  var index = $container.find(':input').length;
		 
		  if (index == 0) {
		    ajouterReponse($container);
		  } else {
		    $container.children('div').each(function() {
		      ajouterLienSuppression($(this));
		    });
		  }
		 
		  function ajouterReponse($container) {
			  var $prototype = $($container.attr('data-prototype').replace(/__name__label__/g, 'Réponse n°' + (index+1))
		                                                        .replace(/__name__/g, index));
		 
			    ajouterLienSuppression($prototype);
			 
			    $container.append($prototype);
			 
			    index++;
		  }
		 
		  function ajouterLienSuppression($prototype) {
		    $lienSuppression = $('<a href="#" class="btn btn-danger">Supprimer</a>');
		 
		    $prototype.append($lienSuppression);
		 
		    // Ajout du listener sur le clic du lien
		    $lienSuppression.click(function(e) {
		      $prototype.remove();
		      e.preventDefault(); // évite qu'un # apparaisse dans l'URL
		      return false;
		    });
		  }
		});
}

function voteSubmit()
{
	$('form').submit(function() 
	{
		_this = $(this);
		$.ajax({
			dataType: "json", 
			url: _this.attr('action'),
			type: _this.attr('method'), 
			data: _this.serialize(),
			success: function(data){
				if (data.code == 100 && data.success == true) {
					
				}
				else {
					alert(data.erreur);
				}
			}
		});
		return false;
	});
}

$(voteSubmit);
$(newReponse);