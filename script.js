const header = document.querySelector('header');
function fixedNavbar(){
    header.classList.toggle('scroll',window.pageYOffset > 0)
}
fixedNavbar();
window.addEventListener('scroll', fixedNavbar);

let menu = document.querySelector('#menu-btn');
let userBtn = document.querySelector('#user-btn');

menu.addEventListener('click',function(){
    let nav = document.querySelector('.navber');
    nav.classList.toggle('active');
})
userBtn.addEventListener('click', function(){
    let userBox = document.querySelector('.user-box');
    userBox.classList.toggle('active');
})
/*-------- register -------*/
const inputs = document.querySelectorAll('.nav-input');
    inputs.forEach((input, index) => {
        input.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                const next = inputs[index + 1];
                if (next) next.focus();
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                const prev = inputs[index - 1];
                if (prev) prev.focus();
            }
        });
    });
/*-------- login  -------*/
function selectCaptcha(imgName, element) {
        document.getElementById('selected_img').value = imgName;
        document.querySelectorAll('.captcha-images img').forEach(img => img.classList.remove('selected'));
        element.classList.add('selected');
}
const logininputs = document.querySelectorAll('.nav-input');
inputs.forEach((input, index) => {
    input.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowDown') {
            e.preventDefault();
            const next = inputs[index + 1];
            if (next) next.focus();
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            const prev = inputs[index - 1];
            if (prev) prev.focus();
        }
    });
});
/*-------- home page slider -------*/
"use strict"

// 1. استهداف العناصر بشكل صحيح
const leftArrow = document.querySelector('.left-arrow'),
      rightArrow = document.querySelector('.right-arrow'),
      slider = document.querySelector('.slider');

/*-------- scroll to right -------*/
function scrollRight(){
    // التحقق إذا وصلنا لنهاية السلايدر للعودة للبداية
    if(Math.ceil(slider.scrollWidth - slider.clientWidth) <= Math.ceil(slider.scrollLeft)) {
        slider.scrollTo({
            left: 0,
            behavior: "smooth"
        });
    }
    else {
        slider.scrollBy({
            left: window.innerWidth,
            behavior: "smooth"
        });
    }
}

/*-------- scroll to left -------*/
function scrollLeft(){
    slider.scrollBy({
        left: -window.innerWidth,
        behavior: "smooth"
    });
}

// السكرول التلقائي كل 7 ثواني
let timerId = setInterval(scrollRight, 7000);

function resetTimer(){
    clearInterval(timerId);
    timerId = setInterval(scrollRight, 7000);
}

/*-------- أحداث الضغط (Click Events) -------*/
// دمج الأحداث في مستمع واحد ح
document.addEventListener('click', function(ev){
    if(ev.target.closest('.left-arrow')){
        scrollLeft();
        resetTimer();
    }
    if(ev.target.closest('.right-arrow')){
        scrollRight(); 
        resetTimer();
    }
});
/------- testimonial slider -------/

function nextSlide(){
    // نبحث عن السلايدات داخل الدالة لضمان تحديث القائمة
    let slides = document.querySelectorAll('.testimonial-item'); 
    let activeSlide = document.querySelector('.testimonial-item.active');
    
    // إيجاد رقم السلايد الحالي
    let currentIndex = Array.from(slides).indexOf(activeSlide);
    
    // إزالة كلاس active من الحالي
    slides[currentIndex].classList.remove('active');
    
    // حساب السلايد التالي
    let nextIndex = (currentIndex + 1) % slides.length;
    
    // إضافة كلاس active للتالي
    slides[nextIndex].classList.add('active');
}

function prevSlide(){
    let slides = document.querySelectorAll('.testimonial-item');
    let activeSlide = document.querySelector('.testimonial-item.active');
    
    let currentIndex = Array.from(slides).indexOf(activeSlide);
    
    slides[currentIndex].classList.remove('active');
    
    // حساب السلايد السابق
    let prevIndex = (currentIndex - 1 + slides.length) % slides.length;
    
    slides[prevIndex].classList.add('active');
}

function selectCaptcha(imgName, element) {
    document.getElementById('selected_img').value = imgName;
    document.querySelectorAll('.captcha-images img').forEach(img => img.classList.remove('selected'));
    element.classList.add('selected');
}

