<section class="feedback-form my-4" style="margin-bottom: 100px !important;">
    <div class="container">
        <div class="feedback-form-heading py-3 mb-3">
            <h2 class="text-center fs-1">Feedback Form</h2>
        </div>
        <div class="row bg-dark p-3 text-warning rounded-4">
            <div class="col-md-6">
                <div class="container">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control border-2 border-warning " id="name" placeholder="Enter your name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control border-2 border-warning" id="email" placeholder="Enter your email" required>
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
                        </div>
                        <div class="mb-3">
                            <label for="feedback" class="form-label">Feedback</label>
                            <textarea class="form-control border-2 border-warning" id="feedback" rows="4" placeholder="Write your feedback here..." required></textarea>
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
<script>
    document.addEventListener("DOMContentLoaded",function(){
        const stars = document.querySelectorAll(".star-rating i");
        stars.forEach(star=> {star.addEventListener("click",function(){
                const value = this.getAttribute("data-rating");
                stars.forEach(s=> s.classList.remove("active"));
                for(let i = 0;i < value;i++){
                    stars[i].classList.add("active");
                }
            });
        });
    });
</script>