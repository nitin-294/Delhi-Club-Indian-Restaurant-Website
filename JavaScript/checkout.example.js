document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('form');

  const fields = {
    delivery_method: {
      inputs: [document.getElementById('pickup'), document.getElementById('delivery')],
      errorDiv: document.getElementById('deliveryError'),
    },
    name: {
      input: document.getElementById('name'),
      errorDiv: document.getElementById('nameError'),
    },
    email: {
      input: document.getElementById('email'),
      errorDiv: document.getElementById('emailError'),
    },
    address: {
      input: document.getElementById('streetAddress'),
      errorDiv: document.getElementById('addressError'),
      container: document.getElementById('addressSection'),
      validationDiv: document.getElementById('addressValidation'),
    },
    payment: {
      inputs: [document.getElementById('card'), document.getElementById('paypal'), document.getElementById('cash')],
      errorDiv: document.getElementById('paymentError'),
    },
    card_number: {
      input: document.getElementById('cardNumber'),
      errorDiv: document.getElementById('cardNumberError'),
    },
    expiry_date: {
      input: document.getElementById('expiryDate'),
      errorDiv: document.getElementById('expiryDateError'),
    },
    cvv: {
      input: document.getElementById('cvv'),
      errorDiv: document.getElementById('cvvError'),
    }
  };

  let formSubmitted = false;

  function showError(field, message) {
    if (!field.errorDiv) return;
    if (message && formSubmitted) {
      field.errorDiv.textContent = message;
      field.errorDiv.style.display = 'block';
    } else {
      field.errorDiv.textContent = '';
      field.errorDiv.style.display = 'none';
    }
  }

  function isEmailValid(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  }

  function isCardNumberValid(num) {
    return /^\d{13,19}$/.test(num.replace(/\s+/g, ''));
  }

  function isExpiryValid(exp) {
    return /^(0[1-9]|1[0-2])\/?(\d{2}|\d{4})$/.test(exp);
  }

  function isCVVValid(cvv) {
    return /^\d{3,4}$/.test(cvv);
  }

  function validateAll() {
    let valid = true;

    const deliverySelected = fields.delivery_method.inputs.some(radio => radio.checked);
    if (!deliverySelected) {
      showError(fields.delivery_method, 'Please select a delivery method.');
      valid = false;
    } else {
      showError(fields.delivery_method, '');
    }

    if (!fields.name.input.value.trim()) {
      showError(fields.name, 'Name is required.');
      valid = false;
    } else {
      showError(fields.name, '');
    }

    if (!fields.email.input.value.trim()) {
      showError(fields.email, 'Email is required.');
      valid = false;
    } else if (!isEmailValid(fields.email.input.value.trim())) {
      showError(fields.email, 'Please enter a valid email address.');
      valid = false;
    } else {
      showError(fields.email, '');
    }

    if (document.getElementById('delivery').checked) {
      if (!fields.address.input.value.trim()) {
        showError(fields.address, 'Delivery address is required.');
        valid = false;
      } else {
        showError(fields.address, '');
      }
    } else {
      showError(fields.address, '');
    }

    const paymentSelected = fields.payment.inputs.some(radio => radio.checked);
    if (!paymentSelected) {
      showError(fields.payment, 'Please select a valid payment method.');
      valid = false;
    } else {
      showError(fields.payment, '');
    }

    if (document.getElementById('card').checked) {
      if (!isCardNumberValid(fields.card_number.input.value)) {
        showError(fields.card_number, 'Please enter a valid card number (13 to 19 digits).');
        valid = false;
      } else {
        showError(fields.card_number, '');
      }
      if (!isExpiryValid(fields.expiry_date.input.value)) {
        showError(fields.expiry_date, 'Please enter a valid expiry date (MM/YY).');
        valid = false;
      } else {
        showError(fields.expiry_date, '');
      }
      if (!isCVVValid(fields.cvv.input.value)) {
        showError(fields.cvv, 'Please enter a valid CVV (3 or 4 digits).');
        valid = false;
      } else {
        showError(fields.cvv, '');
      }
    } else {
      showError(fields.card_number, '');
      showError(fields.expiry_date, '');
      showError(fields.cvv, '');
    }

    return valid;
  }

  function toggleAddressAndCard() {
    if (document.getElementById('delivery').checked) {
      fields.address.container.style.display = 'block';
      fields.address.input.required = true;
    } else {
      fields.address.container.style.display = 'none';
      fields.address.input.required = false;
      showError(fields.address, '');
      fields.address.validationDiv.innerHTML = '';
    }

    if (document.getElementById('card').checked) {
      document.getElementById('cardDetails').style.display = 'block';
      fields.card_number.input.required = true;
      fields.expiry_date.input.required = true;
      fields.cvv.input.required = true;
    } else {
      document.getElementById('cardDetails').style.display = 'none';
      fields.card_number.input.required = false;
      fields.expiry_date.input.required = false;
      fields.cvv.input.required = false;
      showError(fields.card_number, '');
      showError(fields.expiry_date, '');
      showError(fields.cvv, '');
    }
  }

  Object.values(fields).forEach(field => {
    if (field.input) {
      field.input.addEventListener('input', () => {
        if (formSubmitted) validateAll();
      });
    }
    if (field.inputs) {
      field.inputs.forEach(input => {
        input.addEventListener('change', () => {
          toggleAddressAndCard();
          if (formSubmitted) validateAll();
        });
      });
    }
  });

  toggleAddressAndCard();

  form.addEventListener('submit', e => {
    formSubmitted = true;
    if (!validateAll()) {
      e.preventDefault();
      const firstError = document.querySelector('.fieldError[style*="block"]');
      if (firstError) {
        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }
    }
  });


