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


                    // Lấy các inbox
                    const allInboxes = document.querySelectorAll("li.messenger__item");
                    const sectionChat = document.querySelector(".section-chat");
                    sectionChat.addEventListener('mouseenter', function() {
                        sectionChat.classList.add('active');
                    })
                    sectionChat.addEventListener('mouseleave', function() {
                        sectionChat.classList.remove('active');
                    })
                    allInboxes.forEach(inbox => {

                        inbox.addEventListener('click', function() {
                            // setInterval(() => {
                            allInboxes.forEach(i => {
                                i.classList.remove("active");
                            })
                            inbox.classList.add('active');
                            let unique_id = inbox.getAttribute('data');
                            const http = new XMLHttpRequest();
                            http.open("post", "../../back-end/loadInboxContent.php", true);

                            http.onload = () => {
                                if (http.readyState === XMLHttpRequest.DONE) {
                                    if (http.status === 200) {
                                        let data = http.response;
                                        sectionChat.innerHTML = data;
                                        if (!sectionChat.classList.contains('active')) {
                                            scrolToBottom();
                                        }
                                        // Ajax gửi tin nhắn
                                        const sendBtn = document.querySelector(".write-send-btn");
                                        sendBtn.addEventListener('click', function(event) {

                                            let box_id = event.target.getAttribute('data');
                                            let textarea = sendBtn.previousElementSibling;
                                            let content = textarea.value;

                                            const http = new XMLHttpRequest();
                                            http.open("post", "../../back-end/sendMessage.php", true);

                                            http.onload = () => {
                                                if (http.readyState === XMLHttpRequest.DONE) {
                                                    if (http.status === 200) {
                                                        let data = http.response;
                                                        if (data === 'success') {
                                                            textarea.value = '';
                                                            loadMessage();
                                                        }
                                                    }
                                                }
                                            }
                                            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                            http.send("box_id=" + box_id + "&content=" + content);

                                        })

                                    }
                                }

                            }
                            console.log(unique_id);
                            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            http.send("box_id=" + unique_id);
                            // }, 500);



                        })
                    })


                }
            }
        }
    };
    http.send(); // gui form
}, 500);


const scrolToBottom = () => {
    (function() {
        // Tự động scroll xuống dưới
        const chatContent = document.querySelector(".chat-content");
        // let chatContentHeight = chatContent.clientHeight;
        // chatContent.scroll(0, chatContentHeight);
        chatContent.scrollTop = chatContent.scrollHeight;

        // Khi nhập vào send, active cái nút gửi
        const writeInput = document.querySelector(".write-input");
        const sendBtn = document.querySelector(".write-send-btn");

        writeInput.addEventListener("keyup", function() {
            sendBtn.classList.add("active");
            if (!writeInput.value) {
                sendBtn.classList.remove("active");
            }
        });
    })();
}