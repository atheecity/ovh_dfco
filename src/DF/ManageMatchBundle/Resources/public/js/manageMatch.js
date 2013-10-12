function newFeuilleMatch() 
{
	$('.newFeuilleMatch input').click(function() {
		var form_data = $(this).data();
		var _this = $(this);
		
		var url = form_data.url;
		
		$.ajax({
			dataType: "json",
			url: url,
			success: function(data){
				if(data.code == 100 && data.success == true) {
					var url_feuille = Routing.generate('DFManageMatchBundle_displayFeuilleMatch', { feuille_id : data.feuille_id });
					$(_this).parent().append('<a href="'+url_feuille+'">Voir</a>');
					$(_this).remove();
					
				}
			}
		});
	});
}

$(newFeuilleMatch);