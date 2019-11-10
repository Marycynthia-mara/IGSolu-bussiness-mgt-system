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
	overlay.style.display = "none";
}

function markContact(contact_id, contact_status) {
	if (contact_status == 'read') {

	}else{
		
	}
}