	function realizaSubmit(str_url,str_target)
	{
		d = document.frm;
			
		if(str_url != "")
		{
			d.action = str_url;
		}
		else
		{
			d.action = "";
		}
		
		if(str_target != "")
		{
			d.target = str_target;
		}
		else
		{
			d.target = "";
		}
		d.submit();
	}