document.addEventListener('DOMContentLoaded', () => {
    attachCartEventHandlers();
});

function attachCartEventHandlers() {
    document.querySelectorAll('.quantityForm').forEach(form => {
        form.addEventListener('submit', handleCartAction);
    });

    document.querySelectorAll('.removeBtn').forEach(button => {
        const form = button.closest('form');
        form.addEventListener('submit', handleCartAction);
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
            updateCartDisplay(result.cart, result.total);
            updateCartCount(result.count);
        } else {
            alert(result.message || 'An error occurred while updating the cart.');
        }
    } catch (err) {
        alert('Failed to update cart: ' + err.message);
    }
}

function updateCartDisplay(cart, total) {
    const cartTable = document.querySelector('.cartTable');

    if (!cartTable) return;

    let html = `
        <tr>
            <th>Item</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Action</th>
        </tr>
    `;

    if (Object.keys(cart).length === 0) {
        cartTable.outerHTML = '<p class="cartEmpty">Your cart is empty.</p>';
        return;
    }

    for (const [name, item] of Object.entries(cart)) {
        const price = parseFloat(item.price).toFixed(2);
        const subtotal = (item.price * item.quantity).toFixed(2);

        html += `
            <tr>
                <td><strong>${item.item_name}</strong></td>
                <td>$${price}</td>
                <td>
                    <form class="quantityForm" style="display:inline;">
                        <input type="hidden" name="item_name" value="${item.item_name}">
                        <button type="submit" name="action" value="decrease"><strong>-</strong></button>
                        <input type="text" name="quantity" value="${item.quantity}" size="2" readonly>
                        <button type="submit" name="action" value="increase"><strong>+</strong></button>
                    </form>
                </td>
                <td><strong>$${subtotal}</strong></td>
                <td>
                    <form style="display:inline;">
                        <input type="hidden" name="item_name" value="${item.item_name}">
                        <button type="submit" name="action" value="remove" class="removeBtn">Remove</button>
                    </form>
                </td>
            </tr>
        `;
    }

    html += `
        <tr class="totalRow">
            <td colspan="3"><strong>Total</strong></td>
            <td colspan="2"><strong>$${parseFloat(total).toFixed(2)}</strong></td>
        </tr>
    `;

    cartTable.innerHTML = html;

    attachCartEventHandlers();
}

function updateCartCount(count) {
    const cartCountElement = document.getElementById('cartCount');
    if (cartCountElement) {
        cartCountElement.textContent = count;

        cartCountElement.style.transform = 'scale(1.1)';
        cartCountElement.style.transition = 'transform 0.2s ease';
        setTimeout(() => {
            cartCountElement.style.transform = 'scale(1)';
        }, 200);
    }
}
