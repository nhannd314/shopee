document.addEventListener('DOMContentLoaded', function () {
    /**
     * Update trong giỏ hàng
     */
    document.addEventListener('click', function(e) {
        // Xử lý nút xóa sản phẩm
        if (e.target.classList.contains('remove-from-cart')) {
            const id = e.target.getAttribute('data-id');

            if (confirm('Bạn muốn xóa sản phẩm này?')) {
                // update cart session
                updateCartAjax(id, 0); // Gửi 0 để xóa
            }
        }
    });

    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('quantity-input')) {
            const id = e.target.getAttribute('data-id');
            const quantity = e.target.value;
            updateCartAjax(id, quantity);
        }
    })

    function updateCartAjax(id, quantity) {
        fetch('/update-cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                id: id,
                quantity: quantity
            })
        })
            .then(res => res.json())
            .then(data => {
                const item = document.querySelector(".cart-item-" + id);
                console.log(item);
                if (quantity === 0) {
                    // xóa hàng
                    item.remove();
                    if (document.querySelectorAll('.cart-item').length === 0) location.reload();
                }
                else {
                    item.querySelector('.quantity-input').value = quantity;
                    item.querySelector('.subtotal').innerText = data.subtotal + 'đ';
                }

                // Cập nhật tất cả các vị trí hiển thị tổng tiền
                document.querySelectorAll('.total-price').forEach(el => el.innerText = data.total + 'đ');
                document.querySelector('.cart-badge').innerText = data.count;
            });
    }
})
