$(document).ready(function () {
  $(".dropdown-toggle").click(function () {
    // Close all dropdowns except the clicked one
    $(".collapse").not($(this).next()).collapse("hide");
    $(".toggle-icon").not($(this).find(".toggle-icon")).removeClass("rotated");

    // Toggle the clicked dropdown
    $(this).next().collapse("toggle");
    $(this).find(".toggle-icon").toggleClass("rotated");
  });

  // Toggle sidebar
  $("#sidebarToggler").click(function () {
    $(".sidebar").toggleClass("collapsed");
    $(".content").toggleClass("collapsed");
  });

  // Maintain the open state of the dropdowns based on the page
  var currentPath = window.location.pathname;
  if (
    currentPath.includes("customerAdd.php") ||
    currentPath.includes("customerManage.php") ||
    currentPath.includes("customerValid.php")
  ) {
    $("#customer").collapse("show"); // Keep the customer dropdown open
    document
      .querySelector('a[href="#customer"] .toggle-icon')
      .classList.add("rotated");
    if (currentPath.includes("customerAdd.php")) {
      document
        .querySelector('a[href="./customerAdd.php"]')
        .classList.add("active");
    } else if (currentPath.includes("customerManage.php")) {
      document
        .querySelector('a[href="./customerManage.php"]')
        .classList.add("active");
    } else if (currentPath.includes("customerValid.php")) {
      document
        .querySelector('a[href="./customerValid.php"]')
        .classList.add("active");
    }
  }
  if (
    currentPath.includes("addFood.php") ||
    currentPath.includes("manageFood.php")
  ) {
    $("#food").collapse("show"); // Keep the food dropdown open
    document
      .querySelector('a[href="#food"] .toggle-icon')
      .classList.add("rotated");
    if (currentPath.includes("addFood.php")) {
      document.querySelector('a[href="./addFood.php"]').classList.add("active");
    } else if (currentPath.includes("manageFood.php")) {
      document
        .querySelector('a[href="./manageFood.php"]')
        .classList.add("active");
    }
  }
  if (
    currentPath.includes("counterAdd.php") ||
    currentPath.includes("counterManage.php")
  ) {
    $("#counter").collapse("show"); // Keep the counter dropdown open
    document
      .querySelector('a[href="#counter"] .toggle-icon')
      .classList.add("rotated");
    if (currentPath.includes("counterAdd.php")) {
      document
        .querySelector('a[href="./counterAdd.php"]')
        .classList.add("active");
    } else if (currentPath.includes("counterManage.php")) {
      document
        .querySelector('a[href="./counterManage.php"]')
        .classList.add("active");
    }
  }
  if (currentPath.includes("manageCategory.php")) {
    $("#foodCategory").collapse("show"); // Keep the food category dropdown open
    document
      .querySelector('a[href="#foodCategory"] .toggle-icon')
      .classList.add("rotated");
    if (currentPath.includes("manageCategory.php")) {
      document
        .querySelector('a[href="./manageCategory.php"]')
        .classList.add("active");
    }
  }
  if (currentPath.includes("announcement.php")) {
    document
      .querySelector('a[href="./announcement.php"]')
      .classList.add("active");
  }
  if (currentPath.includes("analytics.php")) {
    document
      .querySelector('a[href="./analytics.php"]')
      .classList.add("active");
  }
  if (currentPath.includes("report.php")) {
    document
      .querySelector('a[href="./report.php"]')
      .classList.add("active");
  }
});
