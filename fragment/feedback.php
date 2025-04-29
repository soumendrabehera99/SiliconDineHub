<!-- feedback_form.php -->
<section class="feedback-form my-4" style="margin-bottom: 100px !important;">
  <div class="container">
    <div class="feedback-form-heading py-3 mb-3">
      <h2 class="text-center fs-1">Feedback</h2>
    </div>
    <div class="row bg-dark p-3 text-warning rounded-4">
      <div class="col-md-6">
        <div class="container">
          <form id="feedbackForm">
            <div class="mb-3">
              <label class="form-label">Feedback Type</label><br>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="feedback_type" id="food" value="Food">
                <label class="form-check-label" for="food">Food</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="feedback_type" id="staff" value="Staff">
                <label class="form-check-label" for="staff">Staff</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="feedback_type" id="cafeteria" value="Cafeteria">
                <label class="form-check-label" for="cafeteria">Cafeteria</label>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Rate Us</label>
              <div class="star-rating d-flex gap-3">
                <i class="fas fa-star" data-rating="1"></i>
                <i class="fas fa-star" data-rating="2"></i>
                <i class="fas fa-star" data-rating="3"></i>
                <i class="fas fa-star" data-rating="4"></i>
                <i class="fas fa-star" data-rating="5"></i>
              </div>
              <input type="hidden" name="rating" id="rating-value" >
            </div>

            <div class="mb-3">
              <label for="feedback" class="form-label">Feedback</label>
              <textarea class="form-control border-2 border-warning" name="feedback" id="feedback" rows="4" placeholder="Write your feedback here..." ></textarea>
            </div>

            <div class="btn-div text-end">
              <button type="submit" class="btn btn-outline-warning px-4">Post</button>
            </div>
          </form>
        </div>
      </div>

      <div class="col-md-6">
        <div class="container">
          <img src="./assets/images/stars-health.gif" alt="Feedback GIF" class="img-fluid w-100">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- jQuery (for AJAX) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="./assets/toastr/toastr.min.js"></script>

<!-- Star Rating Script -->
<script>
document.addEventListener("DOMContentLoaded", function() {
  const stars = document.querySelectorAll(".star-rating i");
  stars.forEach(star => {
    star.addEventListener("click", function() {
      const value = this.getAttribute("data-rating");
      document.getElementById('rating-value').value = value;
      stars.forEach(s => s.classList.remove("active"));
      for (let i = 0; i < value; i++) {
        stars[i].classList.add("active");
      }
    });
  });
});
</script>

<!-- AJAX Form Submit -->
<script>
$(document).ready(function() {
  $('#feedbackForm').on('submit', function(e) {
    e.preventDefault();

    if ($('input[name="feedback_type"]:checked').length === 0) {
        toastr.error("Please select a feedback type.");
      return;
    }

    const rating = $('#rating-value').val();
    if (!rating) {
      toastr.error('Please select a rating.');
      return;
    }

    $.ajax({
      url: './dbFunctions/feedbackDb.php',
      type: 'POST',
      data: $(this).serialize(),
      success: function(response) {
        console.log(response);
        toastr.success(response);
        $('#feedbackForm')[0].reset();
        $('.star-rating i').removeClass('active');
      },
      error: function(xhr, status, error) {
        if (xhr.status === 400) {
            toastr.error("Error: " + xhr.responseText);
        } else {
            toastr.error("Unexpected error occurred. Please try again later.");
        }
      }
    });
  });
});
</script>