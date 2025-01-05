document.addEventListener("DOMContentLoaded", function () {
  var profpic = document.getElementById("prof_pic");

  if (profpic != null) {
    profpic.addEventListener("change", function (e) {
      var fileName = e.target.files[0] ? e.target.files[0].name : "";
      var fileNameDisplay = document.querySelector(".prof-pic");
      fileNameDisplay.textContent = fileName
        ? `Selected file: ${fileName}`
        : "";
      console.log(fileName);
      if (fileName != "") {
        var label = document.getElementById("custom-file-upload");
        label.style.backgroundColor = rgba(16, 201, 32, 1);
      }
    });
  } else {
    console.log("Element #prof_pic not found.");
  }
});
