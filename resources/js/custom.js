require('./bootstrap-filestyle.js');

$('#image-upload').filestyle({
		btnClass : 'btn-secondary',
    htmlIcon : "fas fa-folder-open",
    text : ' Select file',
    buttonBefore: true
});

$('#profil-image').filestyle({
  btnClass : 'btn-secondary',
  htmlIcon : "fas fa-folder-open",
  text : ' Select photo',
  buttonBefore: true
});
