require('./bootstrap-filestyle.js');

$('#image-upload').filestyle({
		btnClass : 'btn-secondary',
    htmlIcon : "fas fa-folder-open",
    text : ' Select file',
    buttonBefore: true
});



function imageInputCustomStyle() {
  $('#user-profile-image').filestyle({
    btnClass : 'btn-secondary',
    htmlIcon : "fas fa-folder-open",
    text : ' Select photo',
    size : 'sm',
    buttonBefore: true
  });
}

imageInputCustomStyle();


// ###################################################


/* A felhasználó mottójának módosítása */
const userMottoEditBtn = $('#user-motto-edit');
const userMottoSaveBtn = $('#user-motto-save');
const userMottoCancelBtn = $('#user-motto-cancel');
const userMottoPar = $('#user-motto');
const userMottoInput = $('#user-motto-input');

userMottoSaveBtn.hide();
userMottoCancelBtn.hide();
userMottoInput.hide();

// Ha a felhasználó a frissítés gombra kattint
userMottoEditBtn.on('click', () => {

  // Frissítés, Cancel gombok és a mottó mező megjelenítése
  userMottoSaveBtn.show();
  userMottoCancelBtn.show();
  userMottoInput.show();

  // A paragrafus és a szerkesztés gomb elrejtése
  userMottoPar.hide();
  userMottoEditBtn.hide();
});

// Ha a felhasználó a frissítés gombra kattint
userMottoCancelBtn.on('click', () => {

  // Frissítés, Cancel gombok és a mottó mező elrejtése
  userMottoSaveBtn.hide();
  userMottoCancelBtn.hide();
  userMottoInput.hide();

  // A paragrafus és a szerkesztés gomb megjelenítése
  userMottoPar.show();
  userMottoEditBtn.show();
});


// ###################################################


/* A felhasználó magamról szövegének módosítása */
const userAboutMeEditBtn = $('#user-about-me-edit');
const userAboutMeSaveBtn = $('#user-about-me-save');
const userAboutMeCancelBtn = $('#user-about-me-cancel');
const userAboutMePar = $('#user-about-me-par');
const userAboutMeTextarea = $('#user-about-me-textarea');

userAboutMeSaveBtn.hide();
userAboutMeCancelBtn.hide();
userAboutMeTextarea.hide();

// Ha a felhasználó a frissítés gombra kattint
userAboutMeEditBtn.on('click', () => {

  // Frissítés, Cancel gombok és a mottó mező megjelenítése
  userAboutMeSaveBtn.show();
  userAboutMeCancelBtn.show();
  userAboutMeTextarea.show();

  // A paragrafus és a szerkesztés gomb elrejtése
  userAboutMePar.hide();
  userAboutMeEditBtn.hide();
});

// Ha a felhasználó a frissítés gombra kattint
userAboutMeCancelBtn.on('click', () => {

  // Frissítés, Cancel gombok és a mottó mező elrejtése
  userAboutMeSaveBtn.hide();
  userAboutMeCancelBtn.hide();
  userAboutMeTextarea.hide();

  // A paragrafus és a szerkesztés gomb megjelenítése
  userAboutMePar.show();
  userAboutMeEditBtn.show();
});


// ###################################################


/* A felhasználó magamról szövegének módosítása */
const userImageEditBtn = $('#user-image-edit');
const userImageSaveBtn = $('#user-image-save');
const userImageCancelBtn = $('#user-image-cancel');
const userImagePar = $('#user-image-par');
const userImageInput = $('#user-image-input');

userImageSaveBtn.hide();
userImageCancelBtn.hide();
userImageInput.hide();

// Ha a felhasználó a frissítés gombra kattint
userImageEditBtn.on('click', () => {

  imageInputCustomStyle();

  // Frissítés, Cancel gombok és a mottó mező megjelenítése
  userImageSaveBtn.show();
  userImageCancelBtn.show();
  userImageInput.css('max-width', '300px');
  userImageInput.show();


  // A paragrafus és a szerkesztés gomb elrejtése
  userImagePar.hide();
  userImageEditBtn.hide();
});

// Ha a felhasználó a frissítés gombra kattint
userImageCancelBtn.on('click', () => {

  // Frissítés, Cancel gombok és a mottó mező elrejtése
  userImageSaveBtn.hide();
  userImageCancelBtn.hide();
  userImageInput.hide();

  // A paragrafus és a szerkesztés gomb megjelenítése
  userImagePar.show();
  userImageEditBtn.show();
});