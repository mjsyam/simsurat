// -- Noty Themes --
Noty.overrideDefaults({
    layout: 'topRight',
    theme: 'sunset',
    closeWith: ['click']
});

// -- Global JS --
$(document).ready(function () {

// -- constiable JS --
    const btnTop = document.getElementById('btnTop');
    const content = document.getElementById('content');

// -- Collapse sidebar --
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar, #content, .overlay').toggleClass('active');

        $('.overlay.active').on('click', function (e) {
            $('#sidebar, #content, .overlay').removeClass('active');
        });
    });

// disable button on submit form 
    $('.form-simpan').submit(function(){
        $(this).find('.btn-simpan').prop('disabled', true);
    });
    
// -- Button Delete data  --
    $('.delete-data').click(function () {
        const url = $(this).attr('data-url');
        const nama = $(this).attr('data-name');
        $("#modalHapusData").find(".modal-body").html("Apakah anda ingin menghapus data ini ? <br><b>" + nama + "</b>");
        $("#deleteDataForm").attr("action", url);
    });

// -- Button Delete document  --
$('.delete-document').click(function () {
    const url = $(this).attr('data-url');
    const nama = $(this).attr('data-name');
    $("#modalHapusData").find(".modal-body").html("Apakah anda ingin menghapus dokumen ini ? <br><b>" + nama + "</b>");
    $("#deleteDocumentForm").attr("action", url);
});

// -- Button Show Password  --
    $('#showPassword').click(function () {
        const button = document.getElementById("password");
        if (button.type === "password") {
            button.type = "text";
        } else {
            button.type = "password";
        }
    });

// -- Count Animate  --
    $('.count').each(function () {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: 2000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now).toLocaleString('id'));
            }
        });
    });

// -- Button Scroll Up  --
    content.onscroll = () => {
        scrollFunction(btnTop, content);
    };
    btnTop.addEventListener('click', (e) => {
        $('#content').animate({
            scrollTop: 0
        }, 50);
        return false;
    });
});

// -- Tooltip Bootstrap  --
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
})

// -- Scrollup Button  --
const scrollFunction = (btnTop, content) => {
    if (content.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        btnTop.style.visibility = 'visible';

    } else {
        btnTop.style.visibility = 'hidden';
    }
}

// -- Nav tab auto redirect  --
$('.nav-item a').on('click', function (e){
    e.preventDefault();
    window.location.hash = e.target.hash;
    $(this).tab('show')
    });

const url = document.location.toString();
    if (url.match('#')){
        $('.nav-item a[href="#' + url.split('#')[1] + '"]').tab('show');
}

// -- Nav listgroup auto redirect  --
$('.list-group a').on('click', function (e){
    e.preventDefault();
    window.location.hash = e.target.hash;
    $(this).tab('show')
    });

    if (url.match('#')){
        $('.list-group a[href="#' + url.split('#')[1] + '"]').tab('show');
}

// -- show password  --
$('#showPass').on('click', function(){
    const button = document.getElementById("password");
        if (button.type === "password") {
            button.type = "text";
        } else {
            button.type = "password";
        }         
});


