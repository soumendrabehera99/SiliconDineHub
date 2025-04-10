document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('searchInput').addEventListener('input', function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr'); // Adjust selector if needed

        rows.forEach(row => {
            const sl = row.children[0]?.textContent.toLowerCase(); // sl column
            const orderID = row.children[1]?.textContent.toLowerCase(); // OrderID column

            if (sl.includes(filter) || orderID.includes(filter) || sic.includes(filter)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});