<section class="feedback my-5" id="feedback">
    <div class="container">
        <div class="feedback-heading py-3 mb-3">
            <h2 class="text-center fs-1">What Says Our Customers</h2>
        </div>

        <div id="carouselExampleSlidesOnly" class="carousel slide py-3" data-bs-ride="carousel">
            <div class="carousel-inner" id="feedback-carousel">
                <!-- Feedback items will be loaded here via AJAX -->
            </div>
        </div>
    </div>
</section>
<script src="./assets/jquery/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function () {
    $.ajax({
        url: './dbFunctions/feedbackDb.php',
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            console.log(response);
            if (response.success) {
                const feedback = response.data;
                const container = $('#feedback-carousel');
                let html = '';

                for (let i = 0; i < feedback.length; i += 2) {
                    html += `<div class="carousel-item ${i === 0 ? 'active' : ''}">
                                <div class="row g-2">`;

                    for (let j = i; j < i + 2 && j < feedback.length; j++) {
                        html += `<div class="col-md-6">
                                    <div class="text-white p-3 bg-dark rounded-4">
                                        <p class="text-truncate-2">${feedback[j].feedback_text}</p>
                                        <p>${feedback[j].feedback_type} : ${feedback[j].rating}/5</p>
                                        <h4>${feedback[j].student_name}</h4>
                                    </div>
                                </div>`;
                    }

                    html += `</div></div>`;
                }

                container.html(html);
            } else {
                console.error(response.error);
                alert('Error: ' + response.error);
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX error:', error);
            alert('Something went wrong. Please try again later.');
        }
    });
});
</script>
