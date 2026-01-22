<script>
    document.addEventListener('keydown', function (e) {
        // Kiểm tra nếu phím nhấn là Enter và không nhấn kèm Shift/Ctrl
        if (e.key === 'Enter' && !e.shiftKey && !e.ctrlKey) {
            // 3. Tìm tất cả các nút bấm trên trang
            const buttons = Array.from(document.querySelectorAll('button'));

            // 4. Tìm nút có thuộc tính tạo tiếp (thường chứa wire:click="createAnother")
            // Hoặc lọc theo nội dung text bên trong nút
            const createAnotherBtn = buttons.find(btn =>
                btn.getAttribute('wire:click') === 'createAnother' ||
                btn.innerText.toLowerCase().includes('create & create another')
            );

            // Nếu tìm thấy nút và không phải đang gõ trong thẻ textarea
            if (createAnotherBtn && e.target.tagName !== 'TEXTAREA') {
                e.preventDefault();
                createAnotherBtn.click();
            }
        }
    });
</script>
