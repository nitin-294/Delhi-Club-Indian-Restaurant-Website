document.addEventListener('DOMContentLoaded', () => {
    attachCartEventHandlers();
    bindPromoForm();
    updateRemovePromoButtonVisibility(false);
});

let currentPromoCode = null; 

function bindPromoForm() {
    const promoForm = document.getElementById('promoForm');
    if (!promoForm) return;

    promoForm.addEventListener('submit', async e => {
        e.preventDefault();
        const promoCodeInput = document.getElementById('promoCode');
        const promoCode = promoCodeInput.value.trim();
        const promoMessage = document.getElementById('promoMessage');

        if (!promoCode) {
            promoMessage.style.color = 'red';
            promoMessage.textContent = 'Please enter a promo code.';
            return;
        }

        await applyPromoCode(promoCode);
    });

    const removeBtn = document.getElementById('removePromoBtn');
    if (removeBtn) {
        removeBtn.addEventListener('click', async () => {
            await removePromoCode();
        });
    }
}

function updateRemovePromoButtonVisibility(show) {
    const removeBtn = document.getElementById('removePromoBtn');
    if (!removeBtn) return;
    removeBtn.style.display = show ? 'inline-block' : 'none';
}

function attachCartEventHandlers() {
    document.querySelectorAll('.quantityForm').forEach(form => {
        form.addEventListener('submit', handleCartAction);
    });
    document.querySelectorAll('.removeBtn').forEach(button => {
        const form = button.closest('form');
        if (form) form.addEventListener('submit', handleCartAction);
    });
}

async function handleCartAction(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);

    const clickedButton = form.querySelector('button[name="action"]:focus');
    if (clickedButton) {
        formData.set('action', clickedButton.value);
    }

    try {
        const response = await fetch('../PHP/cartAction.php', {
            method: 'POST',
            body: formData
        });
        const result = await response.json();
        if (result.status === 'success') {

            if (currentPromoCode) {
                await applyPromoCode(currentPromoCode, false);
            } else {
                updateCartDisplay(result.cart, result.total, 0, result.total, null);
                updateCartCount(result.count);
                updateRemovePromoButtonVisibility(false);
                clearPromoMessage();
            }
        } else {
            alert(result.message || 'Error updating cart.');
        }
    } catch (err) {
        alert('Failed to update cart: ' + err.message);
    }
}

async function applyPromoCode(code, showMessage = true) {
    const promoMessage = document.getElementById('promoMessage');
    const formData = new FormData();
    formData.append('promoCode', code);

    try {
        const res = await fetch('../PHP/applyPromo.php', {
            method: 'POST',
            body: formData
        });
        const result = await res.json();

        if (result.status === 'success') {
            currentPromoCode = code;
            if (showMessage) {
                promoMessage.style.color = 'green';
                promoMessage.textContent = result.message;
            }
            document.getElementById('promoCode').value = '';
            updateCartDisplay(result.cart, result.subtotal, result.discount, result.finalTotal, result.promoFreeItemName);
            updateCartCount(result.count);
            updateRemovePromoButtonVisibility(true);
        } else {
            currentPromoCode = null;
            promoMessage.style.color = 'red';
            promoMessage.textContent = result.message || 'Failed to apply promo code.';
            updateRemovePromoButtonVisibility(false);
        }
    } catch (err) {
        currentPromoCode = null;
        promoMessage.style.color = 'red';
        promoMessage.textContent = 'Error applying promo code.';
        console.error(err);
        updateRemovePromoButtonVisibility(false);
    }
}

async function removePromoCode() {
    const promoMessage = document.getElementById('promoMessage');
    try {
        const res = await fetch('../PHP/removePromo.php', { method: 'POST' });
        const result = await res.json();

        if (result.status === 'success') {
            currentPromoCode = null;
            promoMessage.textContent = '';
            updateCartDisplay(result.cart, result.subtotal, 0, result.subtotal, null);
            updateCartCount(result.count);
            updateRemovePromoButtonVisibility(false);
        } else {
            alert(result.message || 'Failed to remove promo.');
        }
    } catch (err) {
        alert('Error removing promo code.');
        console.error(err);
    }
}

function updateCartDisplay(cart, subtotal, discount, finalTotal, freeItemName = null) {
    const cartTable = document.querySelector('.cartTable');
    if (!cartTable) return;

    let html = `
        <tr>
            <th>Item</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
    `;

    for (const [name, item] of Object.entries(cart)) {
        const price = parseFloat(item.price).toFixed(2);
        const qty = item.quantity;
        const subtotalItem = (item.price * qty).toFixed(2);
        const isFree = freeItemName && item.item_name === freeItemName;

        html += `
            <tr>
                <td><strong>${item.item_name}</strong></td>
                <td>$${price}</td>
                <td>
                    ${
                        isFree
                        ? `<input type="text" value="1" size="2" readonly>`
                        : `<form class="quantityForm" style="display:inline;">
                                <input type="hidden" name="item_name" value="${item.item_name}">
                                <button type="submit" name="action" value="decrease"><strong>-</strong></button>
                                <input type="text" name="quantity" value="${qty}" size="2" readonly>
                                <button type="submit" name="action" value="increase"><strong>+</strong></button>
                           </form>`
                    }
                </td>
                <td><strong>$${subtotalItem}</strong></td>
                <td>
                    ${
                        isFree
                        ? ''
                        : `<form style="display:inline;">
                            <input type="hidden" name="item_name" value="${item.item_name}">
                            <button type="submit" name="action" value="remove" class="removeBtn">Remove</button>
                           </form>`
                    }
                </td>
            </tr>
        `;
    }

    html += `
        <tr class="totalRow">
            <td colspan="3"><strong>Subtotal</strong></td>
            <td colspan="2"><strong>$${parseFloat(subtotal).toFixed(2)}</strong></td>
        </tr>
    `;

    if (discount > 0) {
        html += `
            <tr class="discountRow">
                <td colspan="3"><strong>Discount</strong></td>
                <td colspan="2"><strong>-$${parseFloat(discount).toFixed(2)}</strong></td>
            </tr>
            <tr class="finalTotalRow">
                <td colspan="3"><strong>Final Total</strong></td>
                <td colspan="2"><strong>$${parseFloat(finalTotal).toFixed(2)}</strong></td>
            </tr>
        `;
    }

    cartTable.innerHTML = html;
    attachCartEventHandlers();
}

function updateCartCount(count) {
    const badge = document.getElementById('cartCount');
    if (badge) {
        badge.textContent = count;
        badge.style.transform = 'scale(1.2)';
        badge.style.transition = 'transform 0.3s ease';
        setTimeout(() => {
            badge.style.transform = 'scale(1)';
        }, 300);
    }
}

function clearPromoMessage() {
    const promoMessage = document.getElementById('promoMessage');
    if (promoMessage) {
        promoMessage.textContent = '';
    }
}
