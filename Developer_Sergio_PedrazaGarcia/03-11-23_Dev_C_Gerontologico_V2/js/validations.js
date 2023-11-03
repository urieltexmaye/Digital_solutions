



document.addEventListener("DOMContentLoaded", function() {
    const tutorNumberPhoneInput = document.getElementById("tutor_number_phone");
    const numberPhoneInput = document.getElementById("number_phone");
    const phoneError = document.getElementById("phone-error");
    const customError1 = document.getElementById("custom-error1");

    let previousNumberPhoneValue = '';
    let previousTutorNumberPhoneValue = '';

    numberPhoneInput.addEventListener("input", function() {
        const cleanedNumber = numberPhoneInput.value.replace(/\D/g, '').slice(0, 10);
        numberPhoneInput.value = cleanedNumber;

        if (cleanedNumber !== previousNumberPhoneValue) {
            customError1.textContent = ''; // Limpia el error al cambiar de valor
        }
        previousNumberPhoneValue = cleanedNumber;
    });

    tutorNumberPhoneInput.addEventListener("input", function() {
        if (tutorNumberPhoneInput.value !== previousTutorNumberPhoneValue) {
            phoneError.textContent = ''; // Limpia el error al cambiar de valor
        }
        previousTutorNumberPhoneValue = tutorNumberPhoneInput.value;
    });

    numberPhoneInput.addEventListener("blur", function() {
        const cleanedNumber = numberPhoneInput.value.replace(/\D/g, '').slice(0, 10);
        numberPhoneInput.value = cleanedNumber;

        if (cleanedNumber === '') {
            customError1.textContent = ''; // No mostrar error si está vacío
        } else if (cleanedNumber.length !== 10) {
            customError1.textContent = 'El teléfono debe contener 10 dígitos numéricos.';
        }
    });

    tutorNumberPhoneInput.addEventListener("blur", function() {
        if (tutorNumberPhoneInput.value === numberPhoneInput.value) {
            phoneError.textContent = '';
        }
    });
});




function setupTutorPhoneValidation() {
    const tutorNumberPhoneInput = document.getElementById("tutor_number_phone");
    const phoneError1 = document.getElementById("phone-error1");
    const customError2 = document.getElementById("custom-error2");
    const numberPhoneInput = document.getElementById("number_phone");

    let previousTutorNumberPhoneValue = '';
    let previousNumberPhoneValue = '';

    tutorNumberPhoneInput.addEventListener("input", function() {
        const cleanedNumber = tutorNumberPhoneInput.value.replace(/\D/g, '').slice(0, 10);
        tutorNumberPhoneInput.value = cleanedNumber;

        if (tutorNumberPhoneInput.value !== previousTutorNumberPhoneValue) {
            phoneError1.textContent = ''; // Limpia el error al cambiar de valor
        }
        previousTutorNumberPhoneValue = cleanedNumber;

        if (tutorNumberPhoneInput.value === numberPhoneInput.value) {
            customError2.textContent = '';
        } else {
            customError2.textContent = '';
        }
    });

    tutorNumberPhoneInput.addEventListener("blur", function() {
        const cleanedNumber = tutorNumberPhoneInput.value.replace(/\D/g, '').slice(0, 10);
        tutorNumberPhoneInput.value = cleanedNumber;

        if (cleanedNumber === '') {
            customError2.textContent = ''; // No mostrar error si está vacío
        } else if (cleanedNumber.length !== 10) {
            customError2.textContent = 'El teléfono debe contener 10 dígitos numéricos.';
        }
    });
}

function PhoneValidation(input) {
    // Elimina cualquier caracter que no sea un número
    input.value = input.value.replace(/\D/g, '');
  
    // Verifica que la longitud del número sea 10
    if (input.value.length > 10) {
      input.value = input.value.slice(0, 10); // Limita la entrada a 10 dígitos
    }
  }
document.addEventListener("DOMContentLoaded", setupTutorPhoneValidation);
