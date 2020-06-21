// REST API for counties list

$.ajax({
  url: "https://restcountries.eu/rest/v2/all",
  type: "GET",
  dataType: "json",
  success: function (countries) {
    var countriesList = "";

    $.each(countries, function (key, country) {
      countriesList += "<option>" + country.name + "</option>";
    });

    $("#country").append(countriesList);
  },
});

// JS for showing the password // Signup Page
var pwd = document.getElementById("password");
var eye = document.getElementById("eye");

function togglePass() {
  eye.classList.toggle("active");
  return pwd.type == "password" ? (pwd.type = "text") : (pwd.type = "password");
}

if (pwd != null && eye != null) {
  eye.addEventListener("mousedown", togglePass);
}

// END JS for showing the password // Signup Page

// Delete Post from blog

$(".delete-post-btn").on("click", function () {
  if (confirm("Are you sure you want to DELETE this post?")) {
    return true;
  } else {
    return false;
  }
});

// END Delete Post from blog