const streetAddressInput = fields.address.input;
const addressValidation = fields.address.validationDiv;
const apiKey = 'Your_API_Key';

streetAddressInput.addEventListener('input', function() {
  const searchText = this.value.trim();

  if (searchText !== '') {
    const apiUrl = `Your_API_URL`;

    fetch(apiUrl)
      .then(response => {
        if (!response.ok) {
          throw new Error('Network Problem');
        }
        return response.json();
      })
      .then(data => {
        if (data.features && data.features.length > 0) {
          const suggestions = data.features.map(feature => feature.properties.formatted);
          addressValidation.innerHTML = '';
          suggestions.forEach(suggestion => {
            const suggestionElement = document.createElement('button');
            suggestionElement.type = 'button';
            suggestionElement.textContent = suggestion;
            suggestionElement.classList.add('addressSuggestionButton');
            suggestionElement.addEventListener('click', () => {
              streetAddressInput.value = suggestion;
              addressValidation.innerHTML = '';
              streetAddressInput.dispatchEvent(new Event('input'));
            });
            addressValidation.appendChild(suggestionElement);
          });
        } else {
          addressValidation.innerHTML = '<p>No suggestions found.</p>';
        }
      })
      .catch(error => {
        console.error('Error fetching autocomplete data:', error);
        addressValidation.innerHTML = '<p>Error fetching suggestions.</p>';
      });
  } else {
    addressValidation.innerHTML = '';
  }
});


  const cardNumberInput = fields.card_number.input;
  const expiryDateInput = fields.expiry_date.input;

  cardNumberInput.addEventListener('input', () => {
    let value = cardNumberInput.value.replace(/\D/g, '').slice(0, 19);
    cardNumberInput.value = value.replace(/(.{4})/g, '$1 ').trim();
  });

  expiryDateInput.addEventListener('input', () => {
    let value = expiryDateInput.value.replace(/\D/g, '').slice(0, 4);
    if (value.length >= 3) {
      expiryDateInput.value = value.slice(0, 2) + '/' + value.slice(2);
    } else {
      expiryDateInput.value = value;
    }
  });
});
