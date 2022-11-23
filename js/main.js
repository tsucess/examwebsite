const navItems = document.querySelector(".nav_items");
const openNavBtn = document.querySelector("#open_nav-btn");
const closeNavBtn = document.querySelector("#close_nav-btn");



const openNav = () => {
    navItems.style.display = 'flex';
    openNavBtn.style.display = 'none';
    closeNavBtn.style.display = 'inline-block';
}
const closeNav = () => {
    navItems.style.display = 'none';
    openNavBtn.style.display = 'inline-block';
    closeNavBtn.style.display = 'none';
}

openNavBtn.addEventListener('click', openNav);
closeNavBtn.addEventListener('click', closeNav);


const sidebar = document.querySelector('aside');
const showSidebarBtn = document.querySelector('#show_sidebar_btn');
const hideSidebarBtn = document.querySelector('#hide_sidebar_btn');


const showSidebar = () => {
    sidebar.style.left = '0';
    showSidebarBtn.style.display = 'none';
    hideSidebarBtn.style.display = 'inline-block';
}
const hideSidebar = () => {
    sidebar.style.left = '-100%';
    showSidebarBtn.style.display = 'inline-block';
    hideSidebarBtn.style.display = 'none';
}


showSidebarBtn.addEventListener('click', showSidebar);
hideSidebarBtn.addEventListener('click', hideSidebar);

 // Confrim users delete actions 
 function validate(){
    let result = confirm('Are you sure you want to delete?');
    if (result == false){
        event.preventDefault();
    }
}

// Validation section  
let errorText = document.querySelector(".error-txt");


// cpwd.addEventListener("keyup", ()=>{
//     if(pwd.value !== cpwd.value){
//         errorText.style.display = "block";
//         errorText.textContent = "Error! Confirm Password Not Matched";
//         errorText.classList.remove("matched");
        
//     }else{
//         errorText.classList.add("matched");
//         errorText.style.display = "block";
//         errorText.textContent = "Nice! Confirm Password Matched";

//     }
// });