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