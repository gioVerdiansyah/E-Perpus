// side bar event
$(".side-bar ul .dropdown .master-data").click(function (e) { 
    e.preventDefault();
    $("#list-master-data").toggleClass("list-master-data-onclick");
    $(".side-bar ul li.dropdown .master-data .dropdown-icon").toggleClass("dropdown-icon-onclick");
    $(".side-bar ul .dropdown .master-data").toggleClass("addBg");
});


$("#darkmode").click(function (e) { 
    e.preventDefault();
    $("#dm").attr("href") === "CSS/Home-AdminDM.css" ? $("#dm").removeAttr("href") : $("#dm").attr("href", "CSS/Home-AdminDM.css");

    $("#darkmode i").attr("class") === "fa-solid fa-moon" ? $("#darkmode i").attr("class", "fa-solid fa-sun") : $("#darkmode i").attr("class", "fa-solid fa-moon");
});

$("main .content-wrapper .heading .profile").mouseenter(function() {
    $("main .content-wrapper .heading .profile .dropdown-profile").stop().slideDown();
  });
  
  $("main .content-wrapper .heading .profile").mouseleave(function() {
    $("main .content-wrapper .heading .profile .dropdown-profile").stop().slideUp();
  });
  

// AJAX
$(document).ready(function () {
    $(".content").load('component/Home-Admin.php');
    const onReady = (ini, path) => {
        $('.content').load(path);
        $('*').removeClass('active');
        $(ini).addClass('active');
    }

    $(".dashboard").click(function (e) { 
        e.preventDefault();
        onReady(this, 'component/Home-Admin.php');
    });

    $("#buku h3").click(function (e) { 
        e.preventDefault();
        onReady(this, 'component/Master-Buku.php');
    });

    $("#peminjaman").click(function (e) { 
        e.preventDefault();
        onReady(this, 'component/Data-Peminjaman.php');
    });

    $("#laporan").click(function (e) { 
        e.preventDefault();
        onReady(this, 'component/Data-Laporan.php');
    });
});


// book
    $("#selection").on("change", function() {
        let value = $(this).val();

        $.get("component/pagenation/index.php?lim=" + value, function(data) {
            $("#isi-data").html(data);
        })
    })