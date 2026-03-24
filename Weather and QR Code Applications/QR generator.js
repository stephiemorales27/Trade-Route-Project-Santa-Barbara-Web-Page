const wrapper= document.querySelector(".wrapper"), 
qrInput= wrapper.querySelector(".form input"),
generateBtn= document.querySelector(".form button");  
qrImg= wrapper.querySelector(".qr-code img"); 



generateBtn.addEventListener("click",()  => {  
    let qrValue = qrInput.value.trim();
    if(!qrValue) return; 
    qrValue= qrValue; 
    generateBtn.innerText = "Generando el Código QR";
    qrImg.src=`https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${qrValue}`;
    qrImg.addEventListener ("load",() => {
    wrapper.classList.add("active");  
    generateBtn.innerText = "Genera el Código QR";
    }); 
});   

qrInput.addEventListener("keyup",() => { 
    if(!qrInput.value) { 
        wrapper.classList.remove("active");
    }
});