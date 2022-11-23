
const adminForm = document.querySelector(".form_section #edit-admin-form");
const adminEditBtn = document.querySelectorAll('#madmin_tb .edt-adminBtn');
const adminCancelBtn = document.querySelector('#cancel');
const adminUpdateBtn = document.querySelector("#edit-admin-form #update");
const adminModalInactive = document.querySelector('#modal-edit-inactive3');
const adminModal = document.querySelector('#modal-edit-admin');


adminForm.onsubmit = (e) => {
    e.preventDefault(); //preventing from from submitting
}

// Modal Control 

// form Id's
let id = document.querySelector('#admin_id');
let prev_avatar = document.querySelector('#prev_avatar');
let prev_psword = document.querySelector('#prev_password');
let fname = document.querySelector('#admin_fname');
let lname = document.querySelector('#admin_lname');
let pnumber = document.querySelector('#pnumber');
let dob = document.querySelector('#dob');
let gender = document.querySelector('#gender');
let country = document.querySelector('#countries');


adminEditBtn.forEach(btn => {
    btn.onclick = () => {

        let admin_id = btn.getAttribute('id');

        // console.log(admin_id);
        let xhr = new XMLHttpRequest();
        let url = "../php/fetch-edit-admin.php?id=" + admin_id;

        xhr.open('GET', url, true)
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    adminModal.classList.add("active");
                    adminModalInactive.classList.add("active");
                    try {
                        let datas = JSON.parse(data);
                        id.value = datas.id;
                        prev_avatar.value = datas.avatar;
                        prev_psword.value = datas.password;
                        fname.value = datas.firstname;
                        lname.value = datas.lastname;
                        pnumber.value = datas.passport_no;
                        gender.value = datas.gender;
                        country.value = datas.nationality;

                    } catch (error) {
                        console.log(error);
                    }


                }
            }
        }
        xhr.send();

    }
});


adminCancelBtn.onclick = () => {
    adminModal.classList.remove("active");
    adminModalInactive.classList.remove("active");
}

adminUpdateBtn.onclick = () => {

    // let's start Ajax 
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "../php/edit-admin-logic.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;

                if (data === "success") {
                    adminModal.classList.remove("active");
                    adminModalInactive.classList.remove("active");
                    location.href = "../admin/manage-admin.php";
                } else {
                    console.log(data);

                }

            }
        }
    }
    let formData = new FormData(adminForm); //creating new formData object
    xhr.send(formData);
}