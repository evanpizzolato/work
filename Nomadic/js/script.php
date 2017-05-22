<?php session_start();
header("Content-type: application/javascript"); 
?>

window.onload = function() {
    "use strict";
    setInterval(function(){
        var height = $(window).height();
        $("#dash-aside").css("min-height", height);
        
        var feat_hgt = $("#dash-aside").height() - ($("#dash-aside center").height() + 25 );
        $("#feat-nav").css("height", feat_hgt);
        
    },1);
    setTimeout(function(){
        $("#alertMsg").fadeOut(1500);
    }, 3000);
    $(function(){
      $('[data-toggle="tooltip"]').tooltip();
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#uploadedPreview').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#img").change(function(){
        readURL(this); 
    });
    $("#cate").change(function(){
        var cate = $("#cate").val();
        switch(cate) {
            case "Choose Category":
                $("#cost, #exp-1, #exp-2, #exp-3, #exp-4").prop({disabled:true, checked:false});
                break;
            case "2":
                $("#cost, #exp-1, #exp-2, #exp-3").prop({disabled:false, checked:false});
                $("#exp-1").prop({checked:true});
                $("#exp-4").prop({disabled:true, checked:false});
                break;
            default:
                $("#cost, #exp-1, #exp-2, #exp-3").prop({disabled:true, checked:false});
                $("#exp-4").prop({disabled:false, checked:true});
                break;
        }
    }); 
    $("#showPassInput").click(function(){
        console.log($("#password").attr("type"));
        
        if($("#password").attr("type") === "password") {
            $("#password").attr("type", "text");
        } else {
            $("#password").attr("type", "password");
        }
        
    });
};

function generatePswd() {
    var text = "";
    var possible = "/\*#!?.,+_ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for(var i = 0; i < 15; i++) {
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    }
    document.getElementById('password').value = text;
}