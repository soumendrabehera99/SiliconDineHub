var orderData;

// Show the spinner while loading
$('#loadingSpinner').show();

$.ajax({
    url: '../dbFunctions/dashboardAjax.php',
    method: 'GET',
    data: { operation: 'fetchOrderData' },  // Send operation type
    dataType: 'json',
    success: function(data) {
        if (data.error) {
            console.error(data.error);
            $('#loadingSpinner').html('<p style="color:red;">' + data.error + '</p>');
            return;
        }

        orderData = data;
        $('#loadingSpinner').hide();  // Hide spinner
        renderChart(6);  // Initialize chart after data is loaded
    },
    error: function(xhr, status, error) {
        console.error('Error:', error);
        $('#loadingSpinner').html('<p style="color:red;">Failed to load data.</p>');
    }
});

function getFilteredData(days) {
    const endDate = new Date();
    const startDate = new Date();
    startDate.setDate(endDate.getDate() - days);

    return orderData.filter(order => {
        const orderDate = new Date(order.createdAt);
        return orderDate >= startDate && orderDate <= endDate;
    });
}

function renderChart(days) {
    const noDataDiv = document.getElementById('noDataMessage');

    if (!orderData) {
        console.error('Order data not loaded yet.');
        return;
    }

    const filteredData = getFilteredData(days);

    if (filteredData.length === 0) {
        if (window.myChart) {
            window.myChart.destroy();
        }
        noDataDiv.style.display = 'block';
        return;
    } else {
        noDataDiv.style.display = 'none';
    }

    const dates = filteredData.map(order => {
        const orderDate = new Date(order.createdAt);
        return orderDate.toLocaleDateString();
    });

    const sales = filteredData.map(order => parseFloat(order.price));

    const ctx = document.getElementById('salesChart').getContext('2d');

    if (window.myChart) {
        window.myChart.destroy();
    }

    window.myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: dates,
            datasets: [{
                label: 'Sales',
                data: sales,
                borderColor: 'rgba(75, 192, 192, 1)',
                fill: false,
            }]
        },
        options: {
            scales: {
                x: {
                    type: 'category',
                    title: {
                        display: true,
                        text: 'Date'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Sales ($)'
                    }
                }
            }
        }
    });
}

// Handle day selector change
$('#daySelector').on('change', function () {
    const selectedDays = parseInt($(this).val());
    renderChart(selectedDays);
});