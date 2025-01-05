console.log("hi");
let hidden = false;
var popup = document.getElementById("popup");
if (popup) {
  setTimeout(function () {
    popup.classList.add("hide");
    hidden = true;
    setTimeout(function () {
      if (hidden) {
        document.body.removeChild(popup);
        console.log("popup removed");
      }
    }, 500);
  }, 5000);
}

let counter = 0;

window.onload = function () {
  counter++;
};
if (counter == 1) {
  let url = new URL(window.location.href);
  let searchParams = new URLSearchParams(url.search);

  searchParams.delete("message");

  url.search = searchParams.toString();

  window.history.replaceState({}, "", url);

  console.log(searchParams);
}
