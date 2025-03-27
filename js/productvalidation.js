$(document).ready(function(){

    getCategoryData= function(catid){

        var url="../controller/productcontroller.php?status=edit_category";
        $.post(url,{cat_id:catid},function(data){
            $("#categorycontent").html(data);
            
        });   
        
    }

});