

const modalEdit = document.querySelector('#modal-edit');
const subeditForm = document.querySelector("form#edit-subject-form");
const canceleditBtn = document.querySelector('#cancel-edit');
const editBtn = document.querySelectorAll('.edit-course');
const updateBtn = document.querySelector(".edit-course-form form #update");


// form Id's
let id  = document.querySelector('#edit_id');
let subject  = document.querySelector('#edit_subject');
let subjectCode = document.querySelector('#edit_subjectcode');
let startDate = document.querySelector('#start_date');
let endDate = document.querySelector('#end_date');
let fee = document.querySelector('#edit_fee');
let thumbnail = document.querySelector('#edit_thumbnail');



subeditForm.onsubmit = (e) => {
    e.preventDefault(); //preventing from from submitting
}

// Modal Control 
canceleditBtn.onclick = () => {
    modalEdit.classList.remove("active2");
    modalInactive.classList.remove("active2");
}



editBtn.forEach(btn => {
    btn.onclick = () => {
        let sub_id = btn.getAttribute('id');

        // console.log(user_id);
        let xhr = new XMLHttpRequest();
        let url = "../php/fetch-edit-course.php?id="+sub_id;

        xhr.open('GET', url, true)
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                        modalEdit.classList.add("active2");
                        modalInactive.classList.add("active2");
                        try {
                            let datas = JSON.parse(data);

                            id.value = datas.id;
                            subject.value = datas.subject;
                            subjectCode.value = datas.subject_code;
                            startDate.value = datas.start_date;
                            endDate.value = datas.end_date;
                            fee.value = datas.fee;
                            thumbnail.value = datas.thumbnail;
                            
                        } catch (error) {
                            console.log(error);
                        }
                      
                        
                }
            }
        }
        xhr.send();

    }
});



updateBtn.onclick = () => {
    
    // let's start Ajax 
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "../php/edit-course-logic.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                
                if (data === "success") {
                    modalEdit.classList.remove("active2");
                    modalInactive.classList.remove("active2");
                    location.href = "../admin/available-courses.php";
                } else {
                    console.log(data);

                }
                
            }
        }
    }
    let formData = new FormData(subeditForm); //creating new formData object
    xhr.send(formData);
}


