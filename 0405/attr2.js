a = document.getElementsByClassName('required-option');
b = [];
for(i=1;i<a.length;i++) {
	     b[i] = a[i].value;
} // change objects into arrays



data = b;

data.forEach(function(infoArray, index){

	   dataString = infoArray + ",";
	      csv += dataString;

}); 

////////////////////////////////////////// 

b = document.getElementById('add_new_option_button'); 
for ( i = 0; i < 100; i++ ) {
	b.click();
} // button clicks


