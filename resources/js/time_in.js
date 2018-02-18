$(document).ready( function(){



 
 $('.typeahead').typeahead({
        source: function(query, process) {
            var results = _.map(employees, function(employee) {
                return "<span employee_id='"+ employee[ "id"] +"'>" + employee[     $("#drpCategory").val() ] + "</span>";
            });
            process(results);
        },
        highlighter: function(item) {
            return  item ;
        },
        updater: function(item) {
            active_employee_id = $(item).attr("employee_id");

            getEmployee( function(employee_data){

                $(".time-breakdown").html("");
                $("#profile-container .invisible").removeClass("invisible");
                $("#profile-container").removeClass("logo-background");
                $("#profile-container .employee_name").text(employee_data.employee_full_name);
                $("#profile-container .employee_position").text(employee_data.position_name);
                $("#profile-container .employee_location").text(employee_data.location_name);

                if(employee_data.employee_photo){
                    $("#profile-container .employee_photo").attr("src",employee_data.employee_photo);
                }else{
                    $("#profile-container .employee_photo").attr("src","./resources/uploads/avatar.jpg");

                }

                $("#profile-container .employee_location").text(employee_data.location_name);



                $("#manual-InOut").removeClass("invisible");   
                // $("#manual-InOut").addClass("manual-InOut");

                $(".buttons").removeClass("invisible");   
                
                console.log(employee_data);
            }); 

            return $(item).text();
        }

    });



$("#manual-InOut").click(function(){
    activate_clock = !activate_clock;

    if( !activate_clock  ){
        
        $(".custom-time-container").removeClass("d-none");
        $(".custom-date").removeClass("d-none");
        $(".current-time").addClass("d-none");
        $(".current-date").addClass("d-none");
        $(".custom-time").val( $(".current-time").text() );
        $(".custom-time").focus();

        setButtons();

    }else{

        $(".custom-date").removeClass("d-none");
        $(".current-time").removeClass("d-none");
        $(".custom-time-container").addClass("d-none");
    }

});

$("tbody")[0].scrollTop = $("tbody")[0].scrollHeight;


$('.custom-time').timepicker({
    minuteStep: 5,
    showInputs: false,
    disableFocus: true
});

$('.datePicker').datepicker({
        format: 'M dd, yyyy',
        autoclose:true,
}).on("changeDate", function(e) {
       var dayInaWeek = $(".datePicker").data('datepicker').getFormattedDate('DD');
       $(".current-day").text( dayInaWeek );
});

$('.datePicker').datepicker("update", new Date());


// 

function setButtons(){

    // if needing timeout..
    if( $(".time-breakdown h4:last .time-out .empty").length    ){

        $("#timer .time-in").addClass("blured");
        $("#timer .time-in button").attr("disabled","disabled");

        $("#timer .time-out").removeClass("blured");
        $("#timer .time-out button").removeAttr("disabled");
        
    }else{
         // if needing timein..
        $("#timer .time-out").addClass("blured");
        $("#timer .time-out button").attr("disabled","disabled");

        $("#timer .time-in").removeClass("blured");
        $("#timer .time-in button").removeAttr("disabled");
    }
    
}

$('.custom-time').on("keypress", function(e) {
        if (e.keyCode == 13) {
            
            if( $(".time-breakdown h4:last .time-out .empty").length    ){
              $( ".time-out button" ).trigger( "click" )
            }else{
              $( ".time-in button" ).trigger( "click" )
            }
        }
});




$(".time-in button").click(function(){
    addAttendance("in");
    setButtons();
});

$(".time-out button").click(function(){
        addAttendance("out");
        setButtons();
});

$("body").on("click", ".remove-entry",function(){
    $(this).closest("h4").remove();
    updateTotalHours();
    setButtons();
});





function  addAttendance( method ){
    
    var time_string = $(".custom-time").val();
    if( method == "in"){
            
            // alert("in" + $("h3.current-time").text());


         var timeday_string = "Morning";       

         var full_in_date = $(".datePicker").data('datepicker').getFormattedDate('yyyy-mm-dd ') + time_string;
         var full_out_date = "";



         if(  time_string.slice(-2) ==  "PM" ){
             
            if(   time_string.split(":")[0] == 12 || time_string.split(":")[0] <  6 ){
                timeday_string = "Afternoon";
            }else if( time_string.split(":")[0] >= 6  ){
                timeday_string = "Evening";
            }

         }

        var timeout_string = '<b class="empty"> ? ? ? </b> </span>'; 

        var entry = "<h4  full-in='"+ full_in_date +"'  full-out='"+ full_out_date +"' >";                                                            
            entry = entry +  "<i class='remove-entry fa fa-minus-circle' aria-hidden='true'></i>";
            entry = entry +         " <span class='timeDay'> "+  timeday_string +":</span>";
            entry = entry +         " <span class='time-in'> " + time_string + "</span> - ";                  
            entry = entry +         " <span class='time-out'> "+ timeout_string +"</span> ";
            entry = entry +  "</h4>";

        $(".time-breakdown").append(entry);
      

    }else if( method == "out" ){

        var full_in_date = $(".time-breakdown h4:last").attr("full-in");     
        var full_out_date = $(".datePicker").data('datepicker').getFormattedDate('yyyy-mm-dd ') + time_string;
        
        var startTime=moment(full_in_date,  "yyyy-m-D HH:mm A");
        var endTime=moment(full_out_date,   "yyyy-m-D HH:mm A");

        if( endTime > startTime ){
            
            $(".time-breakdown h4:last").attr("full-out",  full_out_date  ); 
            $(".time-breakdown h4:last .time-out").html(  time_string ).after(   getDuration( startTime, endTime ) );
            
            updateTotalHours();
        }


          

    }


}

function getDuration( startTime, endTime){
        
    var duration = moment.duration(endTime.diff(startTime));
    var hours = parseInt(duration.asHours());
    var minutes = parseInt(duration.asMinutes())-hours*60;

    var result = false;

    if( hours > 0){

        result = hours + (hours > 1 ?  " Hours " : " Hour ");
    }

    if( minutes ){
        // result = hours + (hours > 1 ?  " Hours" : " Hour");

        result = result + minutes +  (minutes > 1 ?  " Minutes " : " Minute ");
    }

    return "<center><small class='entry-work-hours' total_mins='" + ( minutes + (hours*60) )  + "'> " + result + " </small></center>";
}
    
function updateTotalHours(){

    var total_mins = 0;
    $.each($(".entry-work-hours"), function(i, item) {
       total_mins = total_mins + + $(item).attr("total_mins");
   });

    // var duration = moment.duration(total_mins);
    // var minutes = parseInt(duration.asMinutes())-hours*60;

    // var duration = moment.duration(total_mins);
 
    var hours = parseInt(total_mins/60);
    var minutes = total_mins-(hours*60);

    var result = "&nbsp;";

    if( hours ){
       result  = hours + (hours > 1 ?  " Hrs " : " Hr ");
    } 

    if( minutes ){
       result = result + minutes + (minutes > 1 ?  " mins" : " min ");
    } 

    $(".total-workhours").html(result);

    if( hours < 8){
       $(".total-workhours").css("color","orangered");  
    }else if( hours > 8 && hours < 10 ){
       $(".total-workhours").css("color","gray");  
    }else if( hours > 10 ){
       $(".total-workhours").css("color","green");  
    }


    if( total_mins  > 0 ){
        $("#profile-container button").removeClass("blured");
        $("#profile-container button").removeAttr("disabled");

        $("#profile-container .buttons textarea").removeAttr("disabled");
        $("#profile-container .buttons textarea").removeClass("blured");

    }else{
        $("#profile-container button").addClass("blured");
        $("#profile-container button").attr("disabled","disabled");

        $("#profile-container .buttons textarea").attr("disabled", "disabled" );
        $("#profile-container .buttons textarea").addClass("blured");


    }

}


function getEmployee(  callback ){

    $.ajax({
        cache: false,
        type: 'POST',
        url: "./Ajax/getEmployee/" + active_employee_id,
        dataType: "json",
        async: false,
        success: function(data) {

          if (callback && typeof(callback) === "function") {
                callback(data);
          }
        }
    });

}

function submitAttendance(  employee_id, callback ){

    var whole_day = {};
        whole_day.attendance = [];
    $.each($(".time-breakdown h4"), function(i, item) {

        var entry = {};
            entry.timein =  moment( $(item).attr("full-in") ).format("YYYY-MM-D H:mm:ss");
            entry.timeout = moment( $(item).attr("full-out") ).format("YYYY-MM-D H:mm:ss");
            entry.minutes = $(item).find(".entry-work-hours").attr("total_mins");
        whole_day.attendance[i] = entry;
    });

    whole_day.notes = $("textarea").val();


    var whole_day = JSON.stringify(whole_day);


    $.ajax({
      type: 'post',
      url: "./Ajax/submitAttendance/" + active_employee_id + "/" + "1",
      data: 'data=' + whole_day,
      success: function(message) {
        // check result object for what you returned
        if(message.result == 0 ){
            $(".time-breakdown").html("");
            updateTotalHours();
            setButtons();

            // $("#profile-container .buttons .insert button").removeAttr("disabled");
            // $("#profile-container .buttons textarea").removeAttr("disabled");
            // $("#profile-container .buttons textarea").removeClass("blured");
        }

      },
      error: function(error) {
        // check error object or return error
      }
    });
}



function getAttendance(callback){


    $.ajax({
      type: 'post',
      dataType: "json",
      url: "./Ajax/getAttendance",
      success: function(attendance_data) {
          if (callback && typeof(callback) === "function") {
                callback(attendance_data);
          }
      },
      error: function(error) {
        // check error object or return error
      }
    });

}


function populateTable( attendance_data ){
    $("#attendance_table table>tbody").html("");
    var rows = "";
    $.each( attendance_data, function(i, item) {

        var hours = parseInt(item.minutes/60);
        var minutes =  item.minutes - (hours * 60);

        hours = (hours > 1 ?  hours + " Hours " : hours + " Hour ");
        minutes = (minutes > 1 ?  minutes + " minutes " : hours + " minute ");
        
       rows = rows + "<tr><td>" + i + "</td>";
       rows = rows + "<td>" + item.attendance_breakdown_employee_id + "</td>";
       rows = rows + "<td>" + item.employee_full_name + "</td>";
       rows = rows + "<td>" + item.position_name + "</td>";
       rows = rows + "<td>" + time + "</td>" + hours + minutes +"</tr>";
    });
    $("#attendance_table table>tbody").append(rows);
    $("tbody")[0].scrollTop = $("tbody")[0].scrollHeight;
}





$("#profile-container .buttons .clear button").click(function(){
    $(".time-breakdown").html("");
    updateTotalHours();
    setButtons();
})


$("#profile-container .buttons .insert button").click(function(){   
   
   var employee_id = active_employee_id;
   
   $(this).attr("disabled","disabled");
   
   submitAttendance(    employee_id   );

   getAttendance( function(attendance_data){
        populateTable(attendance_data);
   });

})







});




