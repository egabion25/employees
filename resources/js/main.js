$(document).ready( function(){



var cropped = false;

    function UCFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }



    $("#drpCategory").change(function(){
        var selected_text = $("option:selected", this)[0].text;
        $("#txtSearch").attr("placeholder", "Enter " + selected_text + "..." ).focus();

    });


$("form#add_employee").submit(function(e){

    e.preventDefault();
    var formData = new FormData(this);

    getCropped(function(image_data){
         formData.append("image_data", image_data );


        $.ajax({
            cache: false,
            type: 'POST',
            url: "../Ajax/addEmployee",
            // data: $(this).serialize(),
            data: formData,
            processData: false,
            contentType: false,
            async: false,
            success: function(data) {

                var content = [];
                content.title =  "Add User";
                if(data.result == 0){
                    content.text = "User added successfully!"
                }else{
                    content.text = data.message;
                }
                
                promptModal(content);
                window.location.reload(true);
            }
        });


         
    })

   



});


function promptModal( content ){
    $("#modalPrompt .modal-title").text(content.title);
    $("#modalPrompt #modal-text").text(content.text);
    $("#modalPrompt").modal("show");
}




$(".clear-all").click(function(e){
    $(this).closest("form").find("input[type='text']").val("");
    $(this).closest("form").find("select option:first").prop('selected', true);

});



$("#btnAddLocation").click(function(e){
   e.preventDefault();
  
  if (  $("#drpdownLocation").is(":visible")   ){ 

    $("#drpdownLocation").hide();
    $("#location_name").removeClass("d-none").focus();  //show
    $(this).attr("value","Cancel");

  }else{

    var location = $("#location_name").val();
    
    if( $("#btnAddLocation").attr("value") == "Save" ){

        if( location ){

            $.ajax({
                cache: false,
                type: 'POST',
                url: "../Ajax/addLocation",
                data: {"location": UCFirstLetter(location) },
                async: false,
                success: function(data) {

                    var content = [];
                    content.title =  "Add Location";

                    if(data.result == 0){
                        content.text = "Location added successfully!"
                    }else{
                        content.text = data.message;
                    }
                    
                    promptModal(content);


                    getLocations(function(fetched_locations){

                            //clear items except first item
                           $("#drpdownLocation option").not(':first').remove();
                           $("#location_name").val('');
                           
                           $.each(fetched_locations, function(i, item) {
                                $("#drpdownLocation").append("<option value='"+ item.location_id +"'>"+ item.location_name +"</option>");
                           
                                if(item.location_name == location ){
                                    $("#drpdownLocation").val(item.location_id);  
                                }     
                           });
                    });

                }
            });
          }
    }

    $(this).attr("value","Add");
    $("#drpdownLocation").show();
    $("#location_name").addClass("d-none");  //show   
  }
});

$("#location_name").on(  'keyup keypress blur change' ,function(){


 var location = $(this).val().trim();
    if( location != "" ){
       $("#btnAddLocation").attr("value","Save");
    }else{
       $("#btnAddLocation").attr("value","Cancel");

    }

})



$("#btnAddPosition").click(function(e){

  e.preventDefault();
  if (  $("#drpdownPosition").is(":visible")   ){ 

    $("#drpdownPosition").hide();
    $("#position_name").removeClass("d-none").focus(); //show
    $(this).attr("value","Cancel");

  }else{

    var position = $("#position_name").val();
    
    if( $("#btnAddPosition").attr("value") == "Save" ){

        if( location ){

            $.ajax({
                cache: false,
                type: 'POST',
                url: "../Ajax/addPosition",
                data: {"position": UCFirstLetter(position) },
                async: false,
                success: function(data) {

                    var content = [];
                    content.title =  "Add Location";

                    if(data.result == 0){
                        content.text = "Position added successfully!"
                    }else{
                        content.text = data.message;
                    }
                    
                    promptModal(content);



                    getPositions(function(fetched_positions){

                            //clear items except first item
                           $("#drpdownPosition option").not(':first').remove();
                           $("#position_name").val('');
                           
                           $.each(fetched_positions, function(i, item) {
                                $("#drpdownPosition").append("<option value='"+ item.position_id +"'>"+ item.position_name +"</option>");
                           
                                if(item.position_name == position ){
                                    $("#drpdownPosition").val(item.position_id);  
                                }     
                           });
                    });


                }
            });
          }
    }

    $(this).attr("value","Add");
    $("#drpdownPosition").show();
    $("#position_name").addClass("d-none");  //show   
  }
});

$("#position_name").on(  'keyup keypress blur change' ,function(){


 var position = $(this).val().trim();
    if( position != "" ){
       $("#btnAddPosition").attr("value","Save");
    }else{
       $("#btnAddPosition").attr("value","Cancel");

    }

})



$("#btnAddStatus").click(function(e){

  e.preventDefault();
  if (  $("#drpdownStatus").is(":visible")   ){ 

    $("#drpdownStatus").hide();
    $("#status_name").removeClass("d-none").focus();  //show
    $(this).attr("value","Cancel");

  }else{

    var status = $("#status_name").val();
    
    if( $("#btnAddStatus").attr("value") == "Save" ){

        if( location ){

            $.ajax({
                cache: false,
                type: 'POST',
                url: "../Ajax/addStatus",
                data: {"status": UCFirstLetter(status) },
                async: false,
                success: function(data) {
                    var content = [];
                    content.title =  "Add Status";
                    if(data.result == 0){
                        content.text = "Status added successfully!"
                    }else{
                        content.text = data.message;
                    }
                    
                    promptModal(content);

                    getStatus(function(fetched_status){

                            //clear items except first item
                           $("#drpdownStatus option").not(':first').remove();
                           $("#status_name").val('');
                           
                           $.each(fetched_status, function(i, item) {
                                $("#drpdownStatus").append("<option value='"+ item.status_id +"'>"+ item.status_name +"</option>");
                           
                                if(item.status_name == status ){
                                    $("#drpdownStatus").val(item.status_id);  
                                }     
                           });
                    });





                }
            });
          }
    }

    $(this).attr("value","Add");
    $("#drpdownStatus").show();
    $("#status_name").addClass("d-none");  //show   
  }
});

$("#status_name").on(  'keyup keypress blur change' ,function(){


 var status = $(this).val().trim();
    if( status != "" ){
       $("#btnAddStatus").attr("value","Save");
    }else{
       $("#btnAddStatus").attr("value","Cancel");

    }

})




$("#btnAddNationality").click(function(e){

  e.preventDefault();
  if (  $("#drpdownNationality").is(":visible")   ){ 

    $("#drpdownNationality").hide();
    $("#nationality_name").removeClass("d-none").focus();  //show
    $(this).attr("value","Cancel");

  }else{

    var nationality = $("#nationality_name").val();
    
    if( $("#btnAddNationality").attr("value") == "Save" ){

        if( location ){

            $.ajax({
                cache: false,
                type: 'POST',
                url: "../Ajax/addNationality",
                data: {"nationality": UCFirstLetter(nationality) },
                async: false,
                success: function(data) {
                    var content = [];
                    content.title =  "Add Nationality";
                    if(data.result == 0){
                        content.text = "Nationality added successfully!"
                    }else{
                        content.text = data.message;
                    }
                    
                    promptModal(content);

                    getNationalities(function(fetched_nationalities){

                            //clear items except first item
                           $("#drpdownNationality option").not(':first').remove();
                           $("#nationality_name").val('');
                           
                           $.each(fetched_nationalities, function(i, item) {
                                $("#drpdownNationality").append("<option value='"+ item.nationality_id +"'>"+ item.nationality_name +"</option>");
                           
                                if(item.nationality_name == nationality ){
                                    $("#drpdownNationality").val(item.nationality_id);  
                                }     
                           });
                    });





                }
            });
          }
    }

    $(this).attr("value","Add");
    $("#drpdownNationality").show();
    $("#nationality_name").addClass("d-none");  //show   
  }
});

$("#nationality_name").on(  'keyup keypress blur change' ,function(){


 var nationality = $(this).val().trim();
    if( nationality != "" ){
       $("#btnAddNationality").attr("value","Save");
    }else{
       $("#btnAddNationality").attr("value","Cancel");

    }

})



        
function getLocations(callback){

        $.ajax({
            cache: false,
            type: 'POST',
            dataType: "json",
            url: "../Ajax/getLocations",
            async: false,
            success: function(data) {
               
            if (callback && typeof(callback) === "function") {
                callback(data);
            }


            }
        });
}
   
function getPositions(callback){

        $.ajax({
            cache: false,
            type: 'POST',
            dataType: "json",
            url: "../Ajax/getPositions",
            async: false,
            success: function(data) {
               
            if (callback && typeof(callback) === "function") {
                callback(data);
            }


            }
        });
}

        
function getStatus(callback){

        $.ajax({
            cache: false,
            type: 'POST',
            dataType: "json",
            url: "../Ajax/getStatus",
            async: false,
            success: function(data) {
               
            if (callback && typeof(callback) === "function") {
                callback(data);
            }


            }
        });
}

   
function getNationalities(callback){

        $.ajax({
            cache: false,
            type: 'POST',
            dataType: "json",
            url: "../Ajax/getNationalities",
            async: false,
            success: function(data) {
               
            if (callback && typeof(callback) === "function") {
                callback(data);
            }


            }
        });
}


// $("input[type='text']").on(  'keyup keypress blur change' ,function(){
//     $(this).val( UCFirstLetter( $(this).val()  )   ); 
// })





function readFile(elem) {
  
  if (elem.files && elem.files[0]) {
    
    var FR= new FileReader();
    
    FR.addEventListener("load", function(e) {
      $("#upload_preview")[0].src       = e.target.result;

       var crop_dimension = ( $('#upload_preview')[0].naturalWidth > $('#upload_preview')[0].naturalHeight ?  $('#upload_preview').height() : $('#upload_preview').width());

        cropped = $('#upload_preview').croppie({
            enableExif: true,
            viewport: {
                width: crop_dimension,
                height: crop_dimension,
            },
            boundary: {
                width: crop_dimension + (crop_dimension *.2),
                height: crop_dimension + (crop_dimension *.2)
            }
        });

    }); 
    
    FR.readAsDataURL( elem.files[0] );
  }

 

}






// upload_profile_photo


// document.getElementById("inp").addEventListener("change", readFile);



$("#upload_profile_photo").on("change",function(){
    readFile(  this );
});


function getCropped(callback){

  cropped.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (resp) {

             if (callback && typeof(callback) === "function") {
                callback(resp);
            }
        });
}







})