$.ajax({
    url: "/productos",
    data: {
     
    },
    success: function( result ) {
        console.log(result);
      $( "#weather-temp" ).html( "<strong>" + result + "</strong> degrees" );
    }
  });