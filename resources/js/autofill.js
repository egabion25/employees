

  var firstnames = [  [ "Eunice","Princess", "Cristina", "Joana","Grace","Carmie","April","Keith","Maan","Nora","Nining","Hazel", "Alpha", "Cherry","Rose","Apple","Lorraine","Kristel","Anna","Eleonor","Luisa","Roxanne", "Marilou","Cherilou", "Anne","Lorie","Jean","Bernadette","Jenny", "Cory","Geraldine","Vianne", "Corazon","Jane","Kara", "Kara", "Kris", "Isabel", "Iza", "May", "Natalie", "Sofia", "Angeline", "Jedah", "Gizelle", "Norielle", "Rosaura", "Joana", "Desiree", "Jenifer", "Jemmah", "Esther", "Miriam", "Maureen", "Kath", "Catherine", "Katrina", "Mae", "Judy", "Liza", "Valerie", "Solenn" ],
  [ "Willie","Ferdie","Manuel","Emilio","Fidel","Diosdado","Ramon","Carlos","Peter","Robin","Nico","Kevin","Rey","Lourd","Ron", "Bennie","Edward","Russell","Eddie","Sean","Art","Bayani","Michael","Gerald","Aries","Robert","Ruben","Sonny","Ryan","Joshua","Lawrence","Jerome","Mike", "Erick", "Eugenio", "Constante", "Linus", "Vernie", "Louie", "Rody", "Jose", "Procorpio", "Andres", "Andrew", "Marcelo", "Gregorio", "Genesis", "Eleazar", "David", "Itamar", "Fernando", "Ferdinand", "Erwin", "Alfred", "Alfred", "Frederic", "Richard", "Ricardo", "Rommel", "Emmnanuel", "Cesar", "Julius", "James", "Mateo", "Mark", "Luke", "John", "Romeo", "Jude", "Christian", "Daniel", "Ezekiel", "Thomas", "Herbert", "Moises" ], 
  ];

  var lastnames = [ "dela Cruz","Rios","Aratan","Madolid","Arismendi","Bagis","Tasoy","Sinsay","Guro","Bigtas","Taglinao","Tulao","Cabading","Sugatan","Alonsagay","Sangalang","Malinao","Manalang","Kayanan","Ibong","Baladad","Camingay","Solis","Muyot","Pipit","Cabuhat","Parani","Pitagan","Bagnas","Pitagan","Dumalugdog","Postigo","Guray","Datoy","Lomaad","Bagalawis","Tinsay","Baon","Pulido","Muldong","Macarandan","Revillme","Dumale","Balanay","Gamban","Pingol","Pugay","Camama","Lapid","Bandong","Mangalindan","Calica","Guinto","Abad","Valenciano","Alinan","Bayod","Dausan","Dacanay","Puno","Cabantac","Magboo","Manibay","Ligaya","Tupas","Satsatin","Lasatin","Magtoto","Lubigan","Tamayo","Bautista","Dayao","Manalastas","Puspos","Gacutan","Gabion","Reyes","Dones","Cruz","Gutierrez","Barcelona","Bulawit","Salita","Rosco","Cabera","Cabatbat","Ong","Curtis","Catalino","Dellosa","Guevarra","Guerrero","Peregrina","Perez","Pelaez","Potente","Perolino","Arbues","Sanchez","Arao","Bulan","Buan","Bauan","Ilagan","Catacutan","Dimaisip","Dimaculangan","Macaspac","Cunanan","Ubas","Asiman","Ilang-ilang" ];





  function randomize( min, max ){
    return  Math.floor(Math.random() * (max - min + 1) + min);
  }


  function getFirstName( gender ){
    var max = firstnames[ gender ].length - 1;

    var firstname = firstnames[ gender ][ randomize(0,max) ];

    if( secondName() ){
      firstname = firstname + " " + firstnames[ gender ][ randomize(0,max)  ];
    }

    return firstname;
  }

  function getLastName(){
    return lastnames[ randomize(0,lastnames.length-1) ];
  }

  function gender(){

    var probability  =  [ 
                           ["0","50"] // Female
                          ,["1","50"]  // Male
                        ];

    return iterateItems( probability );
  }

  function user_status(){

    var probability  =  [ 
                           ["active","90"]
                          ,["inactive","7"] 
                          ,["blocked","3"]
                        ];

    return iterateItems( probability );
  }

  function iterateItems( probability ){

    var iterations = [];
    var max = 0; 
    $.each(probability, function( index, value ) {
      max = max + (value[1]*1);
      for (var i = 1; i <= value[1]; i++) {
          iterations.push(value[0]);
      }

    });

    return  iterations[randomize(0,max)]; 
  }

  function secondName(){
     var probability  =  [ 
                           ["1","50"]
                          ,["0","50"] 
                        ];
    return iterateItems( probability );
  }

  function fullName(){
    return  getFirstName( gender() ) + " " + getLastName();
  }

  function birthdate(){
    return  randomize(1975,2000) + "-" + randomize(1,12) + "-" +  randomize(1,28); 
  }



$(document).ready( function(){

    $(".autofill-button").click(function(e){
     e.preventDefault();

      var auto_gender =  gender();
        $(".autofill-firstname").val( getFirstName( auto_gender ) );
        $(".autofill-middlename").val( getLastName() );
        $(".autofill-lastname").val( getLastName() );
        $(".autofill-date").val( birthdate() );

        $('.autofill-user-status option[value='+ user_status() +' ]').prop('selected', true);
        $('.autofill-bit option[value='+ auto_gender +' ]').prop('selected', true);






          $(".autofill-user option").length - 1;




          // $(".autofill-user option").each(  function( index, value ) {
          //     console.log(  $(value) );
          // })


    });









})