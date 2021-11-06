var form = document.querySelector('.form1');
form.onsubmit = (e)=>{
   e.preventDefault();
}
let error = document.querySelector('.er');
var senBtn = document.querySelector('.send-btn');
senBtn.onclick = () =>{
    var http = new XMLHttpRequest();
    http.open('post','./back-end/sign_up.php',true);

    http.onload = ()=>{
        if(http.readyState === XMLHttpRequest.DONE){
            if(http.status === 200){
                var data = http.response;
                if (data !== '') {                 
                    error.textContent = data;
                    error.parentElement.style.display = 'flex';   
                }else{
                    error.parentElement.style.display = 'none'; 
                    location.href = 'index.php';
                }  
                
            }
            

        }
    }
    let formData = new FormData(form);
    http.send(formData);// gui form
}

