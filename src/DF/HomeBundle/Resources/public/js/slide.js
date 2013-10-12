function autoChangFrag()
{
	$('#slide').ready(function() {
		setInterval(function() {
			var idFrag = $('.select').attr('id');
			$('.ui-tabs-panel').attr('class', 'ui-tabs-panel ui-tabs-hide');
			var id = parseInt(idFrag[4]) + 1;
			if (id > 4) 
				id = 1;
			$('#frag'+id).removeAttr('class', 'ui-tabs-hide');
			$('#frag'+id).attr('class', 'ui-tabs-panel select');
		}, 5000);
	});
}