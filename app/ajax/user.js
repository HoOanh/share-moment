let userContainer = document.querySelector(".messenger__list");
setInterval(() => {
  var http = new XMLHttpRequest();
  http.open("post", "../../back-end/user.php", true);

  http.onload = () => {
    if (http.readyState === XMLHttpRequest.DONE) {
      if (http.status === 200) {
        var data = http.response;

        console.log(data);

        userContainer.innerHTML = data;
      }
    }
  };
  http.send(); // gui form
}, 500);
