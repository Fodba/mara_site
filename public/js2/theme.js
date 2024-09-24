
$(document).ready(function(){
    $(".btn_demande").click(function(){
        var demande = $(this).attr('id');
        //alert(demande);
        // $("#messages").css("display","none");


        $.ajax({
            url: "{% url 'mara:getSituation' %}",
            data: {
                'demande': demande
            },
            dataType: 'json',
            success: function (data) {
                if(data.messages){
                    var messages = $.parseJSON(data.messages);
                    var div_messages = "";
                    for(var i=0;i<messages.length;i++){
                        div_messages += "<div class='btn_message' id='"+messages[i][0]+"'><span class='btn-text'>"+messages[i][1]+"</span></div>";
                    }

                    $("#messages").empty();
                    $("#messages").append(div_messages);

                }
                if(data.situations){
                    var situations = $.parseJSON(data.situations);
                    var div_situations = "";
                    for(var i=0;i<situations.length;i++){
                        div_situations += "<div class='btn_situation' id='"+situations[i][2]+"1'>"+situations[i][1]+"</div>";
                    }

                    $("#situations").empty();
                    $("#situations").append(div_situations);



                }
                $('.btn_situation').click(function () {
                    var identifiant = $(this).attr("id");
                    var selection = document.getElementById(identifiant.slice(0,-1));
                    var others = document.getElementsByClassName("btn_message");
                    $("#messages").css("display","inline-block");
                    for(var el of others){
                        $(el).css("display","none");
                    }
                    $(selection).css("display",'block');

                });
            }
        });


    });




});