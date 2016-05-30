function validate () 
        {
            clearValidation();
            var ime = document.getElementById("first_name");
            var prezime = document.getElementById("last_name");
            var email = document.getElementById("email");
          
            var validate=true;
           
            var imeString=ime.value;
            var prezimeString=prezime.value;
            var emailString=email.value;

            if(ime.value!= "")
            {   
                var validate1 = true;

                for(var i=0;i<imeString.length;i++)
                {

                    if(imeString[i]=='<' || imeString[i]=='>' || imeString[i]== '/' || imeString[i]== '&#x27'  || imeString[i]== '"')
                    {validate= false;
                        validate1=false;
                    }   

                }

                if(!validate1)
                document.getElementById("validacijaIme").innerHTML="Ne znamo sta je namjera, ali te znakove ne dopustamo." ;

            }

            if(prezime.value!= "")
            {
                var validate1 = true;
                for(var i=0;i<prezimeString.length;i++)
                {

                    if(prezimeString[i]=='<' || prezimeString[i]=='>' || prezimeString[i]== '/' || prezimeString[i]== '&#x27'  || prezimeString[i]== '"')
                   { validate= false;
                    validate1=false;
                }

                }

                if(!validate1)
                document.getElementById("validacijaPrezime").innerHTML="Ne znamo sta je namjera, ali te znakove ne dopustamo." ;

            }

            if(email.value!= "")
            {
                var validate1 = true;
                for(var i=0;i<emailString.length;i++)
                {

                    if(emailString[i]=='<' || emailString[i]=='>' || emailString[i]== '/' || emailString[i]== '&#x27'  || emailString[i]== '"')
                   { validate= false;
                    validate1 = false; 
                }

                }

                if(!validate1)
                document.getElementById("validacijaEmail").innerHTML="Ne znamo sta je namjera, ali te znakove ne dopustamo." ;

            }
            
        

    
            

            if(!validate)
                {

                    return false;

                }



            

        }



function clearValidation() {

document.getElementById("validacijaIme").innerHTML="" ;
document.getElementById("validacijaPrezime").innerHTML="" ;
document.getElementById("validacijaEmail").innerHTML="" ;


}

function validateNoviModel () 
        {
            clearValidationModel();
            var nazivModela = document.getElementById("nazivModela");
          
            var validate=true;
           
            var nazivModelaString=nazivModela.value;
       

            if(nazivModela.value!= "")
            {

                for(var i=0;i<nazivModelaString.length;i++)
                {

                    if(nazivModelaString[i]=='<' || nazivModelaString[i]=='>' || nazivModelaString[i]== '/' || nazivModelaString[i]== '&#x27'  || nazivModelaString[i]== '"')
                    validate= false;
                       

                }

                if(!validate)
                document.getElementById("validacijaNazivModela").innerHTML="Ne znamo sta je namjera, ali te znakove ne dopustamo." ;

            } 
             if(nazivModela.value== "")
            {
                document.getElementById("validacijaNazivModela").innerHTML="Polje Naziv je obavezno." ;
                validate=false;

            }

    
            

            if(!validate)
                {

                    return false;

                }



            

        }

function clearValidationModel() {

document.getElementById("validacijaNazivModela").innerHTML="" ;



}