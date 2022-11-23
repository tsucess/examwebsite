const formEdit = document.querySelector(".add-document-form form");
const modalInactive = document.querySelector('#modal-edit-inactive4');
const modalAdd = document.querySelector('#modal-add-form4');
const dashboard = document.querySelector('.dashboard');
const cancelBtn = document.querySelector('#cancel-form');
const addBtn = document.querySelector('#add-form');
const uploadBtn = document.querySelector(".add-document-form form #save-form");






formEdit.onsubmit = (e) => {
    e.preventDefault(); //preventing from from submitting
}



// Modal Control 
cancelBtn.onclick = () => {
    modalAdd.classList.remove("active2");
    modalInactive.classList.remove("active2");
}

addBtn.onclick = () => {
    modalAdd.classList.add("active2");
    modalInactive.classList.add("active2");
}




uploadBtn.onclick = () => {
    // let's start Ajax 
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "../php/add-form-logic.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                
                if (data === "success") {
                    location.href = "../admin/forms.php";
                    modalAdd.classList.remove("active2");
                    modalInactive.classList.remove("active2");
                } else {
                    console.log(data);

                }
            }
        }
    }
    let formData = new FormData(formEdit); //creating new formData object
    xhr.send(formData); //sending the form data to php
}


