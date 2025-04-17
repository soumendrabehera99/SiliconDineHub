document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('searchInput').addEventListener('input', function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr'); // Adjust selector if needed

        rows.forEach(row => {
            const orderID = row.children[1]?.textContent.toLowerCase(); // OrderID column

            if (orderID.includes(filter)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});