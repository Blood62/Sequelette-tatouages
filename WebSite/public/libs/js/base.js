
$( document ).ready(function() {
    $("#navbarDropdownMenuLink").on("click",function(){
        $("#MenuLink").toggle(600);
    });
    $("#arrow-1").on("click",function(){
        $("#arrow-1").toggle();
        $("#arrow-2").toggle();
        $("#texte").toggle(800);

    });

    $("#arrow-2").on("click",function(){
        $("#arrow-1").toggle();
        $("#arrow-2").toggle();
        $("#texte").toggle(800);

    });

    $( ".zoom" ).mouseover(function() {
        $(this).removeClass().addClass('nav-item nav-link text-white mr-3 ml-1 zoom');
    });
    $( ".zoom" ).mouseleave(function() {
        $(this).removeClass().addClass('nav-item nav-link text-info mr-3 ml-1 zoom');
    });




    $('#logo').mouseover(function() {
        $(this).css("transform", "rotate(360deg)");
    });
    $('#logo').mouseleave(function() {
        $(this).css("transform", "rotate(0deg)");
    });





    $("#admin").on("click",function(){
        $(".admin").toggle(800);
        $("#admin").toggle(600);
    });

    $("input").removeClass("custom-file-input");
    $("div").removeClass("custom-file");


    function isMobileDevice() {
        if( navigator.userAgent.match(/iPhone/i)
            || navigator.userAgent.match(/webOS/i)
            || navigator.userAgent.match(/Android/i)
            || navigator.userAgent.match(/iPad/i)
            || navigator.userAgent.match(/iPod/i)
            || navigator.userAgent.match(/BlackBerry/i)
            || navigator.userAgent.match(/Windows Phone/i)
        ){
            return true;
        }
        else {
            return false;
        }
    }

    if(isMobileDevice()===true){
        document.getElementById('phone').style.visibility='visible';

    }
    else {
        document.getElementById('phone').style.display='none';

    }

/*    function pasdenegatif(){
        return Number(document.getElementById('devis_Temp').value)<0
    }*/




    document.devis.submit(function () {
        pasdenegatif();
    });

    document.getElementById("top").remove()

    /*

    $("#contact").on("click", ()=>{
        $.ajax({
            method: "POST",
            url: "/templates/contact/index.html.twig",
            dataType: "html",

        }).done( function(response) {
            $("#MenuLink").toggle(600);
            $("#divBody").html(response);

        }).fail(function(jxh,textmsg,errorThrown){
            console.log(textmsg);
            console.log(errorThrown);
        })
    });

        $("#contact2").on("click", ()=>{
            $.ajax({
                method: "POST",
                url: "/templates/contact/index.html.twig",
                dataType: "html",

            }).done( function(response) {

                $("#divBody").html(response);

            }).fail(function(jxh,textmsg,errorThrown){
                console.log(textmsg);
                console.log(errorThrown);
            })
        });
    */



});