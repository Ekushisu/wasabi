/* app.js */


function cookieToastValidated(e) {
	$.get(cookieUrl);
	$(e).parents("#toast-container").fadeOut();
}

/**
 * NavigationManager (class to manage differents navigations effects or stuff on the website)
 */
var NavigationManager = function(){
	//Unique Instance only
	if (NavigationManager.count >= 1) {
		console.log('Erreur: une instance existe déjà');
		delete window[this];
		return false;
	}
	NavigationManager.count++;

	var self = this; // To prevent jQuery this erasement by the class.

	/**
	 * Initialize the sideNavMobile of Materializecss
	 */
	this.initMobileSideNav = function(){
		$('.button-collapse').sideNav({
				menuWidth: 300, // Default is 240
				edge: 'left', // Choose the horizontal origin
				closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
			}
		);
	};
};
NavigationManager.count = 0;

var	ToastManager =  function() {
	//Unique Instance only
	if (ToastManager.count >= 1) {
		console.log('Erreur: une instance existe déjà');
		delete window[this];
		return false;
	}
	ToastManager.count++;

	var self = this; // To prevent jQuery this erasement by the class.

	this.toast = function(alert,message) {
		message = typeof message !== 'undefined' ? message : alert;
		switch (alert) {
			case "COOKIE":
				Materialize.toast('<div class="center-align">Pour le bon fonctionnement du site, ce dernier utilise des cookies qui s\'installent sur votre navigateur, vous acceptez tacitement l\'utilisation de ceux-ci.<div><a id="accept-cookie-button" class="waves-effect center-align waves-lights center-align" onClick="javascript:cookieToastValidated(this);">J\'ai compris !</a></div></div>', 100000, 'cookie-alert-toast');
				break;
			case "WARNING":
				Materialize.toast('<div class="center-align">' + message +'</div>', 15000, 'warning-toast');
				break;
			case "SUCCESS":
				Materialize.toast('<div class="center-align">' + message +'</div>', 15000, 'success-toast');
				break;
			case "ERROR":
				Materialize.toast('<div class="center-align">' + message +'</div>', 15000, 'error-toast');
				break;
		}
	};

	this.initToast = function() {
		toastList['error'].forEach(function(msg) {
			setTimeout(function(){self.toast('ERROR',msg);},50);
		});
		toastList['success'].forEach(function(msg) {
			setTimeout(function(){self.toast('SUCCESS',msg);},50);
		});
		toastList['warning'].forEach(function(msg) {
			setTimeout(function(){self.toast('WARNING',msg);},50);
		});
	}

};
ToastManager.count = 0;

function switchPanelPage(e){
	console.log($('#navMobileSelect').find('[selected="selected"] a'));
	/*document.location = $('#navMobileSelect').find('[selected="selected"] a').href;*/
}

/**
 * Launch when DOM ready
 */
$(document).ready(function(){
	console.log("Initialization of Javascripts");
	/*	To do whenever 	 */
	var navManager = new NavigationManager();
	var toastManager = new ToastManager();

	navManager.initMobileSideNav(); // Init mobile nav

	$('a.disabled').click(function(e){
		e.preventDefault();
	})

/*	if (!cookieAccepted) {
		setTimeout(function(){
			toastManager.toast("COOKIE");
		},300);
	}
*/
	$('select').material_select();
	Materialize.updateTextFields();

	toastManager.initToast();
});
