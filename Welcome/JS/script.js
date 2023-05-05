$(document).ready(function () {

    $("#darkmode").click(function (e) { 
        e.preventDefault();
        $("#dm").attr("href") === "CSS/darkmode.css" ? $("#dm").removeAttr("href") : $("#dm").attr("href", "CSS/darkmode.css");
    
        $("#darkmode i").attr("class") === "fa-solid fa-moon" ? $("#darkmode i").attr("class", "fa-solid fa-sun") : $("#darkmode i").attr("class", "fa-solid fa-moon");
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
