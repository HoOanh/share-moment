(function () {
  let scrollMessengerInbox = document.querySelector("#inbox-inner");

  function hoveredScroll() {
    scrollMessengerInbox.classList.add("hovered");

    setTimeout(function () {
      scrollMessengerInbox.classList.remove("hovered");
    }, 2000);
  }

  scrollMessengerInbox.addEventListener("scroll", hoveredScroll);

  // ==================toggle active search ============

  let btnSearch = document.querySelector(
    ".messenger__inbox-headline .fa-search"
  );
  let inboxHeadline = document.querySelector(".messenger__inbox-headline");
  let searchInput = document.querySelector(".inp-search");

  btnSearch.onclick = function () {
    inboxHeadline.classList.toggle("active");
    btnSearch.nextElementSibling.value = "";

    searchInput.classList.remove("active");
  };
})();

(function () {
  const toggleDrops = document.querySelectorAll(".header_user-icon");
  toggleDrops.forEach((e) => {
    e.addEventListener("click", function () {
      const content = e.nextElementSibling;

      toggleDrops.forEach((ele) => {
        if (ele != e) {
          ele.nextElementSibling.classList.remove("active");
        }
      });

      content.classList.toggle("active");
    });
  });

  document.addEventListener("click", (e) => {
    let clickedOutside = true;
    e.path.forEach((item) => {
      if (!clickedOutside) return;

      if (item.className === "header_wrap") clickedOutside = false;
    });

    if (clickedOutside) {
      toggleDrops.forEach((e) => {
        e.nextElementSibling.classList.remove("active");
      });
    }
  });
})();
