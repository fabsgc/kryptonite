height();

$( document ).ready(function() {
	window.onresize = function (event) {
		height();
	};
});

function height(){
	var height = document.getElementById('main').offsetHeight + document.getElementsByTagName('header')[0].offsetHeight + document.getElementsByTagName('footer')[0].offsetHeight;

	if(window.innerHeight >  height)
		document.getElementById('sub-main').style.height = window.innerHeight - document.getElementsByTagName('header')[0].offsetHeight - document.getElementById('main').offsetHeight - document.getElementsByTagName('footer')[0].offsetHeight - 25 + "px";
	else
		document.getElementById('sub-main').style.height = "0px";
}

function closeFlashMessage(objet) {
	$(objet.parentNode).animate({
			height: "0px",
			opacity: "0",
			margin: "0",
			padding: "0"
		},
		250,
		function () {
			$(objet.parentNode).remove();
			height();
		}
	);
}