document.addEventListener('DOMContentLoaded', () => {
  const deliveryRadio = document.getElementById('delivery');
  const pickupRadio = document.getElementById('pickup');
  const addressSection = document.getElementById('addressSection');
  const streetAddressInput = document.getElementById('streetAddress');
  const addressValidation = document.getElementById('addressValidation');

  function toggleSections() {
    if (deliveryRadio.checked) {
      addressSection.style.display = 'block';
      streetAddressInput.required = true;
    } else {
      addressSection.style.display = 'none';
      streetAddressInput.required = false;
    }
  }

  deliveryRadio.addEventListener('change', toggleSections);
  pickupRadio.addEventListener('change', toggleSections);
  toggleSections();

  streetAddressInput.addEventListener('input', function () {
    const searchText = this.value.trim();
    if (searchText === '') {
      addressValidation.innerHTML = '';
      return;
    }

    const apiKey = 'Your_API_Key';
    const apiUrl = `Your_API_URL`;

    fetch(apiUrl)
      .then(response => response.json())
      .then(data => {
        addressValidation.innerHTML = '';
        if (data.features && data.features.length > 0) {
          data.features.forEach(f => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.textContent = f.properties.formatted;
            btn.addEventListener('click', () => {
              streetAddressInput.value = f.properties.formatted;
              addressValidation.innerHTML = '';
            });
            addressValidation.appendChild(btn);
          });
        } else {
          addressValidation.innerHTML = '<p>No suggestions found.</p>';
        }
      })
      .catch(() => {
        addressValidation.innerHTML = '<p>Error fetching suggestions.</p>';
      });
  });
});
