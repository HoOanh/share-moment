function mess() {
  const chatContent = document.querySelector(".chat-content");
  const receiverId = document
    .querySelector("#receiver_id")
    .getAttribute("data");
  // <!-- Scroll To bottom -->
  function scrollToBottom() {
    chatContent.scrollTop = chatContent.scrollHeight;
  }

  chatContent.addEventListener("mouseenter", function () {
    chatContent.classList.add("active");
  });
  chatContent.addEventListener("mouseleave", function () {
    chatContent.classList.remove("active");
  });

  setInterval(function () {
    const http = new XMLHttpRequest();

    http.open("post", "../../back-end/loadChatContent.php", true);
    http.onload = () => {
      if (http.readyState === XMLHttpRequest.DONE) {
        if (http.status === 200) {
          let data = http.response;
          chatContent.innerHTML = data;
          if (!chatContent.classList.contains("active")) {
            scrollToBottom();
          }
        }
      }
    };
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("receiver=" + receiverId);
  }, 500);

  //  Chạy ajax nhắn tin

  const messageInput = document.querySelector(".write-input");
  const sendBtn = document.querySelector(".write-send-btn");

  sendBtn.addEventListener("click", function () {
    let content = messageInput.value;
    const http = new XMLHttpRequest();

    http.open("post", "../../back-end/sendMessage.php", true);
    http.onload = () => {
      if (http.readyState === XMLHttpRequest.DONE) {
        if (http.status === 200) {
          let data = http.response;
          if (data == "success") {
            messageInput.value = "";
          }
        }
      }
    };
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("box_id=" + receiverId + "&content=" + content);
  });

  messageInput.addEventListener("keyup", function (event) {
    let content = messageInput.value;
    content = content.trim();
    if (event.keyCode == 13 && !event.shiftKey) {
      if (content.length > 0) {
        const http = new XMLHttpRequest();

        http.open("post", "../../back-end/sendMessage.php", true);
        http.onload = () => {
          if (http.readyState === XMLHttpRequest.DONE) {
            if (http.status === 200) {
              let data = http.response;
              if (data == "success") {
                messageInput.value = "";
                content = "";
                sendBtn.classList.remove("active");
              }
            }
          }
        };
        http.setRequestHeader(
          "Content-type",
          "application/x-www-form-urlencoded"
        );
        http.send("box_id=" + receiverId + "&content=" + content);
      } else {
        messageInput.value = "";
      }
    }

    if (content) {
      sendBtn.classList.add("active");
    } else {
      sendBtn.classList.remove("active");
    }
  });
}
