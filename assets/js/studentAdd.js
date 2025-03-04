$(document).ready(function () {
  $("#addStudent").submit(function (e) {
    e.preventDefault();

    let sic = $("#sic").val();
    let email = $("#email").val();

    let sicError = validateSIC(sic);
    if (sicError) {
      toastr.error(sicError);
      return;
    }

    let emailError = validateEmail(email, sic);
    if (emailError) {
      toastr.error(emailError);
      return;
    }

    $.ajax({
      url: "../dbFunctions/studentAjax.php",
      method: "POST",
      data: {
        sic: sic.toUpperCase(),
        email: email.toLowerCase(),
        operation: "studentAdd",
      },
      success: function (response) {
        // console.log(response); // Debugging line to check the actual response
        if (response.trim() === "present") {
          toastr.error("Student already exists!");
        } else if (response.trim() === "success") {
          toastr.success("Student added successfully");
          $("#addStudent").trigger("reset");
          setTimeout(() => location.reload(), 500);
        } else if (response.trim() === "error") {
          toastr.error("There was an error adding the student");
        } else {
          toastr.error("Unknown response: " + response, "Error");
        }
      },
      error: function () {
        toastr.error("An error occurred while submitting");
      },
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("importStudentBtn")
    .addEventListener("click", function () {
      let file = document.getElementById("fileUpload").files[0];

      if (!file) {
        toastr.error("File not found!!");
        return;
      }

      let reader = new FileReader();
      reader.readAsBinaryString(file);

      reader.onload = (e) => {
        const data = e.target.result;

        const binarydata = XLSX.read(data, { type: "binary" });

        const sheetName = binarydata.SheetNames[0];

        const sheet = binarydata.Sheets[sheetName];

        const jsonData = XLSX.utils.sheet_to_json(sheet);
        // console.log(jsonData);

        let errors = validateExcelData(jsonData);
        if (errors.length > 0) {
          showErrorsInModal(errors);
        } else {
          uploadValidData(jsonData);
        }
      };
    });
});

// function for validate excel data
function validateExcelData(data) {
  let errors = [];
  let seenSic = new Set();
  data.forEach((row) => {
    let sic = row["SIC"];
    let errorSic = validateSIC(sic);
    let errorEmail = validateEmail(row["Email"], sic || " ");
    let rowNumber = row.__rowNum__;
    // console.log(rowNumber);
    if (errorSic || errorEmail) {
      errors.push(
        `Row ${rowNumber + 1} : ${errorSic || ""}  ${errorEmail || ""}`
      );
    } else if (seenSic.has(sic)) {
      errors.push(`Row ${rowNumber + 1}: Duplicate SIC number ${sic} found.`);
    } else {
      seenSic.add(sic);
    }
  });
  return errors;
}

// function for Sic Validation
function validateSIC(sic) {
  if (!sic) return "SIC is Missing.";
  if (sic.length !== 8) return "SIC must be exactly 8 characters long";

  let sicPattern = /^[0-9]{2}[a-z]{4}[0-9]{2}$/i; // Example: 23mmci48
  if (!sicPattern.test(sic)) return "SIC format is invalid (e.g., 23mmci48)";

  return null; // No errors
}

// function for Email Validation
function validateEmail(email, sic) {
  sic = sic.toLowerCase();
  email = email.toLowerCase();
  let emailPattern =
    /^[a-zA-Z0-9._%+-]{2,}\.\d{2}[a-zA-Z]{4}\d{2}@silicon\.ac\.in$/;
  if (!email) return "Email is Missing";
  if (!email.includes(sic)) return "Email does not match SIC No";
  if (!emailPattern.test(email)) return "Enter a valid email address";
  return null;
}

function showErrorsInModal(errors) {
  $("#errorModalLabel").text("Validation Errors");
  let formattedErrorArray = errors.map((err) => `<p>${err}</p>`);
  document.getElementById("modalBody").innerHTML = formattedErrorArray.join("");
  $("#errorModal").modal("show");
}

function uploadValidData(data) {
  $.ajax({
    url: "../dbFunctions/studentAjax.php",
    method: "POST",
    data: { jsonData: JSON.stringify(data), operation: "addAllData" },
    success: function (response) {
      let res = JSON.parse(response);

      // console.log(res);

      if (res.status === "error" && res.existingSICs) {
        $("#errorModalLabel").text("Existing Sics");
        let formatedExistingSics = res.existingSICs.map(
          (err) => `<li>${err}</li>`
        );
        let ul = document.createElement("ul");
        ul.innerHTML = formatedExistingSics.join("");
        document.getElementById("modalBody").innerHTML = "";
        document.getElementById("modalBody").appendChild(ul);
        $("#errorModal").modal("show");
        toastr.warning(res.message);
      } else if (res.status === "success") {
        toastr.success("All students added successfully!");
      } else {
        toastr.error(res.message);
      }
    },
    error: function () {
      toastr.error("An error occurred while uploading data.");
    },
  });
}
