$('input#name-submit').on('click', function()
{
	var name = $('input#name').val();
	if($.trim(name) != '')
	{
		$.post('/Controllers/getMonth.php', {name: name}, function(data){
			alert(data);
		})
	}
}