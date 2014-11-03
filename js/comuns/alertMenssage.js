	function alertMenssage ($str_title, $str_menssagem)
	{
		$('#menssagem').dialog('destroy');
		$(function()
		{
			// Dialog			
			$('#menssagem').dialog({
				autoOpen: true,
				bgiframe: true,
				modal: true,
				resizable: false,
				title: $str_title, 
				width: 450,
				buttons: {
					"Ok": function() { 
						$(this).dialog("close");
					}
				}
			});
			
		});

		$("#menssagem").html($str_menssagem);
	}
