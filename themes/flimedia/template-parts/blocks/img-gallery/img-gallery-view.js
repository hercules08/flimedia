console.log("Image Gallery Frontend Script");

document.addEventListener('DOMContentLoaded', function() {
    const thumbnails = document.querySelectorAll('.thumbnail img');
    const mainImage = document.querySelector('.img-gallery-main img');

    if (thumbnails.length > 0) {
        thumbnails[0].classList.add('thumbnail-active');
        const initialSrc = thumbnails[0].getAttribute('src');
        const initialAlt = thumbnails[0].getAttribute('alt');
        mainImage.setAttribute('src', initialSrc);
        mainImage.setAttribute('alt', initialAlt);
    }

    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
            thumbnails.forEach(img => img.classList.remove('thumbnail-active'));
            thumbnail.classList.add('thumbnail-active');
            
            const newSrc = thumbnail.getAttribute('src');
            const newAlt = thumbnail.getAttribute('alt');
            
            mainImage.setAttribute('src', newSrc);
            mainImage.setAttribute('alt', newAlt);
        });
    });
});
