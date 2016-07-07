height();

$( document ).ready(function() {
	window.onresize = function (event) {
		height();
	};
});

function height(){
	var height = document.getElementById('main').offsetHeight + document.getElementsByTagName('header')[0].offsetHeight + document.getElementsByTagName('footer')[0].offsetHeight;
	var margin = 0;
console.log(window.location.href);
	if(window.location.href != 'http://www.kryptonite.dev/user/sign-in' && window.location.href != 'http://www.kryptonite.dev:83/user/sign-in' &&
	   window.location.href != 'http://www.kryptonite.dev/user/sign-up' && window.location.href != 'http://www.kryptonite.dev:83/user/sign-up'){
		margin = 10;
	}

	if(window.innerHeight >  height + 35)
		document.getElementById('sub-main').style.height = window.innerHeight - document.getElementsByTagName('header')[0].offsetHeight - document.getElementById('main').offsetHeight - document.getElementsByTagName('footer')[0].offsetHeight - 35 + margin + "px";
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