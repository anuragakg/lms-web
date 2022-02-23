$(function() {
  TRIFED.checkToken();
  //utils.processApiLinks();
  TRIFED.showPermissions();
  //utils.openPdfInNewTab();
  // getUserDetails();
  let userdata=JSON.parse(localStorage.getItem('authUser'));
	  $('.loggedin-user').html(userdata.name);
});

