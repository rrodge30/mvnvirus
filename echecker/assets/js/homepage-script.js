
    function anim(targetedDiv){
        var targetedLetter = $("#"+targetedDiv+" .rotate").text();
        var asciiValue = targetedLetter.charCodeAt(0);
        var pointer = 65;
        changeChar();
        function changeChar(){
            if(pointer <= asciiValue){
                $("#"+targetedDiv+" .rotate").text(String.fromCharCode(pointer));
                pointer++;
                setTimeout(changeChar, 20);
            }else{
                $(this).stop;
            }
        }
    }

$(document).ready(function(){
    $('.menu').animate({left:"0%"});

    $('#menuSection ul li.loginMenu').click(function(){
        window.location.replace('login');
    });

});
