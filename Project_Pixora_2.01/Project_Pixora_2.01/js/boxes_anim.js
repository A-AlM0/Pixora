// Animation boxes vars
const hElements = document.querySelectorAll('.sub_card_info');

// Create an IntersectionObserver for hElements
const observe = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.classList.add('show'); // Add a class when the element is in view
        }
    });
});

hElements.forEach((el) => observe.observe(el));

// Animation boxes vars for hidden images
const hImgs = document.querySelectorAll('.sub_card_img_col.hidden2, .sub_card_img_col.hidden3');

const observe3 = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        console.log(entry);
        if (entry.isIntersecting) {
            entry.target.classList.add('show2', 'show3'); // Add classes when images are visible
        }
    });
});

hImgs.forEach((el) => observe3.observe(el));
