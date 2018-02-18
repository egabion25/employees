
window.setInterval(function(){
  /// call your function here


    var now = new Date()
    var ampm = now.getHours() >= 12 ? 'PM' : 'AM';
    var hours = now.getHours() % 12 || 12; 

    var current_time = hours + ":" + ("0" + (now.getMinutes())).slice(-2) +  " " + ampm;
    var day = ("0" + (now.getDate() + 1)).slice(-2);
    var current_date = getMonth() + " " + day + ", " +  now.getFullYear();

    if( activate_clock ){
        $(".current-day").html( getDayinWeek() );
        $(".current-date").html(current_date);
        $(".current-time").html(current_time);
        // console.log("on");
    }else{
        // console.log("off");
        // $(".current-day").html( getDayinWeek() );
        $(".current-date").html(current_date);
       

        if ( $(".custom-time").is(":hidden") ){

             $(".current-time").html(current_time);

        }
    }


    if(active_employee_id){
        // $("#manual-InOut").removeClass("invisible");   
        // $(".buttons").removeClass("invisible");   
    }



}, 1000);



function getMonth() {
    var month = new Array();
    month[0] = "Jan";
    month[1] = "Feb";
    month[2] = "Mar";
    month[3] = "Apr";
    month[4] = "May";
    month[5] = "Jun";
    month[6] = "Jul";
    month[7] = "Aug";
    month[8] = "Sep";
    month[9] = "Oct";
    month[10] = "Nov";
    month[11] = "Dec";

    var d = new Date();
    var n = month[d.getMonth()];
    return n;
}

function getDayinWeek() {
    var now = new Date();
   var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
    return days[ now.getDay() ];
}

