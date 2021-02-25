$(document).ready(function(){
    $("#current_pwd").keyup(function(){
        var current_pwd = $("#current_pwd").val();
        //alert(current_pwd);
        $.ajax({
            type: 'post',
            url: '/admin/check-current-pwd',
            data: {current_pwd:current_pwd},
            success:function(resp){
                if(resp=="false"){
                    $("#chkcurrentPwd").html("<font color=red>Current Password is incorrect</font>");
                }else if(resp=="true"){
                    $("#chkcurrentPwd").html("<font color=green>Current Password correct</font>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });
});
