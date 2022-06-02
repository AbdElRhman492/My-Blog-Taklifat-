$(function () {
    
    'use strict';

    // Hide Placeholder on Form Focus

    $('[placeholder]').focus(function () {
        $(this).attr('data-text', $(this).attr('placeholder'));
        $(this).attr('placeholder', '');

    }).blur(function () {
        $(this).attr('placeholder', $(this).attr('data-text'));
    });

    // Add Asterisk On Required Field
    $('input').each(function () {
        if ($(this).attr('required')) {
            $(this).after('<span class="asterisk" title="This Mean That input is required">*</span>');
        }
    });

    // Convert Password Field To Text Field On Hover

    let passField = $('.password');
    $('.show-pass').hover(function () {
        passField.attr('type', 'text');
    }, function () {
        passField.attr('type', 'password');
    });

});

// ========== NAVBAR ===== // 

/*==================== SHOW NAVBAR ====================*/
const showMenu = (headerToggle, navbarId) =>{
    const toggleBtn = document.getElementById(headerToggle),
    nav = document.getElementById(navbarId)
    
    // Validate that variables exist
    if(headerToggle && navbarId){
        toggleBtn.addEventListener('click', ()=>{
            // We add the show-menu class to the div tag with the nav__menu class
            nav.classList.toggle('show-menu')
            // change icon
            toggleBtn.classList.toggle('bx-x')
        })
    }
}
showMenu('header-toggle','navbar')

/*==================== LINK ACTIVE ====================*/
const linkColor = document.querySelectorAll('.nav__link')

function colorLink(){
    linkColor.forEach(l => l.classList.remove('active'))
    this.classList.add('active')
}

linkColor.forEach(l => l.addEventListener('click', colorLink))


// =============  confirm_MSG  ===============//
$(document).ready(function () {
    $('.click').click(function () {
        $('.popup_box').css({
            "opacity": "1", "pointer-events": "auto"
        });
    });
    $('.cancel_BTN').click(function () {
        $('.popup_box').css({
            "opacity": "0", "pointer-events": "none"
        });
    });
});