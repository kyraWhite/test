

var heightWindow,widthWindow;

jQuery(document).ready(function($){
	//document.getElementById("desc").parentNode.addEventListener("submit",ResponseDescription(), true);
	//$("#desc").submit(function(){ });
	ResponseDescription();
	$("#desc").submit(function(event){
        event.preventDefault();
        console.log("Предотвращаю страндартный обработчик");
		ResponseDescription();
    });
	$("#reiting").submit(function(event){
        event.preventDefault();
        console.log("Предотвращаю страндартный обработчик");
		ResponseReiting();
    });
	$("#contacts").submit(function(event){
        event.preventDefault();
        console.log("Предотвращаю страндартный обработчик");
		ResponseContacts();
    });
	$("#mat").submit(function(event){
        event.preventDefault();
        console.log("Предотвращаю страндартный обработчик");
		ResponseMat();
    });
	
});
/*
jQuery(document).ready(function(event) {
  // получить объект событие.
  // вместо event лучше писать window.event
  event = event || window.event

  // кросс-браузерно получить target
  var t = event.target || event.srcElement

  alert(t)
});
*/

function ResponseDescription(){
	console.log( "Загружаю вкладку Об игре с помощью ajax");
	aside = document.getElementById("content");
		
	var body = 'test=3333';
	
	aside.innerHTML="<img src='loaderImage.gif'>";
	if(XMLHttpRequest) var x = new XMLHttpRequest();
	else var x = new ActiveXObject("Microsoft.XMLHTTP");
	x.open("POST", "desc.php?factory=true", true);
	x.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
	x.send(body);
	x.onreadystatechange = function(){
		if(x.readyState == 4){
			if(x.status == 200) aside.innerHTML = x.responseText;
			else aside.innerHTML = "Error loading document";
			}
		}
	
};

function ResponseReiting(){
	console.log( "Загружаю вкладку Рэйтинг с помощью ajax");
	aside = document.getElementById("content");
		
	var body = 'test=3333';
	
	aside.innerHTML="<img src='loaderImage.gif'>";
	if(XMLHttpRequest) var x = new XMLHttpRequest();
	else var x = new ActiveXObject("Microsoft.XMLHTTP");
	x.open("POST", "reiting.php?factory=true", true);
	x.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
	x.send(body);
	x.onreadystatechange = function(){
		if(x.readyState == 4){
			if(x.status == 200) aside.innerHTML = x.responseText;
			else aside.innerHTML = "Error loading document";
			}
		}
	
};

function ResponseContacts(){
	console.log( "Загружаю вкладку Рэйтинг с помощью ajax");
	aside = document.getElementById("content");
		
	var body = 'test=3333';
	
	aside.innerHTML="<img src='loaderImage.gif'>";
	if(XMLHttpRequest) var x = new XMLHttpRequest();
	else var x = new ActiveXObject("Microsoft.XMLHTTP");
	x.open("POST", "contacts.php?factory=true", true);
	x.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
	x.send(body);
	x.onreadystatechange = function(){
		if(x.readyState == 4){
			if(x.status == 200) aside.innerHTML = x.responseText;
			else aside.innerHTML = "Error loading document";
			}
		}
	
};

function ResponseMat(){
	console.log( "Загружаю вкладку Рэйтинг с помощью ajax");
	aside = document.getElementById("content");
		
	var body = 'test=3333';
	
	aside.innerHTML="<img src='loaderImage.gif'>";
	if(XMLHttpRequest) var x = new XMLHttpRequest();
	else var x = new ActiveXObject("Microsoft.XMLHTTP");
	x.open("POST", "mat.php?factory=true", true);
	x.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
	x.send(body);
	x.onreadystatechange = function(){
		if(x.readyState == 4){
			if(x.status == 200) aside.innerHTML = x.responseText;
			else aside.innerHTML = "Error loading document";
			}
		}
	
};

function windowSize(){
	
	heightWindow = $(window).height();
	widthWindow = $(window).width();
	
	console.log( "widthWindow = "+widthWindow);
	
	var widthElem = (widthWindow-15)/4-15;
	
	console.log( "widthElem = "+widthElem);
	//alert($("#naviButtons").getElementsByTagName('div').length);

	$("#hrendesc").outerWidth(widthElem);
	$("#hrenreiting").outerWidth(widthElem);
	$("#hrencontacts").outerWidth(widthElem);
	$("#hrenmat").outerWidth(widthElem);
}





$(window).load(windowSize); // при загрузке
$(window).resize(windowSize); // при изменении размеров

    $( document ).ready(function() {
        console.log( "document loaded" );

    });
 
    $( window ).on( "load", function() {
        console.log( "window loaded" );
    });


	
	
	