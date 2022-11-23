const form = document.querySelector(".edit-form form.dashboard"),
saveBtn = document.querySelector(".edit-form form #save");
const cancelBtn = document.querySelector('#cancel');
const modalInactive = document.querySelector('#modal-edit-inactive1');
const modal = document.querySelector('#modal-edit');
const editBtn = document.querySelector('#user .btn-edit');
let message = document.querySelector('.message');

 

form.onsubmit = (e) =>{
    e.preventDefault(); //preventing from from submitting
}

// Modal Control 
cancelBtn.onclick = () => {
    modal.classList.remove("active2");
    modalInactive.classList.remove("active2");
}
editBtn.onclick = () => {
    modal.classList.add("active2");
    modalInactive.classList.add("active2");
}




saveBtn.onclick = () =>{
    // let's start Ajax 
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "../php/edit-account-logic.php", true);
    xhr.onload = () =>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                
                if (data === "success") {
                    location.href = "../admin/index.php";
                    modal.classList.remove("active2");
                    modalInactive.classList.remove("active2");
                    message.textContent = "Profile Edited Successfully";
                    message.classList.add('success');
                } else{
                    console.log(data);
                    message.textContent = "Unable to Edit Profile";
                    message.classList.add('error');
                    
                }
            }
        }
    }
    let formData =  new FormData(form); //creating new formData object
    xhr.send(formData); //sending the form data to php
}


