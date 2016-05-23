function dobaviPozivniBroj(dvoslovniKod)
{
    var ajax = new XMLHttpRequest();

    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200)
        {

            var json = ajax.responseText;
            var pozivniBroj = JSON.parse(json);
            var pozivniBrojDrzave = pozivniBroj[0].callingCodes;

            document.getElementById("brojTelefona").value = "+ " + pozivniBrojDrzave + " ";
            document.getElementById("brojTelefona").focus();

            //document.getElementById("brojTelefona").innerHTML = pozivniBrojDrzave + "/";
        }
            
        if (ajax.readyState == 4 && ajax.status == 404)
            alert("GREŠKA!!! Molimo pokušajte kasnije.");
            
    }

    ajax.open("GET", "https://restcountries.eu/rest/v1/alpha?codes=" + dvoslovniKod, true);
    ajax.send();
}