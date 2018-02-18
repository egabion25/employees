$(document).ready( function(){






$("tbody")[0].scrollTop = $("tbody")[0].scrollHeight;
$("#txtSearch").focus();

$("#timer .buttons").hide();
 
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

            searchEmployee( active_employee_id );

            $("#txtSearch").focus();
            
            return $(item).text();
        }

    });


 function searchEmployee( employee_id ){

            getEmployee( function(employee_data){
                $("#txtSearch").focus(function() { $(this).select(); } )
                $("#timer .buttons").show();
                $(".time-breakdown").html("");
                    
                $("#profile-container .invisible").removeClass("invisible");
                $("#profile-container").removeClass("logo-background");
                $("#profile-container .employee_name").text(employee_data.employee_full_name);
                $("#profile-container .employee_position").text(employee_data.position_name);
                $("#profile-container .employee_location").text(employee_data.location_name);

                if(employee_data.employee_photo){
                    $("#profile-container .employee_photo").attr("src",employee_data.employee_photo);
                }else{
                    $("#profile-container .employee_photo").attr("src","../resources/uploads/avatar.jpg");

                }

                $("#profile-container .employee_location").text(employee_data.location_name);

                $("#manual-InOut").removeClass("invisible");   
                // $("#manual-InOut").addClass("manual-InOut");

                $(".buttons").removeClass("invisible");   

                $("#profile-container .buttons textarea").val("");

                $(".remove-entry").removeAttr("disabled");
                $(".remove-entry").removeClass("blured");

                updateTotalHours();


                if( employee_data.attendance.absent == "1"){
                    $(".absent-watermark").show();
                }else{
                    $(".absent-watermark").hide();
                }

                 if(employee_data.attendance != false){
                    $.each( employee_data.attendance.breakdown, function(i, item) {

                        var in_date = item.attendance_breakdown_time_in.split(" ")[0];
                        var in_time = item.attendance_breakdown_time_in.substr(11,5);
                        timeIn( in_date, convertTime(in_time) );

                        var out_date = item.attendance_breakdown_time_out.split(" ")[0];
                        var out_time = item.attendance_breakdown_time_out.substr(11,5);
                        timeOut(out_date, convertTime(out_time) );

                    });

                    $("#profile-container .buttons textarea").removeClass("blured");
                    $("#profile-container .buttons textarea").attr("disabled","disabled");
                    $("#profile-container .buttons textarea").val(employee_data.attendance.notes);

                    $("#profile-container .buttons button").attr("disabled","disabled");
                    $("#profile-container .buttons button").addClass("blured");

                    $(".remove-entry").attr("disabled","disabled");
                    $(".remove-entry").addClass("blured");
                    $("#timer .buttons").hide();

                 }else{
                    updateTotalHours();
                    setButtons();
                    $("#profile-container .buttons textarea").val("");
                 }

            }); 

 }


function convertTime(time){

    var hour =  time.substr(0,2);
    var minutes = time.substr(3,2);

    if( hour < 12 ){
        time = hour + ":" +  minutes + " AM";
    }else if( hour == 12 ){
        time = "12:" +  minutes + " PM";
    }else{
        time = (hour  -12) + ":" +  minutes + " PM";
    }

    return time;
}

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


function setButtons(method){

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
    
    var in_date = $(".datePicker").data('datepicker').getFormattedDate('yyyy-mm-dd ');
    var in_time = $(".custom-time").val();
    var full_in_date = in_date + in_time;


    $("#manual-InOut").trigger("click");
    
    timeIn( in_date, in_time );
    setButtons();


});

$(".time-out button").click(function(){

        var out_date = $(".datePicker").data('datepicker').getFormattedDate('yyyy-mm-dd ');
        var out_time = $(".custom-time").val();

        timeOut( out_date, out_time);
        setButtons();
});

$(".absent button").click(function(){

  absent();
        // var out_date = $(".datePicker").data('datepicker').getFormattedDate('yyyy-mm-dd ');
        // var out_time =$(".custom-time").val();

        // timeOut( out_date, out_time);
        // setButtons();
});

$("body").on("click", ".remove-entry",function(){
    
    if(     $(this).is("[disabled]")    ){
        $( "body" ).effect( "shake", {times: 4,  distance: 5}, 50 );
    }else{
        $(this).closest("h4").remove();
        updateTotalHours();
        setButtons();
        
    }



});



function timeIn( in_date, in_time ){

    var full_out_date = "";

    var timeday_string = "Morning";       
     if(  in_time.slice(-2) ==  "PM" ){
         
        if(   in_time.split(":")[0] == 12 || in_time.split(":")[0] <  6 ){
            timeday_string = "Afternoon";
        }else if( in_time.split(":")[0] >= 6  ){
            timeday_string = "Evening";
        }

     }

        var timeout_string = '<b class="empty"> ? ? ? </b> </span>'; 

        var entry = "<h4  full-in='"+ in_date + " " + in_time +"'  full-out='"+ full_out_date +"' >";                                                            
            entry = entry +  "<i class='remove-entry fa fa-minus-circle' aria-hidden='true'></i>";
            entry = entry +         " <span class='timeDay'> "+  timeday_string +":</span>";
            entry = entry +         " <span class='time-in'> " + in_time + "</span> - ";                  
            entry = entry +         " <span class='time-out'> "+ timeout_string +"</span> ";
            entry = entry +  "</h4>";


            if( checkInRange( in_date + " " + in_time ) ){
                $(".time-breakdown").append(entry);
                $(".custom-time").focus();
            }else{
                $( "body" ).effect( "shake", {times: 4,  distance: 5}, 50 );
            }

}

