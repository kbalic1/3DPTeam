var contains = function(needle) {
    // Per spec, the way to identify NaN is that it is not equal to itself
    var findNaN = needle !== needle;
    var indexOf;

    if(!findNaN && typeof Array.prototype.indexOf === 'function') {
        indexOf = Array.prototype.indexOf;
    } else {
        indexOf = function(needle) {
            var i = -1, index = -1;

            for(i = 0; i < this.length; i++) {
                var item = this[i];

                if((findNaN && item !== item) || item === needle) {
                    index = i;
                    break;
                }
            }

            return index;
        };
    }

    return indexOf.call(this, needle) > -1;
};

// niz ukinutih ID-jeva
var ukinuto = [];
// niz stringova (spasavaju se u sesiju)
var ukinutoStr = [];

if(sessionStorage.getItem('ukinuto') != null)
{
	// citanje iz sesije koji su ukinuti
	ukinutoStr = sessionStorage.getItem('ukinuto');
	//console.log("UKINUTO U SESIJI: " + typeof ukinuto);

	// konverzija ukinutih u niz intova kako bi se mogli provjeriti pri iscrtavanju
	var ukinuto = ukinutoStr.split(',').map(function(item) {
    	return parseInt(item);
		});

	//console.log(ukinuto);
}

function profilObjekta(ID)
{
	window.location = "/kontakt.php?ID=" + ID;
}

function ukini(ID)
{
	// ukini prikazivanje
	ukinuto.push(ID);
	sessionStorage.setItem('ukinuto', ukinuto);
}

$( document ).ready(function() {
    
    

	var provjeriKomentareKorisnika = setInterval(function(){

		$.ajax({
			  method: "GET",
			  url: "provjeraNovihKomentara.php",
			  contentType: "application/json"
			})
			  .success(function(result)
			  {
			  	var nizObjekataSaKomentarima = JSON.parse(result);
			  	//console.log("success: " + nizObjekataSaKomentarima[0].Naziv);

			  	document.getElementById("notifikacije").innerHTML = "";

			  	for(var i = 0; i < nizObjekataSaKomentarima.length; i++)
			  	{
			  		//console.log("objekat: " + nizObjekataSaKomentarima[i].Naziv);


			  		//console.log("OBJEKATID: " + parseInt(nizObjekataSaKomentarima[i].ObjekatID));

			  		//if($.inArray(parseInt(nizObjekataSaKomentarima[i].ObjekatID), ukinuto))
			  			//alert("IMA");

			  		if(contains.call(ukinuto, parseInt(nizObjekataSaKomentarima[i].ObjekatID)))
			  			continue;

			  		var notifikacija = document.createElement('div');
			  		notifikacija.className = 'row';
			  		//notifikacija.className += ' notifikacijaStil';

			  		notifikacija.innerHTML = "<div class='alert alert-info fade in'>" +
			  			"<a href='#' onclick='profilObjekta("+nizObjekataSaKomentarima[i].ObjekatID+");'>" + nizObjekataSaKomentarima[i].Naziv + "</a>" +
					    "<a href='#' onclick='ukini("+nizObjekataSaKomentarima[i].ObjekatID+");' class='close' data-dismiss='alert' aria-label='close'>&times;</a><br />" + 
					    " Imate " + nizObjekataSaKomentarima[i].BrojNovihKomentara +  
					    " novih komentara za model</div> "; 

					document.getElementById("notifikacije").appendChild(notifikacija);
			  	}
			  	var nesto = "avbas";

			  })
			  .fail(function(message)
			  {
			  	console.log("error: " + message);
			  });
	}, 2000);

});



/*
<div class="alert alert-info fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Info!</strong> This alert box could indicate a neutral informative change or action.
  </div> */