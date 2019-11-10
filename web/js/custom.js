function showContact(overlay, Mailsubj, MailBody, contactSubj, contactBody) {
	var overlay = document.getElementById(overlay);
	var Mailsubj = document.getElementById(Mailsubj);
	var MailBody = document.getElementById(MailBody);
	var contactSubj = document.getElementById(contactSubj).innerHTML;
	var contactBody = document.getElementById(contactBody).innerHTML;
	var BodyHeight = document.getElementsByTagName('body');
	var BodyWidth = document.getElementsByTagName('body');

	BodyHeight = $('#siteBody').height();
	BodyHeight+= 'px';
	BodyWidth = $('#siteBody').width();
	BodyWidth+= 'px';

	overlay.style.height = BodyHeight;
	overlay.style.width = BodyWidth;
	overlay.style.display = "block";

	Mailsubj.value = contactSubj;
	MailBody.value = contactBody;
}

function closeOverlay() {
	var overlay = document.getElementById('overlay');
	// overlay.style.display = "none";
	// alert('hello');
}

// function showProduct(a,b,c,d,e,f,g) {
// 	console.log('hi');
// 	var overlay = document.getElementById(a);
// 	overlay.style.display = "block";
// }

function showProduct(a) {
	var overlay = document.getElementById(a);
	overlay.style.display = "block";
}