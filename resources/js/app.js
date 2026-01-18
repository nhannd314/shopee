import './bootstrap';
import 'bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    /**
     * Sticky header
     */
    const header = document.getElementById('site-header');
    const spacer = document.getElementById('header-spacer');
    const topBar = document.querySelector('.top-bar');

    // Lấy chiều cao của top-bar để biết khi nào bắt đầu dính
    const stickyThreshold = topBar ? topBar.offsetHeight : 100;

    // Thiết lập chiều cao cho spacer bằng đúng chiều cao header để tránh giật
    if (spacer) {
        spacer.style.height = header.offsetHeight + 'px';
    }

    window.addEventListener('scroll', function() {
        if (window.scrollY > stickyThreshold) {
            header.classList.add('is-sticky');
        } else {
            header.classList.remove('is-sticky');
        }
    });

    /**
     * Button tang giam so luong dat hang
     */
    const qtyInput = document.getElementById('quantity');
    const btnMinus = document.getElementById('btn-minus');
    const btnPlus = document.getElementById('btn-plus');

    if (btnMinus && btnPlus && qtyInput) {
        btnMinus.addEventListener('click', function() {
            updateQty(-1);
        });

        btnPlus.addEventListener('click', function() {
            updateQty(1);
        });
    }

    function updateQty(step) {
        let currentValue = parseInt(qtyInput.value) || 1;
        let newValue = currentValue + step;
        qtyInput.value = newValue < 1 ? 1 : newValue;
    }

    /**
     * Thêm vào giỏ hàng
     */
    const btnAdds = document.querySelectorAll('.add-to-cart');

    if (btnAdds) {
        btnAdds.forEach(btnAdd => {
            btnAdd.addEventListener('click', function () {
                // hiệu ứng sản phẩm bay vào giỏ
                const productCard = this.closest('.product-wrapper');
                const productImg = productCard.querySelector('img');
                const cartBadge = document.querySelector('.cart-badge');
                // Gọi hiệu ứng bay ngay lập tức
                if (productImg && cartBadge) {
                    flyToCart(productImg, cartBadge);
                }

                // gửi ajax
                const productId = this.getAttribute('data-id');
                const qtyInput = document.getElementById('quantity');
                const qty = qtyInput ? qtyInput.value : 1;
                const url = btnAdd.getAttribute('data-url');

                // ajax update cart
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: qty
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            // Cập nhật số lượng giỏ hàng trên Header (nếu có)
                            const cartBadge = document.querySelector('.cart-badge');
                            if (cartBadge) cartBadge.innerText = data.cart_count;

                            // 2. Rung toàn bộ thẻ cart-link
                            const cartLink = document.querySelector('.cart-link');
                            if (cartLink) {
                                cartLink.classList.add('animate-cart');

                                // Xóa class sau khi diễn xong để lần sau bấm lại vẫn rung
                                setTimeout(() => {
                                    cartLink.classList.remove('animate-cart');
                                }, 400);
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        this.disabled = false;
                    });
            });
        })
    }

    /**
     * Hiệu ứng bay vào giỏ hàng
     */
    function flyToCart(imgElement, cartBadgeElement) {
        // 1. Tạo bản sao của ảnh
        const imgClone = imgElement.cloneNode();
        imgClone.removeAttribute('id');
        imgClone.className = '';
        imgClone.classList.add('flying-img');

        // 2. Lấy vị trí của ảnh gốc và icon giỏ hàng
        const imgRect = imgElement.getBoundingClientRect();
        const cartRect = cartBadgeElement.getBoundingClientRect();

        // 3. Thiết lập vị trí ban đầu cho bản sao
        Object.assign(imgClone.style, {
            top: `${imgRect.top + window.scrollY}px`,
            left: `${imgRect.left + window.scrollX}px`,
        });

        document.body.appendChild(imgClone);

        // 4. Bắt đầu bay sau một khoảng thời gian rất ngắn (để trình duyệt nhận diện vị trí cũ)
        setTimeout(() => {
            Object.assign(imgClone.style, {
                top: `${cartRect.top + window.scrollY}px`,
                left: `${cartRect.left + window.scrollX}px`,
                width: '20px',
                height: '20px',
                opacity: '0.1'
            });
        }, 10);

        // 5. Xóa bản sao sau khi bay xong
        imgClone.addEventListener('transitionend', () => {
            imgClone.remove();
        });
    }

    /**
     * Update trong giỏ hàng
     */
    document.addEventListener('click', function(e) {
        // Xử lý nút tăng giảm số lượng
        if (e.target.classList.contains('update-cart')) {
            const row = e.target.closest('tr');
            const id = row.getAttribute('data-id');
            const type = e.target.getAttribute('data-type');
            const qtyInput = row.querySelector('.qty-input');

            let newQty = parseInt(qtyInput.value);
            newQty = (type === 'plus') ? newQty + 1 : newQty - 1;

            if (newQty >= 1) {
                updateCartAjax(id, newQty, row);
            }
        }

        // Xử lý nút xóa sản phẩm
        if (e.target.closest('.remove-from-cart')) {
            const row = e.target.closest('tr');
            const id = row.getAttribute('data-id');
            if (confirm('Bạn muốn xóa sản phẩm này?')) {
                updateCartAjax(id, 0, row); // Gửi 0 để xóa
            }
        }
    });

    function updateCartAjax(id, quantity, row) {
        fetch('/update-cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ id: id, quantity: quantity })
        })
            .then(res => res.json())
            .then(data => {
                if (quantity === 0) {
                    row.remove();
                    if (document.querySelectorAll('tbody tr').length === 0) location.reload();
                } else {
                    row.querySelector('.qty-input').value = quantity;
                    row.querySelector('.subtotal').innerText = data.subtotal + 'đ';
                }

                // Cập nhật tất cả các vị trí hiển thị tổng tiền
                document.querySelectorAll('.total-price').forEach(el => el.innerText = data.total + 'đ');
                document.querySelector('.cart-badge').innerText = data.count;
            });
    }
});
