
function loadInto(url, id, loading, error) {
	var ajax;
	var el = document.getElementById(id);
	el.innerHTML = loading;

	if (typeof XMLHttpRequest !== 'undefined')
		ajax = new XMLHttpRequest();
	else // Some people still support IE 6
	ajax = new ActiveXObject("Microsoft.XMLHTTP");

	ajax.onreadystatechange = function(){
	if(ajax.readyState === 4){
		if(ajax.status == 200){
			el.innerHTML = ajax.responseText;
		}else{
		el.innerHTML = error;
        }
    }
};

    ajax.open('GET', url);
    ajax.send();
}

