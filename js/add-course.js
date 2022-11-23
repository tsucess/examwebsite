const form = document.querySelector(".add-course-form form");
// const subForm = document.querySelector("form#subject-form");
const saveBtn = document.querySelector(".add-course-form form #save");
const modalInactive = document.querySelector('#modal-edit-inactive');
const modalAdd = document.querySelector('#modal-add');
const dashboard = document.querySelector('.dashboard');
const cancelBtn = document.querySelector('#cancel-add');
const addBtn = document.querySelector('#add-course');






form.onsubmit = (e) => {
    e.preventDefault(); //preventing from from submitting
}

// subForm.onsubmit = (e) => {
//     e.preventDefault(); //preventing from from submitting
// }


// Modal Control 
cancelBtn.onclick = () => {
    modalAdd.classList.remove("active2");
    modalInactive.classList.remove("active2");
}
addBtn.onclick = () => {
    modalAdd.classList.add("active2");
    modalInactive.classList.add("active2");
}




saveBtn.onclick = () => {
    // let's start Ajax 
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "../php/add-course-logic.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                
                if (data === "success") {
                    location.href = "../admin/available-courses.php";
                    modalAdd.classList.remove("active2");
                    modalInactive.classList.remove("active2");
                } else {
                    console.log(data);

                }
            }
        }
    }
    let formData = new FormData(form); //creating new formData object
    xhr.send(formData); //sending the form data to php
}


