function formvalidate()
{
	if($('#formtext').val()=="")
	{
		console.log($('#formtext').val());
		var str='not a valid comment text area empty';
		var div=document.getElementById('textToAppend1');
		div.innerHTML=str;
		return false;
	}
	else
		console.log($('#formtext').val());
		return true;
}