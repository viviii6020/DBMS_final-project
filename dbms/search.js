$(document).ready(function(){
    $('input[type="radio"]').click(function(){
        if($(this).attr("value")=="option1"){
            $("#mem_search").show();
            $("#pos_search").hide();
            $(".costBar").hide();
            $(".collectBar").hide();
        }
        if($(this).attr("value")=="option2"){
            $("#mem_search").hide();
            $("#pos_search").show();
            $(".costBar").hide();
            $(".collectBar").hide();
        }
        if($(this).attr("value")=="option3"){
            $("#mem_search").hide();
            $("#pos_search").hide();
            $(".costBar").show();
            $(".collectBar").hide();
            var CostBarValue = document.getElementById("costBar");
            var CostValueText = document.getElementById("costRange");
            CostValueText.innerHTML = CostBarValue.value;

            CostBarValue.oninput = function() {
                CostValueText.innerHTML = this.value;
            }
            
        }
        if($(this).attr("value")=="option4"){
            $("#mem_search").hide();
            $("#pos_search").hide();
            $(".costBar").hide();
            $(".collectBar").show();
            var CollectBarValue = document.getElementById("collectBar");
            var CollectValueText = document.getElementById("collectRange");
            CollectValueText.innerHTML = CollectBarValue.value;

            CollectBarValue.oninput = function() {
                CollectValueText.innerHTML = this.value;
            }
        }
        if($(this).attr("value")=="option5"){
            $("#mem_search").hide();
            $("#pos_search").hide();
            $(".costBar").hide();
            $(".collectBar").hide();
        }

    });
});