function checkInRange(dateToCheck){

    var range_valid = true;
    dateToCheck = moment( dateToCheck ).format("YYYY-MM-D HH:mm:ss");
    // dateToCheck = moment( dateToCheck ).format("X")

    $.each($(".time-breakdown h4"), function(i, item) {

        var range_from = moment( $(item).attr("full-in") ).format("YYYY-MM-D HH:mm:ss");
        var range_to = moment( $(item).attr("full-out") ).format("YYYY-MM-D HH:mm:ss");
       
        // var range_from = moment( $(item).attr("full-in") ).format("X")
        // var range_to = moment( $(item).attr("full-out") ).format("X")
       
        if (dateToCheck > range_from && dateToCheck > range_to ){
                
        }else{
           range_valid = false;
        }
    });

    return range_valid;
}

function timeOut( out_date, out_time){

        var full_in_date = $(".time-breakdown h4:last").attr("full-in");     
        var full_out_date = out_date + " " + out_time;
        
        var startTime=moment(full_in_date,  "yyyy-m-D HH:mm A");
        var endTime=moment(full_out_date,   "yyyy-m-D HH:mm A");

        if( endTime > startTime ){
            
            $(".time-breakdown h4:last").attr("full-out",  full_out_date  ); 
            $(".time-breakdown h4:last .time-out").html(  out_time ).after(   getDuration( startTime, endTime ) );
            
            updateTotalHours();
        }else{
            $( "body" ).effect( "shake", {times: 4,  distance: 5}, 50 );
        }
}

function absent(){
    clear();
    $("#profile-container .buttons textarea").removeAttr("disabled").removeClass("blured").focus();
    $("#profile-container .buttons button").removeAttr("disabled").removeClass("blured");
}



function clear(){
    $(".time-breakdown").html("");
    $("#profile-container .buttons textarea").val("");
    updateTotalHours();
    setButtons();
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
    

function calculateDuration( total_mins, type ){

    var hours = parseInt(total_mins/60);
    var minutes = total_mins-(hours*60);
    var result = "&nbsp;";

    if( hours ){
       result  = hours + (hours > 1 ?  " Hrs " : " Hr ");
    } 

    if( minutes ){
       result = result + minutes + (minutes > 1 ?  " mins" : " min ");
    } 

    if (type && type != undefined ) {
        if(type == "hours"){
            return hours;
        }else if(type == "minutes"){
            return minutes;
        }
    }else{
        return result;
    }
}
        




function updateTotalHours(){

    var total_mins = 0;
    $.each($(".entry-work-hours"), function(i, item) {
     total_mins = total_mins + + $(item).attr("total_mins");
    });

    var result = calculateDuration(total_mins);
    var hours = calculateDuration(total_mins,"hours");
    
    $(".total-workhours").html(result);
    if( hours < 8){
       $(".total-workhours").css("color","orangered");  
    }else if( hours > 8 && hours < 10 ){
       $(".total-workhours").css("color","gray");  
    }else if( hours > 10 ){
       $(".total-workhours").css("color","green");  
    }

    var OT = calculateDuration(total_mins - 600);

    if( (total_mins - 600) > 0 ){
        $(".over-time-text").html(   OT + " overtime"   );
    }else{
        $(".over-time-text").html("");

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

    var date = $(".datePicker").data('datepicker').getFormattedDate('yyyy-mm-dd') 

    $.ajax({
        cache: false,
        type: 'POST',
        url: "../Ajax/getEmployee/" + active_employee_id + "/" + date,
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

    if( ! whole_day.attendance.length  ){
        whole_day.absent =  $(".datePicker").data('datepicker').getFormattedDate('yyyy-mm-dd');
    }

    whole_day.notes = $("textarea").val();

    var whole_day = JSON.stringify(whole_day);

    $.ajax({
      type: 'post',
      url: "../Ajax/submitAttendance/" + active_employee_id + "/" + "1",
      data: 'data=' + whole_day,
      success: function(message) {
        // check result object for what you returned
        if(message.result == 0 ){
            $(".time-breakdown").html("");
            updateTotalHours();
            setButtons();
            clear();

            window.location = "./?id=" + active_employee_id + "&date=" +  $(".datePicker").data('datepicker').getFormattedDate('yyyy-mm-dd');
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
      url: "../Ajax/getAttendance",
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
       rows = rows + "<td>" +  hours + minutes + "</td></tr>";
    });
    $("#attendance_table table>tbody").append(rows);
    $("tbody")[0].scrollTop = $("tbody")[0].scrollHeight;
}





$("#profile-container .buttons .clear button").click(function(){
    clear();
})


$("#profile-container .buttons .insert button").click(function(){ 


   
   var employee_id = active_employee_id;
   
   $(this).attr("disabled","disabled");
   
   submitAttendance(    employee_id   );

   getAttendance( function(attendance_data){
        populateTable(attendance_data);
   });

})

if( override_date ){
    // $('.datePicker').datepicker("update", new Date("2018-02-16 18:40:00"));
    $('.datePicker').datepicker("update", new Date(override_date));
    searchEmployee(   active_employee_id  );
}

});




