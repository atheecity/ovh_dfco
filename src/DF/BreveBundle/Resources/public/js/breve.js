function updatePublish()
{
	$('.isPublish').click(function()
	{
		var id_breve = $(this).children().children('input').attr('id');
		
		if ($(this).children('span').attr('class') == 'checked')
			var isPublish = 1;
		else
			var isPublish = 0;
			
		var url = Routing.generate('DFBreveBundle_updatePublish', {id_breve : id_breve, isPublish : isPublish });
		res = $.ajax({
			url: url,
			success: function(){
				if(res.responseText == 'false')
					alert('Erreur');
			}
		});
	});
}

function updatePublishSlide()
{
	$('.isPublishSlide').click(function()
	{
		var id_breve = $(this).children().children('input').attr('id');
		
		if ($(this).children('span').attr('class') == 'checked')
			var isPublish = 1;
		else
			var isPublish = 0;
			
		var url = Routing.generate('DFBreveBundle_updatePublishSlide', {breve_id : id_breve, isPublish : isPublish });
		res = $.ajax({
			url: url,
			success: function(){
				if(res.responseText == 'false')
					alert('Erreur');
			}
		});
	});
}

$(updatePublishSlide);
$(updatePublish);