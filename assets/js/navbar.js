$(document).ready(function () {
  (function () {
    let cart_icon = document.querySelector("#cart-icon");
    let cart = JSON.parse(localStorage.getItem("cart")) || {};
    const length = Object.keys(cart).length;

    if (cart_icon && length > 0) {
      // console.log(length);
      const totalItems = `<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" 
                                         style="background-color: rgb(11, 218, 11); font-size: 0.75rem; padding: 3px 5px;">
                                        ${length}
                                    </span>`;
      cart_icon.insertAdjacentHTML("beforeend", totalItems);
    }
  })();

  if (!window.location.pathname.includes("foodPlp.php")) {
    $(".search-Btn").click(function () {
      let searchQuery = $("#search").val().trim();
      window.location.href = `./foodPlp.php?search=${searchQuery}`;
    });

    $("#search").keypress(function (e) {
      if (e.which === 13) {
        let searchQuery = $(this).val().trim();
        window.location.href = `./foodPlp.php?search=${searchQuery}`;
      }
    });
  } else {
    $(".search-Btn").click(function () {
      searchQuery = $("#search").val().trim();
      const message = "No food items listed with your search.!";
      fetchFoods(1, searchQuery, null, message);
    });

    $("#search").keypress(function (e) {
      if (e.which === 13) {
        searchQuery = $(this).val().trim();
        const message = "No food items listed with your search.!";
        fetchFoods(1, searchQuery, null, message);
      }
    });
  }
});
