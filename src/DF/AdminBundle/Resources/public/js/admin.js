function checkbox()
{
	$('.checker').click(function()
	{
		if ($(this).children('span').attr('class') == 'checked')
			$(this).children('span').removeAttr('class');
		else
			$(this).children('span').attr('class', 'checked');
	});
}

$(checkbox);