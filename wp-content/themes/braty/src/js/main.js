


document.addEventListener("DOMContentLoaded", function() {

    var modalSection = document.querySelector('.modal-section');
    var modalBlock = document.querySelector('.modal-block');
    var consultationBlocks = document.querySelectorAll('.consultation-block');
    var openCategory = document.querySelector('.consultation-block');



    consultationBlocks.forEach(function(consultationBlock) {
        var modalBlock2 = consultationBlock.querySelector('.modal-block');
        // Event listener for clicks on each consultation block
        consultationBlock.addEventListener('click', function(event) {
            event.stopPropagation(); // Prevent click propagation to document level
            modalSection.style.display = 'flex'; // Display the modal section
        });

    });

    if (openCategory) {
        openCategory.addEventListener('click', function(event) {
            event.stopPropagation();
            modalSection.style.display = 'flex';
        });
        document.addEventListener('click', function(event) {
        if (!modalBlock.contains(event.target)) {

            modalSection.style.display = 'none';
        }
        });
    }
});




// jQuery(document).ready(function($) {
//     // Event delegation for parent categories
//     $(document).on('click', '.first-level li', function(e) {
//         e.preventDefault();
//         var parentCategoryId = $(this).data('category-id');
//         $('.first-level li a').each(function() {
//             $(this).css('color', '#333333');
//             $(this).css('font-weight', '500');
//         });
//         $(this).find('a').css('color', 'rgb(117, 99, 167)');
//         $(this).find('a').css('font-weight', '800');
//         $.ajax({
//             url: WPJS.ajaxUrl, // WordPress AJAX URL
//             type: 'POST',
//             data: {
//                 action: 'get_child_categories', // AJAX action hook
//                 parent_category_id: parentCategoryId
//             },
//             success: function(response) {
//                 // Replace content of .cpt-second-level container with child categories
//                 $('.second-level').html(response);
//             },
//             error: function(xhr, status, error) {
//                 console.error(error);
//             }
//         });
//     });
// });

