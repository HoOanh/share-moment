var form = document.querySelector('.form2');
form.onsubmit = (e) => {
    e.preventDefault();
}
let error = document.querySelector('.er');
var senBtn = document.querySelector('.btn-send');
senBtn.onclick = () => {
    var http = new XMLHttpRequest();
    http.open('post', '../../back-end/checkMail.php', true);

    http.onload = () => {
        if (http.readyState === XMLHttpRequest.DONE) {
            if (http.status === 200) {
                var data = http.response;

                // Chuyển JSON thành obj
                data = JSON.parse(data);

                if (data['data'] !== 'success') {
                    error.textContent = data['data'];
                    error.parentElement.style.display = 'flex';
                } else {
                    error.parentElement.style.backgroundColor = '#10b981';
                    error.textContent = "Đang gửi link đến mail của bạn";
                    error.parentElement.style.display = 'flex';

                    let http2 = new XMLHttpRequest();
                    http2.open('post', '../../back-end/sendMail.php', true);

                    http2.onload = () => {
                        if (http2.readyState === XMLHttpRequest.DONE) {
                            if (http2.status === 200) {
                                if (data['data'] !== 'success') {
                                    error.textContent = data['data'];
                                    error.parentElement.style.display = 'flex';
                                } else {
                                    error.parentElement.style.backgroundColor = '#10b981';
                                    error.textContent = 'Mail đã được gửi';
                                    error.parentElement.style.display = 'flex';

                                    setTimeout(function() {
                                        for (let i = 3; i >= 0; i--) {
                                            let time = (3 - i) * 1000;
                                            setTimeout(function() {
                                                error.textContent = `Sẽ trở về trang đăng nhập trong ${i} s`;
                                                if (i == 0) {
                                                    location.href = "index.php";
                                                }
                                            }, time);
                                        }
                                    }, 1000)
                                }
                            }
                        }
                    }
                    let formData2 = new FormData(form);
                    http2.send(formData2);
                }
            }


        }
    }
    let formData = new FormData(form);
    http.send(formData); // gui form
}