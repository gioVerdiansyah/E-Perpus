$(document).ready(function () {
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
        onClick(this, "component/History.htm");
    });
    
});