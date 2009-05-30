function __phoneBoxSetDefault(input, defaultAreaCode) {
  if (input.value == '' && defaultAreaCode != '') {
 	 input.value = '(' + defaultAreaCode + ') ';
 	 
 	 if (input.setSelectionRange) {
   		 input.focus();
         setTimeout(function() { input.setSelectionRange(input.value.length, input.value.length) }, 0);
	 }
 	 else if (input.createTextRange) {
 	   var range = input.createTextRange();
    	range.collapse(true);
    	range.moveEnd('character', input.value.length);
    	range.moveStart('character', input.value.length);
    	range.select();
  	 }
  }
}

function __phoneBoxCheckChanged(el, defaultAreaCode) {
	if (el.value == '(' + defaultAreaCode + ') ') {
		el.value = '';
	}
	var str = el.value.replace(/[\(\)\-\ ]/g,'');
	
	if (str.length == 7) {
 		str = "(" + defaultAreaCode + ") " + str.substr(0,3) + "-" +	str.substr(3,4);
 		el.value = str;			
	}
	else if (str.length > 7 && str.substr(7,1) == 'x') {
 		str = "(" + defaultAreaCode + ") " + str.substr(0,3) + "-" + str.substr(3,4) + " x" + str.substr (8);
		el.value =str;
	}
	else if (str.length == 10) {
 		str = "(" + str.substr(0,3) + ") " + str.substr(3,3) + "-" +	str.substr(6,4);
 		el.value = str;	
	}
	else if (str.length > 10 && str.substr(10,1) == 'x') {
 		str = "(" + str.substr(0,3) + ") " + str.substr(3,3) + "-" + str.substr(6,4) + " x" + str.substr (11);
		el.value = str;
	}
}
