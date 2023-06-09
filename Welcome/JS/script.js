$(document).ready(function () {
let onclick = false;

    if (window.matchMedia("(max-width: 768px)").matches) {
        onclick = true;
        $("header").hide();
    } else {
        onclick = false;
    }

    $("#darkmode").click(function (e) { 
        e.preventDefault();
        $("#dm").attr("href") === "CSS/darkmode.css" ? $("#dm").removeAttr("href") : $("#dm").attr("href", "CSS/darkmode.css");
    
        $("#darkmode i").attr("class") === "fa-solid fa-moon" ? $("#darkmode i").attr("class", "fa-solid fa-sun") : $("#darkmode i").attr("class", "fa-solid fa-moon");
    });


    $("nav ul li button").click(function (e) {
        e.preventDefault();

        if (!onclick) {
            $("nav ul li button span:first-child").css({
                'transform-origin': '0 0',
                'transform': 'rotate(45deg) translate(1px, -1px)'
            });
            $("nav ul li button span:last-child").css({
                'transform-origin': '0 100%',
                'transform': 'rotate(-45deg) translate(1px, 1px)'
            });
            $("nav ul li button span:nth-child(2)").css({
                'opacity': 0,
                'transform': 'scale(0)'
            });
            $("header").slideUp(800);
            onclick = true;
        } else {
            $("nav ul li button span:first-child").css({
                'transform-origin': '0 0',
                'transform': 'rotate(0deg) translate(0px, 0px)'
            });
            $("nav ul li button span:last-child").css({
                'transform-origin': '0 0',
                'transform': 'rotate(0deg) translate(0px, 0px)'
            });
            $("nav ul li button span:nth-child(2)").css({
                'opacity': 1,
                'transform': 'scale(1)'
            });
            $("header").slideDown(1000);
            onclick = false;
        }
    });

    $("nav ul li:last-child").mouseenter(function() {
        $("nav ul li:last-child .dropdown-logout").stop().slideDown();
      });
      
      $("nav ul li:last-child").mouseleave(function() {
        $("nav ul li:last-child .dropdown-logout").stop().slideUp();
      });


    $("main").load("component/Home.php");
    
    function onClick(ini, path){
        $("main").load(path);
        $("*").removeClass("on");
        $(ini).addClass("on");
    }

    $("#home").click(function (e) { 
        e.preventDefault();
        onClick(this, "component/Home.php");
    });

    $("#cari-buku").click(function (e) { 
        e.preventDefault();
        onClick(this, "component/Buku.php");
    });

    $("#riwayat").click(function (e) { 
        e.preventDefault();
        onClick(this, "component/History.php");
    });
    
});