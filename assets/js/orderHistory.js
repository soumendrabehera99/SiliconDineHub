document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('searchInput').addEventListener('input', function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr'); // Adjust selector if needed

        rows.forEach(row => {
            const orderID = row.children[0]?.textContent.toLowerCase(); // OrderID column
            const sic = row.children[2]?.textContent.toLowerCase();     // SIC column

            if (orderID.includes(filter) || sic.includes(filter)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});