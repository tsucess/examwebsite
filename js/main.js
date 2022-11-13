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

// CAROUSEL 


let index = 0;

showImage(index); 

function showImage(i){
index += i;
let images = document.querySelectorAll(".carousel_image");


for( i = 0; i < images.length; i++){
        images[i].style.display = "none";

}

if(index > images.length - 1) index = 0;

if(index < 0) index = images.length - 1;

images[index].style.display = "block";
}


let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("carousel_image");
  
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  
  slides[slideIndex-1].style.display = "block";  
  
  setTimeout(showSlides, 2000); // Change image every 2 seconds

}