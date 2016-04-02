  function validate () 
        {
            clearValidation();
            var username = document.getElementById("username");
            var email = document.getElementById("email");
            var password1 = document.getElementById("password1");
            var password2 = document.getElementById("password2");
            var validate=true;
            var imaPassworda=true;

            if(username.value== "")
            {
                document.getElementById("validacijaUsername").innerHTML="Polje Username je obavezno!" ;
                validate=false;

            }
            if(email.value== "")
            {
                document.getElementById("validacijaEmail").innerHTML="Polje Email je obavezno!" ;
                validate=false;

            }
            if(password1.value== "")
            {
                document.getElementById("validacijaPassword1").innerHTML="Polje Password je obavezno!" ;
                validate=false;
                imaPassworda=false;

            }
            if(password2.value== "")
            {
                document.getElementById("validacijaPassword2").innerHTML="Polje Potvrdit Password je obavezno!" ;
                validate=false;
                imaPassworda=false;

            }

            if(imaPassworda)
            {
                var validate=checkPasswords();
               
            }

            if(!validate)
                {return false;}



            

        }



function clearValidation() {

document.getElementById("validacijaUsername").innerHTML="" ;
document.getElementById("validacijaEmail").innerHTML="" ;
document.getElementById("validacijaPassword1").innerHTML="" ;
document.getElementById("validacijaPassword2").innerHTML="" ;

}


function checkPasswords () {

   var pass1= document.getElementById("password1");
   var pass2= document.getElementById("password2");



   if(pass1.value!=pass2.value)
    {
        
        document.getElementById("validacijaPassword2").innerHTML="Passwordi se ne podudaraju" ;
        return false;

    }
    else
        return true;

}

function checkFilled() {
var inputVal = document.getElementById("email");
var unos = inputVal.value;
var ima=0;

  
for(var i =0 ; i < unos.length+1; i++)
{
    
    if(unos[i]=='@')
        ima+=1;
}



if (ima == 1) {
    inputVal.style.border = "";
}
else{
    inputVal.style.border = "1px solid red";
}
}