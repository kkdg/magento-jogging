c = document.getElementsByClassName('required-option');
// a is an array from outside which contains values you want to inject
for(i=1; i<=a.length;i++) {
	    c[i].value = a[i-1];
}
