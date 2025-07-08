document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.addToCartForm').forEach(form => {
    form.addEventListener('submit', function (e) {
      e.preventDefault();

      const formData = new FormData(form);

      fetch(form.action, {
        method: 'POST',
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          const wrapper = form.parentElement;
          const msg = wrapper.querySelector('.add-msg');
          if (msg) {
            msg.textContent = '✓ Item added!';
            msg.style.visibility = 'visible';
          }

          const cartCount = document.getElementById('cartCount');
          if (cartCount) {
            cartCount.textContent = data.count;
          }

          setTimeout(() => {
            if (msg) {
              msg.style.visibility = 'hidden';
            }
          }, 750);
        } else {
          console.warn('Add to cart failed:', data);
        }
      })
      .catch(err => console.error('Error adding to cart:', err));
    });
  });
});
