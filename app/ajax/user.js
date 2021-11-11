let userContainer = document.querySelector(".messenger__list");
let searchInput = document.querySelector(".inp-search");

searchInput.onkeyup = () => {
  let searchValue = searchInput.value;
  if (searchValue != "") {
    searchInput.classList.add("active");
  } else {
    searchInput.classList.remove("active");
  }
  var http = new XMLHttpRequest();
  http.open("post", "../../back-end/search.php", true);

  http.onload = () => {
    if (http.readyState === XMLHttpRequest.DONE) {
      if (http.status === 200) {
        var data = http.response;

        userContainer.innerHTML = data;

        const userItem = document.querySelectorAll(".messenger__item"),
          sectionChat = document.querySelector(".section-chat"),
          inboxHeadline = document.querySelector(".messenger__inbox-headline");

        userItem.forEach((item) => {
          item.onclick = () => {
            searchInput.value = "";
            inboxHeadline.classList.remove("active");
            searchInput.classList.remove("active");

            let receiver = item.getAttribute("data");
            var http = new XMLHttpRequest();
            http.open("post", "../../back-end/section-chat.php", true);

            http.onload = () => {
              if (http.readyState === XMLHttpRequest.DONE) {
                if (http.status === 200) {
                  var data = http.response;
                  sectionChat.innerHTML = data;
                  mess();
                }
              }
            };
            http.setRequestHeader(
              "Content-type",
              "application/x-www-form-urlencoded"
            );
            http.send("receiver=" + receiver);
          };
        });
      }
    }
  };
  http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  http.send("searchValue=" + searchValue); // gui form
};

setInterval(() => {
  var http = new XMLHttpRequest();
  http.open("post", "../../back-end/user.php", true);

  http.onload = () => {
    if (http.readyState === XMLHttpRequest.DONE) {
      if (http.status === 200) {
        var data = http.response;

        if (!searchInput.classList.contains("active")) {
          userContainer.innerHTML = data;

          const userItem = document.querySelectorAll(".messenger__item"),
            sectionChat = document.querySelector(".section-chat");

          userItem.forEach((item) => {
            item.onclick = () => {
              let receiver = item.getAttribute("data");
              var http = new XMLHttpRequest();
              http.open("post", "../../back-end/section-chat.php", true);

              http.onload = () => {
                if (http.readyState === XMLHttpRequest.DONE) {
                  if (http.status === 200) {
                    var data = http.response;
                    sectionChat.innerHTML = data;
                    mess();
                  }
                }
              };
              http.setRequestHeader(
                "Content-type",
                "application/x-www-form-urlencoded"
              );
              http.send("receiver=" + receiver);
            };
          });
        }
      }
    }
  };
  http.send();
}, 500);


