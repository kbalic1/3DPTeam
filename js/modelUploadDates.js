var hourExpression = ["","sat","sata","sata","sata","sati","sati","sati","sati","sati"];

var dateTimeArray = [];
var uploadTextArray = [];

window.onload = function()
{
	// postavljanje backcolor filtera na svi modeli
	document.getElementById("ulFilter").getElementsByTagName("li")[0].style.backgroundColor = "#F05F40";

	dateTimeArray = document.getElementsByClassName("uploadDateTime");
	uploadTextArray = document.getElementsByClassName("uploadedAgo");

	for(var i = 0; i< dateTimeArray.length; i++)
	{		
	    uploadTextArray[i].innerHTML = getTextForDate(dateTimeArray[i].value);
	}
}

function getDifferenceFromNowInSeconds(date)
{
	var dateValue = new Date(date)
	var dateNow = new Date();
	var differenceSeconds = (dateNow.getTime() - dateValue.getTime())/1000;

	return differenceSeconds;
}

function isOlderThanDay(date) {

	var differenceSeconds = getDifferenceFromNowInSeconds(date);
	if(Math.round(differenceSeconds) <= 60*60*24) return false;
	else return true;	
}

function isOlderThanWeek(date) {
	var differenceSeconds = getDifferenceFromNowInSeconds(date);

	if(Math.round(differenceSeconds) <= 60*60*24*7) return false;
	else return true;	
}

function isOlderThanMonth(date) {
	var differenceSeconds = getDifferenceFromNowInSeconds(date);

	if(Math.round(differenceSeconds) <= 60*60*24*30) return false;
	else return true;	
}

function isInThisDay(date)
{
	var dateValue = new Date(date);
	var today = new Date();
	today.setHours(0,0,0,0);

	return (dateValue.getTime() > today.getTime())
}

function isInThisWeek(date)
{
	var mondayThisWeek = getMonday(new Date());
	var dateValue = new Date(date);

	return (dateValue.getTime() > mondayThisWeek.getTime())
}

function isInThisMonth(date)
{
	var firstDayOfMonth = new Date();
	var dateValue = new Date(date);
	firstDayOfMonth.setDate(1);
	firstDayOfMonth.setHours(0,0,0,0);

	return (dateValue.getTime() > firstDayOfMonth.getTime())
}

function getMonday(d) {
  d = new Date(d);
  var day = d.getDay(),
      diff = d.getDate() - day + (day == 0 ? -6:1); // adjust when day is sunday
  return new Date(d.setDate(diff));
}

function getTextForDate(date) {

	var differenceSeconds = getDifferenceFromNowInSeconds(date);
	var dateValue = new Date(date)

	var text = "";
	if(differenceSeconds < 60)
	{
		var lastDigit = Math.round(differenceSeconds) % 10;
		text = "Model uploadovan prije par sekundi.";
	}
	else if(differenceSeconds >= 60 && differenceSeconds < 60*60)
	{
		var minutes = Math.round(differenceSeconds/60);		
		text = "Model uploadovan prije " + minutes + " minuta.";
	}
	else if(differenceSeconds >= 60*60 && differenceSeconds < 24*60*60)
	{
		var hours = Math.round(differenceSeconds/(60*60));

		if(hours < 10)		
			text = "Model uploadovan prije " + hours + " " + hourExpression[hours % 10]+".";
		else if(hours >= 10 && hours <= 20)
			text = "Model uploadovan prije " + hours + " sati.";
		else
		{
			text = "Model uploadovan prije " + hours + " " + hourExpression[hours % 10]+".";
		}
	}
	else if(differenceSeconds >= 24*60*60 && differenceSeconds < 24*60*60*7)
	{
		var days = Math.round(differenceSeconds/(60*60*24));

		if(days <= 1)		
			text = "Model uploadovan prije " + days + " dan";
		else
		{
			text = "Model uploadovan prije " + days + " dana";
		}
	}
	else if(differenceSeconds >= 24*60*60*7 && differenceSeconds < 24*60*60*30)
	{
		var weeks = Math.round(differenceSeconds/(60*60*24*7));

		if(weeks <= 1)		
			text = "Model uploadovan prije " + weeks + " sedmicu";
		else
		{
			text = "Model uploadovan prije " + weeks + " sedmice";
		}
	}
	else
		text = "Objavljeno datuma: " + dateValue.getDate() + "." + dateValue.getMonth() + 1 + "." + dateValue.getFullYear() + ".";

	return text;
}

function loadModels() {
    document.getElementById("loading").style.display = "none";
    document.getElementById("models").style.display = "block";
}

function filterModels(e, displayType) {

	document.getElementById("models").style.display = "none";
	document.getElementById("loading").style.display = "block";

	var unorderedList = e.parentElement.getElementsByTagName("li");

	for(var i = 0; i< unorderedList.length; i++)
	{		
	    unorderedList[i].style.backgroundColor = "#E2E2E2";
	}

	e.style.backgroundColor = "#F05F40";

    if(displayType == 2)
    {
		for(var i = 0; i< dateTimeArray.length; i++)
		{
			if(isInThisDay(dateTimeArray[i].value))
				uploadTextArray[i].parentElement.parentElement.parentElement.style.display = "block"
			else
				uploadTextArray[i].parentElement.parentElement.parentElement.style.display = "none"
		}
    }
    else if(displayType == 3)
    {
		for(var i = 0; i< dateTimeArray.length; i++)
		{
			if(isInThisWeek(dateTimeArray[i].value))
				uploadTextArray[i].parentElement.parentElement.parentElement.style.display = "block"
			else
				uploadTextArray[i].parentElement.parentElement.parentElement.style.display = "none"
		}
    }
    else if(displayType == 4)
    {
		for(var i = 0; i< dateTimeArray.length; i++)
		{
			if(isInThisMonth(dateTimeArray[i].value))
				uploadTextArray[i].parentElement.parentElement.parentElement.style.display = "block"
			else
				uploadTextArray[i].parentElement.parentElement.parentElement.style.display = "none"
		}    	
    }
    else
    {
		for(var i = 0; i< dateTimeArray.length; i++)
		{
			uploadTextArray[i].parentElement.parentElement.parentElement.style.display = "block"
		}
    }
    
    setTimeout(loadModels,300);
}