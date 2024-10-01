console.log("Image Gallery Frontend Script");

document.addEventListener('DOMContentLoaded', function() {
    const thumbnails = document.querySelectorAll('.thumbnail img');
    const mainImage = document.querySelector('.img-gallery-main img');

    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
            const newSrc = thumbnail.getAttribute('src');
            const newAlt = thumbnail.getAttribute('alt');
            
            mainImage.setAttribute('src', newSrc);
            mainImage.setAttribute('alt', newAlt);
        });
    });
});
