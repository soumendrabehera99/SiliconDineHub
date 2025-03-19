$(document).ready(function () {
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
