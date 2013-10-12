function modifTextarea()
{
	$('textarea#fos_comment_comment_body').attr('placeholder', 'Ajouter un commentaire...');
	$('textarea#fos_comment_comment_body').focus(function() {
		$(this).css('font-size', '14px');
		$(this).animate({
			height: '100px'
		});
	});
	$('textarea#fos_comment_comment_body').blur(function() {
		if($(this).val() == "") {
			$(this).css('font-size', '20px');
			$(this).animate({
				height: '25px'
			});
		}
	});
}

$(clickAffCommentaire);
$(sendComment);
$(reloadComment);