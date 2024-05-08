//Imask
const phoneInputs = document.querySelectorAll('.phone-mask');
const phoneOptions = {
    mask: '+{7} (000) 000-00-00'
}
phoneInputs.forEach((el) => {
    if ( !phoneInputs ) return;
    const maskedPhone = IMask(el, phoneOptions);

    el.addEventListener('focus', function() {
        maskedPhone.updateOptions({ lazy: false });
    }, true);

    el.addEventListener('blur', function() {
        maskedPhone.updateOptions({ lazy: true });
        // NEXT IS OPTIONAL
        if (!maskedPhone.masked.rawInputValue) {
          maskedPhone.value = '';
        }
      }, true);
})

const portBtns = document.querySelectorAll('.c-modal__callback-button');
portBtns.forEach((el) => {
    el.addEventListener('click', function() {
		const portTitle = el.getAttribute('data-port');
		document.querySelector('.port__title').value = portTitle;
	});
})