<div class="input-group quantity-wrapper">
    <button class="decrease-quantity" type="button">-</button>

    <input type="number"
           class="quantity-input text-center no-spinners"
           min="1"
           data-id="{{ $id ?? '' }}"
           value="{{ $details['quantity'] ?? '1' }}">

    <button class="increase-quantity" type="button">+</button>
</div>
