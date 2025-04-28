<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<style>
@import url(//fonts.googleapis.com/css?family=Montserrat:300,400,700);
.feedback_card {
  font-family: "Montserrat", sans-serif;
  color: #8d97ad;
  font-weight: 300;
}

.feedback_card h5 {
	line-height: 30px;
	font-size: 18px;
}

.feedback_card .font-13 {
	font-size: 13px;
}

.feedback_card .card.card-shadow {
    -webkit-box-shadow: 0px 0px 30px rgba(115, 128, 157, 0.1);
    box-shadow: 0px 0px 30px rgba(115, 128, 157, 0.1);
}

.feedback_card .card::after {
  position: absolute;
  bottom: -15px;
  left: 35px;
  content: '';
  border-left: 15px solid transparent;
  border-right: 15px solid transparent;
  border-top: 15px solidrgb(219, 218, 218);
}

.feedback_card .owl-theme .owl-dots {
  margin-left: 20px;
}

.feedback_card .owl-theme .owl-dots .owl-dot span {
  width: 12px;
  height: 12px;
  background: #c0c0c0; /* normal dot color */
  display: block;
  border-radius: 50%;
  margin: 5px;
}

.feedback_card .owl-theme .owl-dots .owl-dot.active span,
.feedback_card .owl-theme .owl-dots .owl-dot:hover span {
  background: goldenrod; /* active and hover dot color */
}


.feedback_card .owl-dots {
  position: absolute;
  left: -108%;
  top: 70%;
}

.feedback_card .devider {
  height: 2px;
  width: 40px;
}

@media (max-width: 767px) {
  .feedback_card .owl-dots {
    position: relative;
    top: 0px;
    left: 0px;
  }
}
</style>


<div class="feedback_card py-5 bg-dark">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2 class="mt-4">What Customers Say</h2>
        <span class="devider bg-warning d-inline-block my-3"></span>
        <p>We value the voices of our students and staff. Your feedback helps us create a better, tastier, and more comfortable cafeteria experience for everyone.</p>
      </div>
      <div class="col-md-6 ml-auto">
        <div class="owl-carousel owl-theme feedback_items" id="feedback_items">
          <!-- item 1-->
          <div class="item">
            <div class="card card-shadow border-0 mb-4 position-relative">
              <div class="p-4">
                <h5 class="font-weight-light">WrapKit has given our websites huge national presence. We are #1 on page one in Google search results for every website we’ve built, and rank for more keywords than I ever expected in a very competitive, high-value customer industry. In
                  addition,
                </h5>
              </div>
            </div>
            <div class="d-flex align-items-center ml-3 ms-2">
              <div class="">
                <h6 class="font-weight-bold mb-0">Name</h6><span class="font-13">Food</span></div>
            </div>
          </div>
          <!-- item -->
          <!-- item 2-->
          <div class="item">
            <div class="card card-shadow border-0 mb-4 position-relative">
              <div class="p-4">
                <h5 class="font-weight-light">WrapKit has given our websites huge national presence. We are #1 on page one in Google search results for every website we’ve built, and rank for more keywords than I ever expected in a very competitive, high-value customer industry. In
                  addition,
                </h5>
              </div>
            </div>
            <div class="d-flex align-items-center ml-3 ms-2">
              <div class="">
                <h6 class="font-weight-bold mb-0">Name</h6><span class="font-13">Feedback Type</span></div>
            </div>
          </div>
          <!-- item -->
          <!-- item 3-->
          <div class="item">
            <div class="card card-shadow border-0 mb-4 position-relative">
              <div class="p-4">
                <h5 class="font-weight-light">WrapKit has given our websites huge national presence. We are #1 on page one in Google search results for every website we’ve built, and rank for more keywords than I ever expected in a very competitive, high-value customer industry. In
                  addition,
                </h5>
              </div>
            </div>
            <div class="d-flex align-items-center ml-3 ms-2">
              <div class="">
                <h6 class="font-weight-bold mb-0">Name</h6><span class="font-13">Food</span></div>
            </div>
          </div>
          <!-- item -->

        </div>
      </div>
    </div>
  </div>
</div>
<!-- Your jQuery (important) -->
<script src="./assets/jquery/jquery-3.7.1.min.js"></script>

<!-- Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>
    $('.feedback_items').owlCarousel({
        loop: true,
        margin: 30,
        nav: false,
        dots: true,
        autoplay: true,
        responsiveClass: true,
        responsive: {
            0: {
            items: 1

            },
            1650: {
            items: 1
            }
        }
    });

</script>