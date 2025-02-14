const menu_items = document.querySelectorAll('.menu__item.menu__item--level-1');

// Default images
let src = {
    1 : '/themes/custom/task1/assets/img/image1.jpg',
    2 : '/themes/custom/task1/assets/img/image2.jpg'
};

menu_items.forEach((item) => {
    const menu_items_hidden = item.querySelectorAll('.menu__item--level-2')
    menu_items_hidden.forEach((item_hidden) => {
        item_hidden.addEventListener('click', (e) => {
            e.preventDefault()
            // Get image container
            const image_container = document.querySelector('.image_body img')
            const key_customer = item_hidden.parentElement.getAttribute('data-customer');
            // Set the image by the attribute 'data-customer'
            image_container.src = src[key_customer]
            image_container.parentElement.classList.remove('hidden')
        })
    })
    
})