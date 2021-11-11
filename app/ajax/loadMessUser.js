let userContainer = document.querySelector("#messageUserContainer");
let searchInput = document.querySelector(".uk-input");

searchInput.onkeyup = () => {
  let searchValue = searchInput.value;
  if (searchValue != "") {
    searchInput.classList.add("active");
  } else {
    searchInput.classList.remove("active");
  }
  var http = new XMLHttpRequest();
  http.open("post", "../../back-end/searchMessInHome.php", true);

  http.onload = () => {
    if (http.readyState === XMLHttpRequest.DONE) {
      if (http.status === 200) {
        var data = http.response;

        userContainer.innerHTML = data;
      }
    }
  };
  http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  http.send("searchValue=" + searchValue); // gui form
};

setInterval(() => {
  var http = new XMLHttpRequest();
  http.open("post", "../../back-end/loadMessUser.php", true);

  http.onload = () => {
    if (http.readyState === XMLHttpRequest.DONE) {
      if (http.status === 200) {
        var data = http.response;

        if (!searchInput.classList.contains("active")) {
          userContainer.innerHTML = data;
        }
      }
    }
  };
  http.send();
}, 500);