jQuery(document).ready(function($) {
    // Event delegation for parent categories
    $(document).on('mouseenter', '.first-level li', function(e) {
        e.preventDefault();
        var parentCategoryId = $(this).data('category-id');
        $('.first-level li a').each(function() {
            $(this).css('color', '#333333');
            $(this).css('font-weight', '500');
        });
        $(this).find('a').css('color', 'rgb(117, 99, 167)');
        $(this).find('a').css('font-weight', '800');
        $('.second-level').html('<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Завантаження...</span></div>');
        $.ajax({
            url: WPJS.ajaxUrl, // WordPress AJAX URL
            type: 'POST',
            data: {
                action: 'get_child_categories', // AJAX action hook
                parent_category_id: parentCategoryId
            },
            success: function(response) {
                // Replace content of .cpt-second-level container with child categories
                $('.second-level').html(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});




// jQuery(document).ready(function($) {
//     function burgerMenu() {
//         const $burger = $('.burger-btn');
//         const $menu = $('.mob-header--menu');
//         const $body = $('body');

//         $burger.click(function() {
//             const $img = $(this).find('img');
//             if ($img.attr('src').includes('burger.svg')) {
//                 $img.attr('src', WPJS.siteUrl + '/img/cross.svg');
//                 $img.css('left', '8px');
//                 $img.attr('alt', 'cross');
//                 $body.addClass('locked');
//             } else {
//                 $img.attr('src', WPJS.siteUrl + '/img/burger.svg');
//                 $img.attr('alt', 'burger');
//                 $img.css('left', '6px');
//                 $body.removeClass('locked');
//             }

//             if (!$menu.hasClass('active')) {
//                 $menu.addClass('active');
//             } else {
//                 $menu.removeClass('active');
//             }
//         });

//         // Setting breakpoint for the navbar
//         $(window).resize(function() {
//             if ($(window).innerWidth() > 991) {
//                 $menu.removeClass('active');
//                 $body.removeClass('locked');
//                 $img = $('.burger-btn img');
//                 $img.attr('src', WPJS.siteUrl + '/img/burger.svg');
//                 $img.attr('alt', 'burger');
//                 $img.css('left', '6px');
//             }
//         });
//     }

//     burgerMenu();
// });



jQuery(document).ready(function($) {
    $('.mob-header--center .first-top .arrow').on('click', function(event) {
        var active = $(this).closest('.first-top').parent().find('.second-level-categories');
        var color = $(this).closest('.first-top').find('.h4');
        active.toggleClass('active');
        color.eq(0).toggleClass('color');
    });
});



//  -------   END OF HEADER ---------




jQuery(document).ready(function($) {
    $('.footer-nav--title').on('click', function() {
        $(this).parent().find('.main-menu--footer').toggleClass('active');
        $(this).toggleClass('opened');
    });

    $('.footer-buyer--title').on('click', function() {
        $(this).parent().find('.main-menu').toggleClass('active');
        $(this).toggleClass('opened');
    });
    $('.footer-partners--title').on('click', function() {
        $(this).parent().find('.main-menu').toggleClass('active');
        $(this).toggleClass('opened');
    });
    $('.footer-cabinet--title').on('click', function() {
        $(this).parent().find('.main-menu').toggleClass('active');
        $(this).toggleClass('opened');
    });
});



/// END of FOOTER


var urlGlobal = window.location.href;

function getUrlPartsBeforeLastSlash(url) {
    // Split the URL by '/'
    var parts = url.split('/');
    
    // Remove the last part
    parts.pop();
    
    // Reconstruct the URL without the last part
    var urlBeforeLastSlash = parts.join('/');
    
    return urlBeforeLastSlash + '/';
}






document.addEventListener("DOMContentLoaded", function() {
    const filterBtn = document.querySelector(".filter-btn");
    const sortBtn = document.querySelector(".sort-btn");
    const widget = document.querySelector(".widget");
    const customOrdering = document.querySelector(".custom-ordering");

    if (filterBtn) {
        filterBtn.addEventListener("click", function() {
            widget.classList.toggle("widget--flex");
        });
    }
    if (sortBtn) {       
        sortBtn.addEventListener("click", function() {
            customOrdering.classList.toggle("custom-ordering--flex");
        });
    }
});



jQuery(document).ready(function($) {
    // Find the pagination links
    var paginationLinks = $('.woocommerce-pagination ul.page-numbers li');

    // Check if pagination links exist and there are more than 2 pages
    if (paginationLinks.length > 2) {
        // Get the URL of the first and last pages
        var firstPageLink = paginationLinks.eq(1).find('a').attr('href');
        
        // Find the second-to-last pagination link
        var secondLastPageLink = paginationLinks.eq(-2).find('a').attr('href');

        // Extract the page number from the current URL
        var currentPageNumber = getCurrentPageNumber(window.location.href);

        var img1 = $('<img/>', {
            src: WPJS.siteUrl + '/img/double-arrow.svg',
            alt: 'double-arrow' 
        });
        var img2 = $('<img/>', {
            src: WPJS.siteUrl + '/img/double-arrow.svg',
            alt: 'double-arrow' 
        });

        // Create anchor tags to paginate to the first and last pages
        var firstPageAnchor = $('<a/>', {
            href: firstPageLink,
        }).append(img1).wrap('<li/>');

        var firstPageListItem = $('<li/>').addClass('first-page-button').append(firstPageAnchor);

        var lastPageAnchor = $('<a/>', {
            href: secondLastPageLink,
        }).append(img2).wrap('<li/>');

        var lastPageListItem = $('<li/>').addClass('last-page-button').append(lastPageAnchor);

        // Insert anchor tags as first and last elements of pagination
        $('.woocommerce-pagination ul.page-numbers').prepend(firstPageListItem);
        $('.woocommerce-pagination ul.page-numbers').append(lastPageListItem);

        // Check if we are on the first page
        if (currentPageNumber === 1) {
            // Hide the "First Page" custom button
            $('.first-page-button').hide();
        }
        // Check if we are on the last page
        if (currentPageNumber == getTotalPages(secondLastPageLink) + 1) {
            // Hide the "Last Page" custom button
            $('.last-page-button').hide();
        }
    }
});



// Function to extract the page number from the URL
function getCurrentPageNumber(url) {
    var match = url.match(/\/page\/(\d+)\//);
    return match ? parseInt(match[1]) : 1;
}

// Function to extract the total number of pages from the last page URL
function getTotalPages(lastPageUrl) {
    var match = lastPageUrl.match(/\/page\/(\d+)\//);
    return match ? parseInt(match[1]) : 1;
}

document.addEventListener("DOMContentLoaded", function() {
    var lists = document.querySelectorAll('.wpc-filters-ul-list');

    lists.forEach(function(list) {
        var items = list.querySelectorAll('li');
        var maxVisibleItems = 4;

        // Hide items exceeding maxVisibleItems
        for (var i = maxVisibleItems; i < items.length; i++) {
            items[i].style.display = 'none';
        }

        // If there are more items than maxVisibleItems, add the "Show More" button
        if (items.length > maxVisibleItems) {
            var button = document.createElement('button');
            button.classList.add('show-more');
            list.after(button); // Append button after the list

            // Function to get the language from the URL
            function getLanguageFromUrl() {
                var url = window.location.href;
                return (url.includes('/ru/')) ? 'ru' : 'default'; // Change 'default' to the default language code
            }

            // Set initial button text based on language
            button.textContent = (getLanguageFromUrl() === 'ru') ? 'Показать еще' : 'ПОКАЗАТИ ЩЕ';

            // Add event listener to the button
            button.addEventListener('click', function() {
                // Toggle visibility of items exceeding maxVisibleItems
                for (var i = maxVisibleItems; i < items.length; i++) {
                    items[i].style.display = (items[i].style.display === 'none') ? 'block' : 'none';
                }

                // Change button text based on language
                button.textContent = (button.textContent === 'ПОКАЗАТИ ЩЕ') ? (getLanguageFromUrl() === 'ru' ? 'Скрыть' : 'СХОВАТИ') : (getLanguageFromUrl() === 'ru' ? 'Показать еще' : 'ПОКАЗАТИ ЩЕ');
            });
        }
    });
});

jQuery(function($) {
    $('.delete-all').click(function(e) {
        e.preventDefault();

        removeAllCartItems();
        
    });

    function removeAllCartItems() {
        var data = {
            action: 'remove_all_cart_items'
        };

        $.post(WPJS.ajaxUrl, data, function(response) {
            // Reload the page or update the cart widget
            location.reload();
        });
    }
});
jQuery(function($) {
    $('.remove-product').click(function(e) {
        e.preventDefault();
        
        var cart_key = $(this).data('cart-key');
        var data = {
            action: 'remove_cart_item',
            cart_key: cart_key
        };

        $.post(WPJS.ajaxUrl, data, function(response) {
            location.reload();
        });
    });
});

jQuery(function($) {
    $('.quantity-minus').click(function(e) {
        e.preventDefault();
        
        var cart_key = $(this).data('cart-key');
        var input = $('input[name="quantity[' + cart_key + ']"]');
        var currentValue = parseInt(input.val());
        var newValue = currentValue - 1;
        
        if (newValue >= 1) {
            input.val(newValue);
            updateCartItemQuantity(cart_key, newValue);
        }
    });

    $('.quantity-plus').click(function(e) {
        e.preventDefault();
        
        var cart_key = $(this).data('cart-key');
        var input = $('input[name="quantity[' + cart_key + ']"]');
        var currentValue = parseInt(input.val());
        var newValue = currentValue + 1;

        input.val(newValue);
        updateCartItemQuantity(cart_key, newValue);
    });

    $('.quantity-input').on('keypress', function(e) {
        if (e.which === 13) {
            e.preventDefault();
            
            var cart_key = $(this).attr('name').match(/\[(.*?)\]/)[1];
            var newValue = parseInt($(this).val());

            if (!isNaN(newValue) && newValue >= 1) {
                updateCartItemQuantity(cart_key, newValue);
            } else {
                // Reset the input value to the previous value
                var previousValue = parseInt($(this).data('previous-value'));
                $(this).val(previousValue);
            }
        }
    });

    function updateCartItemQuantity(cart_key, new_quantity) {
        var data = {
            action: 'update_cart_item_quantity',
            cart_key: cart_key,
            new_quantity: new_quantity
        };

        $.post(WPJS.ajaxUrl, data, function(response) {
            // Reload the page or update the cart widget
            location.reload();
        });
    }
});


document.addEventListener('DOMContentLoaded', function() {
    // Find the back button element
    var backButton = document.querySelector('.card-back--btn');
    if (backButton) {
        // Add click event listener
        backButton.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior

            // Navigate back to the previous page
            window.history.back();
        });
    }
});



//// CHECKOUT

jQuery(document).ready(function($) {
    // Event handler for radio button change
    $('input[name="delivery_method"]').change(function() {
        if ($('#delivery').is(':checked')) {
            $('#delivery_fields').addClass('flex');
        } else {
            $('#delivery_fields').removeClass('flex');
        }
    });

    // Event handler for form submission
    $('#submit_btn').click(function() {
        // Validate form fields
        var isValid = validateForm();

        // If form is valid, submit via AJAX
        if (isValid) {
            var formData = $('#custom_checkout_form').serialize(); // Serialize form data
            var deliveryMethod = $('input[name="delivery_method"]:checked').val();
            formData += '&delivery_method=' + deliveryMethod;

            $.ajax({
                type: 'POST',
                url: WPJS.ajaxUrl,
                data: {
                    action: 'custom_checkout_submit', // Specify the action
                    formData: formData // Pass serialized form data
                },
                success: function(response) {
                    if (response.success) {
                        // Clear form fields
                        $('#custom_checkout_form')[0].reset();

                        // Redirect to thank you page
                        window.location.href = WPJS.homeUrl + '/thank-you';
                    } else {
                        // Display validation errors
                        if (response.data && response.data.length > 0) {
                            $.each(response.data, function(key, val) {
                                $('.form_' + key).addClass('error').after('<div class="notification notification_warning notification_warning_' + key + '">Пусто</div>');
                            });
                        } else {
                            alert('Error submitting order!');
                        }
                    }
                }
            });
        }
    });

    // Function to validate form fields
    function validateForm() {
        var isValid = true;

        // Clear previous error messages
        $('.notification').remove();
        $('.form-control').removeClass('error');

        // Validate each field
        $('#custom_checkout_form input[type="text"], #custom_checkout_form input[type="email"], #custom_checkout_form textarea').each(function() {
            if ($(this).prop('required') && $(this).val().trim() === '') {
                isValid = false;
                // Highlight the field
                $(this).addClass('error');
                // Append error message
                $(this).after('<div class="notification notification_warning">Пусто</div>');
            }
        });


        return isValid;
    }
});


if (document.getElementById('glb-container') && WPJS.glb_file) {

    function init() {
        scene = new THREE.Scene();
        scene.background = new THREE.Color(0xdddddd);

        // Adjusting camera position
        camera = new THREE.PerspectiveCamera(40, window.innerWidth / window.innerHeight, 1, 5000);
        camera.position.set(0, 0, 800); // Adjust the Z position to center the model

        renderer = new THREE.WebGLRenderer({ antialias: true });
        renderer.setSize(window.innerWidth, window.innerHeight);
        document.getElementById('glb-container').appendChild(renderer.domElement);

        controls = new THREE.OrbitControls(camera, renderer.domElement);
        controls.addEventListener('change', render);

        hlight = new THREE.AmbientLight(0x404040, 0.5); // Reduce ambient light intensity
        scene.add(hlight);

        directionalLight = new THREE.DirectionalLight(0xffffff, 40); // Reduce directional light intensity
        directionalLight.position.set(0, 1, 0);
        directionalLight.castShadow = true;
        scene.add(directionalLight);

        light = new THREE.PointLight(0xc4c4c4, 2); // Reduce point light intensity
        light.position.set(0, 300, 500);
        scene.add(light);

        light2 = new THREE.PointLight(0xc4c4c4, 2); // Reduce point light intensity
        light2.position.set(500, 100, 0);
        scene.add(light2);

        light3 = new THREE.PointLight(0xc4c4c4, 2); // Reduce point light intensity
        light3.position.set(0, 100, -500);
        scene.add(light3);

        light4 = new THREE.PointLight(0xc4c4c4, 2); // Reduce point light intensity
        light4.position.set(-500, 300, 500);
        scene.add(light4);

        let loader = new THREE.GLTFLoader();
        loader.load(WPJS.glb_file.url, function (gltf) {
            car = gltf.scene.children[0];
            // Decrease model scale slightly
            car.scale.set(5, 5, 5); // Adjust these values to scale the model up or down as needed
            scene.add(gltf.scene);
            animate();
        });
    }

    function animate() {
        renderer.render(scene, camera);
        requestAnimationFrame(animate);
        updateLightPosition();
    }

    function render() {
        renderer.render(scene, camera);
    }

    function updateLightPosition() {
        // Only update light positions if they're not at the center of the scene
        if (!controls.target.equals(camera.position)) {
            light.position.copy(camera.position);
            light2.position.copy(camera.position);
            light3.position.copy(camera.position);
            light4.position.copy(camera.position);
        }
    }

    init();

    // Adjust the light intensity to make the model less white
    // Note: You may want to adjust these values further based on your scene's needs
    light.intensity = 0.2;
    light2.intensity = 0.2;
    light3.intensity = 0.2;
    light4.intensity = 0.2;
}




  ////  SINGLE

  document.addEventListener("DOMContentLoaded", function() {
    // Get modal section and modal block elements
    var modalSection = document.querySelector('.modal-section--product');
    var modalBlock = document.querySelector('.modal-block--product');
    var openCategory = document.querySelector('.catalog-link');
  
    // Event listener for clicks outside of modal block
    if (openCategory) {
        openCategory.addEventListener('click', function(event) {
            event.stopPropagation();
            modalSection.style.display = 'flex';
        });
        document.addEventListener('click', function(event) {
        // Check if the click target is outside of modal block
        if (!modalBlock.contains(event.target)) {
            // Hide the modal section
            modalSection.style.display = 'none';
        }
        });
    }
});

document.addEventListener("DOMContentLoaded", function() {
    // Get modal section and modal block elements
    var modalSection = document.querySelector('.modal-section--3d');
    var modalBlock = document.querySelector('.modal-block--3d');
    var openCategory = document.querySelector('.no-3dmodel');
  
    // Event listener for clicks outside of modal block
    if (openCategory) {
        openCategory.addEventListener('click', function(event) {
            event.stopPropagation();
            modalSection.style.display = 'flex';
        });
        document.addEventListener('click', function(event) {
        // Check if the click target is outside of modal block
        if (!modalBlock.contains(event.target)) {
            // Hide the modal section
            modalSection.style.display = 'none';
        }
        });
    }
});

document.addEventListener("DOMContentLoaded", function() {
    // Get modal section and modal block elements
    var modalSection = document.querySelector('.modal-section--no-stock');
    var modalBlock = document.querySelector('.modal-block--no-stock');
    var openCategory = document.querySelector('.buy-no-stock-product');
  
    // Event listener for clicks outside of modal block
    if (openCategory) {
        openCategory.addEventListener('click', function(event) {
            event.stopPropagation();
            modalSection.style.display = 'flex';
        });
        document.addEventListener('click', function(event) {
        // Check if the click target is outside of modal block
        if (!modalBlock.contains(event.target)) {
            // Hide the modal section
            modalSection.style.display = 'none';
        }
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    var textarea = document.querySelector('textarea[name="your-message2"]'); // Replace 'your-textarea-field-name' with the name attribute of your textarea field
    if (textarea) {
        textarea.value = 'Запит на каталог товару ' + WPJS.prd_name + ' '; // Replace this text with your desired starting text
    }
});

document.addEventListener('DOMContentLoaded', function() {
    var textarea = document.querySelector('textarea[name="your-message3"]'); 
    if (textarea) {
        textarea.value = 'Запит на 3D модель товару ' + WPJS.prd_name + ' '; 
    }
});

document.addEventListener('DOMContentLoaded', function() {
    var textarea = document.querySelector('textarea[name="your-message4"]'); 
    if (textarea) {
        textarea.value = WPJS.prd_name + ' '; 
    }
});

document.addEventListener('DOMContentLoaded', function() {
    var swiperCat = new Swiper('.swiper-container--cat', {
        slidesPerView: 6,
        spaceBetween: 12,
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            320: {
                slidesPerView: 2,
                spaceBetween: 6
            },
            640: {
                slidesPerView: 3,
                spaceBetween: 8
            },
            768: {
                slidesPerView: 4,
                spaceBetween: 10
            },
            991: {
                slidesPerView: 6,
                spaceBetween: 12
            }
        }
    });
});


jQuery(document).ready(function($) {
    $('.no-opt-button').click(function() {
        $('.dealer-table').toggleClass('table-active');
        $(this).find('img').toggleClass('rotate-img');
    });
});


var swiper = new Swiper('.swiper-anchor', {
    loop: true,
    breakpoints: {
        320: {
            slidesPerView: 1,
            spaceBetween: 15
        },
        640: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 3,
        },
        991: {
            slidesPerView: 4,
        },
        1150: {
            slidesPerView: 5,
            spaceBetween: 17
        },
        1400: {
            slidesPerView: 6,
            spaceBetween: 15
        }
    }
  });

  var swiper = new Swiper('.swiper-connected', {
    loop: true,
    pagination: {
        el: '.connected__pagination',
        clickable: true,
    },
    breakpoints: {
        320: {
            slidesPerView: 1
        },
        480: {
            slidesPerView: 2,
            spaceBetween: 5
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 15
        },
        991: {
            slidesPerView: 4,
            spaceBetween: 21
        },
    }
    
  });

  var swiper = new Swiper('.swiper-similar', {
    loop: true,
    pagination: {
        el: '.similar__pagination',
        clickable: true,
    },
    breakpoints: {
        320: {
            slidesPerView: 1
        },
        480: {
            slidesPerView: 2,
            spaceBetween: 5
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 15
        },
        991: {
            slidesPerView: 4,
            spaceBetween: 21
        },
    }
    
  });
  var swiper = new Swiper('.swiper-menu-category', {
    loop: true,
    slidesPerView: 'auto',
  });

  

  document.addEventListener("DOMContentLoaded", function() {
    var button = document.querySelector('.more-details');
    var fullDescription = document.querySelector('.full-desc-section .col-md-8 .full-desc');
    if (button && fullDescription) {
        button.addEventListener('click', function() {
            fullDescription.style.height = 'auto';
            button.style.display = 'none';
        });
    }
});

jQuery(document).ready(function($) {
    $('.onsale').each(function() {
        var shortestTag = $(this).parent().parent().find('.shortest-tag');
        if (shortestTag.length) {
            $(this).css('top', '65px');
        } else {
            $(this).css('top', '22px');
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Function to update heights of <li> elements
    function updateLiHeights() {
        // Get all swiper slides
        var swiperSlides = document.querySelectorAll('.swiper-connected .swiper-slide');

        // Reset <li> heights to auto to recalculate
        swiperSlides.forEach(function (slide) {
            var liElements = slide.querySelectorAll('li');
            liElements.forEach(function (li) {
                li.style.height = 'auto';
            });
        });

        // Find the tallest li height within the swiper slides
        var tallestHeights = [];
        swiperSlides.forEach(function (slide) {
            var liElements = slide.querySelectorAll('li');
            liElements.forEach(function (li, index) {
                var liHeight = li.offsetHeight;
                tallestHeights[index] = Math.max(tallestHeights[index] || 0, liHeight);
            });
        });

        // Set the same height for all li elements
        swiperSlides.forEach(function (slide) {
            var liElements = slide.querySelectorAll('li');
            liElements.forEach(function (li, index) {
                li.style.height = tallestHeights[index] + 'px';
            });
        });
    }

    // Initial update of <li> heights
    updateLiHeights();

    // Update <li> heights when window is resized
    window.addEventListener('resize', updateLiHeights);
});

document.addEventListener('DOMContentLoaded', function () {
    // Function to update heights of <li> elements
    function updateLiHeights() {
        // Get all swiper slides
        var swiperSlides = document.querySelectorAll('.swiper-similar .swiper-slide');

        // Reset <li> heights to auto to recalculate
        swiperSlides.forEach(function (slide) {
            var liElements = slide.querySelectorAll('li');
            liElements.forEach(function (li) {
                li.style.height = 'auto';
            });
        });

        // Find the tallest li height within the swiper slides
        var tallestHeights = [];
        swiperSlides.forEach(function (slide) {
            var liElements = slide.querySelectorAll('li');
            liElements.forEach(function (li, index) {
                var liHeight = li.offsetHeight;
                tallestHeights[index] = Math.max(tallestHeights[index] || 0, liHeight);
            });
        });

        // Set the same height for all li elements
        swiperSlides.forEach(function (slide) {
            var liElements = slide.querySelectorAll('li');
            liElements.forEach(function (li, index) {
                li.style.height = tallestHeights[index] + 'px';
            });
        });
    }

    // Initial update of <li> heights
    updateLiHeights();

    // Update <li> heights when window is resized
    window.addEventListener('resize', updateLiHeights);
});

document.addEventListener('DOMContentLoaded', function () {
    // Function to update heights of <li> elements
    function updateLiHeights() {
        // Get all swiper slides
        var swiperSlides = document.querySelectorAll('.swiper-bought .swiper-slide');

        // Reset <li> heights to auto to recalculate
        swiperSlides.forEach(function (slide) {
            var liElements = slide.querySelectorAll('li');
            liElements.forEach(function (li) {
                li.style.height = 'auto';
            });
        });

        // Find the tallest li height within the swiper slides
        var tallestHeights = [];
        swiperSlides.forEach(function (slide) {
            var liElements = slide.querySelectorAll('li');
            liElements.forEach(function (li, index) {
                var liHeight = li.offsetHeight;
                tallestHeights[index] = Math.max(tallestHeights[index] || 0, liHeight);
            });
        });

        // Set the same height for all li elements
        swiperSlides.forEach(function (slide) {
            var liElements = slide.querySelectorAll('li');
            liElements.forEach(function (li, index) {
                li.style.height = tallestHeights[index] + 'px';
            });
        });
    }

    // Initial update of <li> heights
    updateLiHeights();

    // Update <li> heights when window is resized
    window.addEventListener('resize', updateLiHeights);
});

document.addEventListener('DOMContentLoaded', function () {
    // Function to update heights of <li> elements
    function updateLiHeights() {
        // Get all swiper slides
        var swiperSlides = document.querySelectorAll('.swiper-newest .swiper-slide ');

        // Reset <li> heights to auto to recalculate
        swiperSlides.forEach(function (slide) {
            var liElements = slide.querySelectorAll('li');
            liElements.forEach(function (li) {
                li.style.height = 'auto';
            });
        });

        // Find the tallest li height within the swiper slides
        var tallestHeights = [];
        swiperSlides.forEach(function (slide) {
            var liElements = slide.querySelectorAll('li');
            liElements.forEach(function (li, index) {
                var liHeight = li.offsetHeight;
                tallestHeights[index] = Math.max(tallestHeights[index] || 0, liHeight);
            });
        });

        // Set the same height for all li elements
        swiperSlides.forEach(function (slide) {
            var liElements = slide.querySelectorAll('li');
            liElements.forEach(function (li, index) {
                li.style.height = tallestHeights[index] + 'px';
            });
        });
    }


    // Initial update of <li> heights
    updateLiHeights();

    // Update <li> heights when window is resized
    window.addEventListener('resize', updateLiHeights);
});

  
  const hero__slider = new Swiper('.hero__slider', {
      slidesPerView: 1,
      spaceBetween: 100,
      speed: 300,
      pagination: {
        el: '.hero-pagination',
        clickable: true,
      },
  });
  
  const popular__slider = new Swiper('.popular__slider', {
    slidesPerView: 4,
    spaceBetween: 20,
    autoHeight: true,
    speed: 300,
    pagination: {
      el: '.popular-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.popular-btn__next',
      prevEl: '.popular-btn__prev',
    },
    breakpoints: {
      // when window width is >= 320px
      320: {
        slidesPerView: 1,
        spaceBetween: 20
      },
      // when window width is >= 480px
      480: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 3,
      },
      992: {
        slidesPerView: 4,
      },
    }
  });

  
  const reviews__slider = new Swiper('.reviews__slider', {
    slidesPerView: 3,
    spaceBetween: 14,
    autoHeight: true,
    speed: 300,
    pagination: {
      el: '.reviews-pagination',
      clickable: true,
    },
    breakpoints: {
      // when window width is >= 320px
      320: {
        slidesPerView: 1,
      },
      // when window width is >= 768px
      768: {
        slidesPerView: 2,
      },
      992: {
        slidesPerView: 3,
      },
    }
  });

  document.addEventListener('DOMContentLoaded', function() {
    var productList = document.querySelectorAll('.search-products li');
    var showMoreButton = document.getElementById('show-more-btn');
    var visibleProducts = 8;
    if (showMoreButton) {
    // Initially hide all products beyond the visibleProducts limit
    for (var i = visibleProducts; i < productList.length; i++) {
        productList[i].style.display = 'none';
    }

    showMoreButton.addEventListener('click', function() {
        // Show all hidden products
        for (var i = visibleProducts; i < productList.length; i++) {
            productList[i].style.display = 'block';
        }
        showMoreButton.style.display = 'none'; // Hide the button after showing all products
    });
}
});


  var swiper = new Swiper('.swiper-newest', {
    loop: true,
    pagination: {
        el: '.newest__pagination',
        clickable: true,
    },
    breakpoints: {
        320: {
            slidesPerView: 1
        },
        480: {
            slidesPerView: 2,
            spaceBetween: 5
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 15
        },
        991: {
            slidesPerView: 4,
            spaceBetween: 21
        },
    }
    
  });
  var swiper = new Swiper('.swiper-popular', {
    loop: true,

    breakpoints: {
        320: {
            slidesPerView: 1
        },
        480: {
            slidesPerView: 2,
            spaceBetween: 5
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 15
        },
        991: {
            slidesPerView: 4,
            spaceBetween: 21
        },
    }
    
  });

  document.addEventListener("DOMContentLoaded", function() {
    var button = document.querySelector('.about-hero__text-more');
    var fullDescription = document.querySelector('.about-hero__text');
    if (button && fullDescription) {
        button.addEventListener('click', function() {
            fullDescription.style.height = 'auto';
            button.style.display = 'none';
        });
    }
});

jQuery(document).ready(function($) {
    // Attach click event to download links
    $('.download-link').on('click', function(e) {
        // Prevent default link behavior
        e.preventDefault();
        
        // Get the file URL
        var fileUrl = $(this).attr('href');
        
        // Create an anchor element with download attribute
        var link = document.createElement('a');
        link.href = fileUrl;
        link.download = '';
        
        // Append the anchor element to the body
        document.body.appendChild(link);
        
        // Trigger the click event on the anchor element
        link.click();
        
        // Remove the anchor element
        document.body.removeChild(link);
    });
});


document.addEventListener("DOMContentLoaded", function() {
    const stars = document.querySelectorAll('.star');
    const chosenRating = document.getElementById('chosen-rating');

    stars.forEach(function(star) {
        star.addEventListener('click', function() {
            const rating = this.dataset.rating;
            document.getElementById('custom-rating').value = rating;
            chosenRating.textContent = rating;
            stars.forEach(function(innerStar) {
                if (innerStar.dataset.rating <= rating) {
                    innerStar.classList.add('active');
                } else {
                    innerStar.classList.remove('active');
                }
            });
        });
    });
});

var swiper = new Swiper('.reviews-slider', {
    slidesPerView: 3,
    spaceBetween: 30,

    pagination: {
        el: '.reviews-slider__pagination',
        clickable: true,
    },
    breakpoints: {
        320: {
            slidesPerView: 1
        },
        480: {
            slidesPerView: 2,
            spaceBetween: 15
        },
        991: {
            slidesPerView: 3,
            spaceBetween: 30
        },
    }
});
  




var swiper = new Swiper('.swiper-comment', {
    slidesPerView: 3,
    spaceBetween: 30,
    loop: true,
    pagination: {
        el: '.comment__pagination',
        clickable: true,
    },
    breakpoints: {
        320: {
            slidesPerView: 1
        },
        580: {
            slidesPerView: 2,
            spaceBetween: 15
        },
        991: {
            slidesPerView: 3,
            spaceBetween: 30
        },
    }
});


document.addEventListener("DOMContentLoaded", function() {
    var showMoreBtns = document.querySelectorAll('.show-more-btn');

    showMoreBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            var commentContainer = this.parentNode.querySelector('.comment-overflow');
            if (commentContainer.style.display === 'none' || commentContainer.style.display === '') {
                commentContainer.style.display = 'inline';
                this.style.display = 'none';
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var showMoreBtns = document.querySelectorAll('.show-more-btn-action');

    showMoreBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            var commentContainer = this.parentNode.querySelector('.description-overflow');
            if (commentContainer.style.display === 'none' || commentContainer.style.display === '') {
                commentContainer.style.display = 'inline';
                this.style.display = 'none';
            }
        });
    });
});



document.addEventListener("DOMContentLoaded", function() {
    var showReviewFormButton = document.getElementById("show-review-form");
    var reviewForm = document.getElementById("custom-review-form");

    if (showReviewFormButton) {
        showReviewFormButton.addEventListener("click", function() {
            showReviewFormButton.parentNode.style.display = 'none'; 
            reviewForm.style.display = 'flex'; 
        });
    }
});


document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('#rating-stars .star');
    const ratingInput = document.getElementById('custom-rating');
    const chosenRating = document.getElementById('chosen-rating');
    
    stars.forEach(star => {
        star.addEventListener('click', function() {
            const rating = this.getAttribute('data-rating');
            ratingInput.value = rating;
            chosenRating.textContent = rating;
            
            stars.forEach(s => {
                if (s.getAttribute('data-rating') <= rating) {
                    s.classList.add('selected');
                } else {
                    s.classList.remove('selected');
                }
            });
        });

        star.addEventListener('mouseover', function() {
            const rating = this.getAttribute('data-rating');
            stars.forEach(s => {
                if (s.getAttribute('data-rating') <= rating) {
                    s.classList.add('selected');
                } else {
                    s.classList.remove('selected');
                }
            });
        });

        star.addEventListener('mouseout', function() {
            const rating = ratingInput.value;
            stars.forEach(s => {
                if (s.getAttribute('data-rating') <= rating) {
                    s.classList.add('selected');
                } else {
                    s.classList.remove('selected');
                }
            });
        });
    });
});


document.addEventListener('DOMContentLoaded', function () {
    new Swiper('.swiper-menu-category', {
        navigation: {
            nextEl: '.swiper-menu-next',
            prevEl: '.swiper-menu-prev',
        },
        slidesPerView: 'auto',
        spaceBetween: 24,
        loop: true
    });
});

document.addEventListener('DOMContentLoaded', function () {
    new Swiper('.swiper-newest', {
        navigation: {
            nextEl: '.swiper-newest-next',
            prevEl: '.swiper-newest-prev',
        },
        slidesPerView: 'auto',
        spaceBetween: 20,
        loop: true
    });
});


document.addEventListener('DOMContentLoaded', function () {
    new Swiper('.swiper-popular', {
        navigation: {
            nextEl: '.swiper-popular-next',
            prevEl: '.swiper-popular-prev',
        },
        slidesPerView: 'auto',
        spaceBetween: 20,
        loop: true
    });
});



document.addEventListener('DOMContentLoaded', function () {
    new Swiper('.swiper-similar', {
        navigation: {
            nextEl: '.swiper-similar-next',
            prevEl: '.swiper-similar-prev',
        },
        slidesPerView: 'auto',
        spaceBetween: 20,
        loop: true
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper('#productImageSlider', {
        spaceBetween: 21,
        loop: true,
        pagination: {
            el: '.single-product-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-single-product-next',
            prevEl: '.swiper-single-product-prev',
        },
        breakpoints: {
            360: {
                slidesPerView: 2,
            },
            576: {
                slidesPerView: 3,
            },
        },
        observer: true,
        observeParents: true,
    });
});

document.addEventListener('DOMContentLoaded', function () {
    new Swiper('.swiper-category', {
            spaceBetween: 30,
            loop: true,
            navigation: {
                nextEl: '.swiper-category-next',
                prevEl: '.swiper-category-prev',
            }
    });
});


// Get the button
var mybutton = document.getElementById("scrollToTopBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "flex";
    } else {
        mybutton.style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
mybutton.onclick = function() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}



document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper('.swiper-caterogy-page', {
        loop: true,
        navigation: {
            nextEl: '.swiper-category-page-next',
            prevEl: '.swiper-category-page-prev',
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 10
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 21
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 20
            },
            1200: {
                slidesPerView: 4,
                spaceBetween: 21
            }
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper('.swiper-add-to-order-single', {
        loop: true,
        navigation: {
            nextEl: '.swiper-add-to-order-single-next',
            prevEl: '.swiper-add-to-order-single-prev',
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 10
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 21
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 20
            },
            1200: {
                slidesPerView: 3,
                spaceBetween: 21
            }
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const mobileSwiper = new Swiper('.swiper-category-mobile-page', {
        loop: true,
        navigation: {
            nextEl: '.swiper-category-product-next',
            prevEl: '.swiper-category-product-prev',
        },
        spaceBetween: 26,
        breakpoints: {
            768: {
                slidesPerView: 2,
            },
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const mobileSwiper = new Swiper('.swiper-subcategory-mobile-page', {
        loop: true,
        navigation: {
            nextEl: '.swiper-subcategory-product-next',
            prevEl: '.swiper-subcategory-product-prev',
        },
        spaceBetween: 26,
        breakpoints: {
            768: {
                slidesPerView: 2,
            },
        }
    });
});

//removing the product from the cart
jQuery(document).ready(function($) {
    $('.delete-item--block').on('click', '.remove-product', function(e) {
        e.preventDefault();

        var cartKey = $(this).data('cart-key');

        $.ajax({
            url: wc_add_to_cart_params.ajax_url, 
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'remove_product_from_cart',
                cart_key: cartKey
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('Помилка вилучення товару з кошика.');
            }
        });
    });
});

jQuery(document).ready(function($) {
    // Initialize lightGallery on product image gallery
    var $productGallery = $('#productMainImage .gallery');
    lightGallery($productGallery[0]);
});

//handling the comment form
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('#rating-stars .star');
    const ratingInput = document.getElementById('custom-rating');
    const saveInfoCheckbox = document.getElementById('save-info');
    const nameInput = document.getElementById('custom-name');
    const phoneInput = document.getElementById('custom-phone');

    if (localStorage.getItem('saveInfo') === 'yes') {
        saveInfoCheckbox.checked = true;
        nameInput.value = localStorage.getItem('custom_name') || '';
        phoneInput.value = localStorage.getItem('custom_phone') || '';
    }

    stars.forEach(star => {
        star.addEventListener('click', function() {
            const rating = this.getAttribute('data-rating');
            ratingInput.value = rating;

            stars.forEach(s => {
                s.classList.remove('selected');
                if (s.getAttribute('data-rating') <= rating) {
                    s.classList.add('selected');
                }
            });
        });
    });
    saveInfoCheckbox.addEventListener('change', function() {
        if (this.checked) {
            localStorage.setItem('saveInfo', 'yes');
            localStorage.setItem('custom_name', nameInput.value);
            localStorage.setItem('custom_phone', phoneInput.value);
        } else {
            localStorage.removeItem('saveInfo');
            localStorage.removeItem('custom_name');
            localStorage.removeItem('custom_phone');
        }
    });

    nameInput.addEventListener('input', function() {
        if (saveInfoCheckbox.checked) {
            localStorage.setItem('custom_name', this.value);
        }
    });

    phoneInput.addEventListener('input', function() {
        if (saveInfoCheckbox.checked) {
            localStorage.setItem('custom_phone', this.value);
        }
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const errorMessages = document.querySelectorAll('.woocommerce-error li');
    if (errorMessages.length > 0) {
        const inputFields = document.querySelectorAll('.woocommerce input');
        inputFields.forEach(function (input) {
            input.classList.add('error');
            const label = document.querySelector(`label[for="${input.id}"]`);
            if (label) {
                label.classList.add('error');
            }
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.quantity-button').forEach(function(button) {
        button.addEventListener('click', function() {
            var input = this.closest('.quantity').querySelector('input.qty');
            var value = parseInt(input.value);
            if (this.classList.contains('quantity-minus')) {
                if (value > 1) value--;
            } else {
                value++;
            }
            input.value = value;
            input.dispatchEvent(new Event('change'));
        });
    });
});
document.addEventListener('DOMContentLoaded', function() {
    var quantityInput = document.querySelector('.quantity input[type="number"]');
    
    if (quantityInput) {
        quantityInput.type = 'text';
    }
});

jQuery(document).ready(function($){
    $('.variations_form select').each(function(){
        var select = $(this);
        var options = select.find('option');
        var attribute_name = select.attr('id').replace('attribute_', '');

        var html = '';
        options.each(function(){
            var option = $(this);
            if (option.val() !== '') {
                html += '<label><input type="radio" name="'+attribute_name+'" value="'+option.val()+'" /> '+option.text()+'</label>';
            }
        });

        select.after('<div class="custom-radio-buttons">' + html + '</div>');
        select.hide();
    });

    $(document).on('change', '.custom-radio-buttons input', function(){
        var input = $(this);
        var select = input.closest('td').find('select');
        select.val(input.val()).change();
    });
});


//output allergens
document.addEventListener('DOMContentLoaded', function() {
    var allergensToggle = document.querySelector('.product-allergens-toggle');
    var allergensContent = document.querySelector('.product-allergens-content');

    if (allergensToggle && allergensContent) {
        allergensToggle.addEventListener('click', function() {
            allergensContent.style.display = allergensContent.style.display === 'none' ? 'block' : 'none';
        });
    }
});



// jQuery(document).ready(function($) {
//     $('.quantity-buttons').on('click', '.quantity-minus, .quantity-plus', function(e) {
//         e.preventDefault();

//         var $button = $(this);
//         var cartKey = $button.data('cart-key');
//         var $input = $button.siblings('.quantity-input');
//         var currentVal = parseInt($input.val());
//         var newVal;

//         if ($button.hasClass('quantity-minus')) {
//             newVal = currentVal > 1 ? currentVal - 0 : 1;
//         } else {
//             newVal = currentVal + 0;
//         }

//         $input.val(newVal);

//         $.ajax({
//             url: wc_add_to_cart_params.ajax_url,
//             type: 'POST',
//             dataType: 'json',
//             data: {
//                 action: 'update_cart_quantity',
//                 cart_key: cartKey,
//                 quantity: newVal
//             },
//             success: function(response) {
//                 if (response.success) {
//                     // Перезавантаження сторінки після успішного оновлення
//                     location.reload();
//                 } else {
//                     alert(response.message);
//                 }
//             },
//         });
//     });
// });

