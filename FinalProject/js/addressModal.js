//******************************************************//
//********** ADD ADDRESS MODAL ***********************//
//****************************************************//

var addressModal = document.getElementById('AddressModal');
var addressModalBTN = document.getElementById('addAddressBTN');
var addressModalClose =
document.getElementsByClassName('AddAddressCloseBTN')[0];

addressModalBTN.addEventListener('click', OpenAddressForm);
addressModalClose.addEventListener('click', ClossAddressForm);

function OpenAddressForm(){
	addressModal.style.display = 'block';
}

function ClossAddressForm(){
	addressModal.style.display = 'none';
}

//******************************************************//
//********** ADD ADDRESS MODAL ***********************//
//****************************************************//

var PaymentModal = document.getElementById('PaymentModal');
var PaymentModalBTN = document.getElementById('addPaymentBTN');
var PaymentModalClose =
document.getElementsByClassName('AddPaymentCloseBTN')[0];

PaymentModalBTN.addEventListener('click', OpenPaymentForm);
PaymentModalClose.addEventListener('click', ClossPaymentForm);

function OpenPaymentForm(){
	PaymentModal.style.display = 'block';
}

function ClossPaymentForm(){
	PaymentModal.style.display = 'none';
}