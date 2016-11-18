function phvalidate(input)
{
	 var phoneno = /^(?:\+?1[-. ]?)?(?:\(?([0-9]{3})\)?[-. ]?)?([0-9]{3})[-. ]?([0-9]{4})$/; 
	 //taking in possible values
	 if(input.value.match(phoneno)){
		 //if it runs
		 var input1=input.value.split(/[-. +()]?/);
		 //spliting it
		 var i;
		 if(input1.length>10)
			i=1;
		else
			i=0;
		 input='';
		 for(i;i<input1.length;i++)
		 {
			input+=input1[i];
		 }
		//adding the numbers from the split
		 var number=document.getElementById('searchbar');
		 number.value=input;
		 if(input==8503782739)
		 {
			 console.log("I am trying to redirext");
			 window.location="http://www.floridastatecrew.com/";
			 return false;
		 }
		 //changing value in html file
		// console.log(input);
		// console.log(number.value);
		 return true;
	 }//end of parse int
	 else if(input.value=="1-800-HOTLINEBLING")
	 {
		 window.location="https://www.youtube.com/watch?v=uxpDa-c-4Mc"
		 return false;
	 }
	 else{
			var str='not a valid number';
			var div=document.getElementById('textToAppend');
			div.innerHTML=str;
			return false;
	 }
}