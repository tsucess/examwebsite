
    const editForm = document.querySelector(".edit-form form");
    const userCancelBtn = document.querySelector('#cancel1');
    const userModalInactive = document.querySelector('#modal-edit-inactive2');
    const userModal = document.querySelector('#modal-edit-user');
    const userEditBtn = document.querySelectorAll('#muser_tb .edt-userBtn');
    const userUpdateBtn = document.querySelector(".edit-form form #update");


    editForm.onsubmit = (e) =>{
        e.preventDefault(); //preventing from from submitting
    }
    
    // Modal Control 
    userCancelBtn.onclick = () => {
        userModal.classList.remove("active3");
        userModalInactive.classList.remove("active2");
    }



// form Id's
let id  = document.querySelector('#user_id');
let prev_avatar  = document.querySelector('#prev_avatar');
let prev_psword = document.querySelector('#prev_password');
let fname = document.querySelector('#user_fname');
let lname = document.querySelector('#user_lname');
let pnumber = document.querySelector('#pnumber');
let dob = document.querySelector('#dob');
let gender = document.querySelector('#gender');
let country = document.querySelector('#countries');


    userEditBtn.forEach(btn =>{
       btn.onclick = () => {

        let user_id = btn.getAttribute('id');

        // console.log(user_id);
        let xhr = new XMLHttpRequest();
        let url = "../php/fetch-edit-user.php?id="+user_id;

        xhr.open('GET', url, true)
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                        userModal.classList.add("active3");
                        userModalInactive.classList.add("active2");
                        try {
                            let datas = JSON.parse(data);
                            id.value = datas.id;
                            prev_avatar.value = datas.avatar;
                            prev_psword.value = datas.password;
                            fname.value = datas.firstname;
                            lname.value = datas.lastname;
                            pnumber.value = datas.passport_no;
                            dob.value = datas.dob;
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


userUpdateBtn.onclick = () => {
    
    // let's start Ajax 
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "../php/edit-users-logic.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                
                if (data === "success") {
                    userModal.classList.remove("active3");
                    userModalInactive.classList.remove("active2");
                    location.href = "../admin/manage-users.php";
                } else {
                    console.log(data);

                }
                
            }
        }
    }
    let formData = new FormData(editForm); //creating new formData object
    xhr.send(formData);
}