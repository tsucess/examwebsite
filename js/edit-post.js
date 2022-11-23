const modalInactive = document.querySelector('#modal-edit-inactive5');
const modalEdit = document.querySelector('#modal-edit-post5');
const subEditpost = document.querySelector("form#edit-document-post");
const canceleditBtn = document.querySelector('#cancel-edit-post');
const editBtn = document.querySelectorAll('.edit-post-btn');
const updateBtn = document.querySelector("form#edit-document-post > div.control > #update-post");


// post Id's
let id = document.querySelector('#edit_id');
let prev_thumbnail_name = document.querySelector('#prev_thumbnail_name');

let title = document.querySelector('#title');
let body = document.querySelector('#body');
let thumbnail = document.querySelector('#thumbnail');
let is_featured = document.querySelector('#is_featured');



subEditpost.onsubmit = (e) => {
    e.preventDefault(); //preventing from from submitting
}

// Modal Control 
canceleditBtn.onclick = () => {
    modalEdit.classList.remove("active2");
    modalInactive.classList.remove("active2");
}



editBtn.forEach(item => {
    item.onclick = () => {
        let post_id = item.getAttribute('id');

        // console.log(post_id);
        let xhr = new XMLHttpRequest();
        let url = "../php/fetch-edit-post.php?id=" + post_id;

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
                        title.value = datas.title;
                        body.value = datas.body;
                        is_featured.value = datas.is_featured;
                        prev_thumbnail_name.value = datas.post_thumbnail;

                        
                    } catch (error) {
                        console.log(error);
                    }
                    
                    // if (is_featured.value) {
                    //     is_featured.setAttribute('checked', true);
                    // } else {
                    //     is_featured.setAttribute('checked', false);
                    // }

                }
            }
        }
        xhr.send();

    }
});



updateBtn.onclick = () => {

    // let's start Ajax 
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "../php/edit-post-logic.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;

                if (data === "success") {
                    modalEdit.classList.remove("active2");
                    modalInactive.classList.remove("active2");
                    location.href = "../admin/manage-posts.php";
                } else {
                    console.log(data);

                }

            }
        }
    }
    let postData = new FormData(subEditpost); //creating new postData object
    xhr.send(postData);
}





