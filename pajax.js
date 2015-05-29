



function checkUsername()
{
    var name=document.getElementById("loginuser").value;
  
    
    var xmlhttp;    
    if (name=="")
        {
        document.getElementById("ajaxcheck").innerHTML="";
        return;
        }
    if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
        }
    else
        {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
    xmlhttp.onreadystatechange=function()
        {
           
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
            document.getElementById("ajaxcheck").innerHTML=xmlhttp.responseText;
            }
        }
   
    xmlhttp.open("GET","checkuser.php?username="+name,true);
    xmlhttp.send();
    
    
    
    
}

function checkyear()
    {
      
        
       var year = document.getElementById("yearcheck").value;
        
    var xmlhttp;    
    if (year=="")
        {
        document.getElementById("error").innerHTML="";
        return;
        }
    if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
        }
    else
        {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
    xmlhttp.onreadystatechange=function()
        {
           
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
            document.getElementById("error").innerHTML=xmlhttp.responseText;
            }
        }
   
    xmlhttp.open("GET","checkyear.php?inputyear="+year,true);
    xmlhttp.send();
   
        
    }

function checklogpass()
    {
      
    var login = document.getElementById("logmyuser").value;
    var password = document.getElementById("logmypass").value;
        
    var xmlhttp;    
    if (password=="")
        {
        document.getElementById("warning").innerHTML="";
        return;
        }
    if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
        }
    else
        {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
    xmlhttp.onreadystatechange=function()
        {
           
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
            document.getElementById("warning").innerHTML=xmlhttp.responseText;       
            
            }
        }
   
    xmlhttp.open("GET","checklogpass.php?userid="+login+"&pass="+password,true);
    xmlhttp.send();

        
    }

function checkfuel()

{
    var type=document.getElementById("costtype").value;   
    var input = document.createElement("INPUT");
    
    if(type == 'fuel')
        {
    
        input.placeholder="Gallons"
        input.type="text";
        input.size="9";
        input.value="";
        input.name="gallons";
        document.getElementById("belowtotalcost").appendChild(input);              
        }
    else
    {
      document.getElementById("totalcost").removeChild(input);         
        
    } 

}


function showexpenses()
{  
      
    if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
        }
    else
        {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
    xmlhttp.onreadystatechange=function()
        {
           
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
            document.getElementById("showRecentExp").innerHTML=xmlhttp.responseText;
            }
        }
   
    xmlhttp.open("GET","recentexpense.php",true);
    xmlhttp.send();
    

    
}


function searchGas()
        
    {
              
        var lat = document.getElementById("geoposition1a").value;
        var lon = document.getElementById("geoposition1b").value;
       
        var url = "http://api.mygasfeed.com/stations/radius/" + lat + "/" + lon + "/10/reg/price/ksgd4obbpm.json";
       
        
        httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange = waiting;        
        httpRequest.open('GET', url, true);        
        
        httpRequest.send(null);             
        
        
    }

	function waiting()
	
	{
	    if(httpRequest.readyState == 4 && httpRequest.status == 200)
	    {
	    
	    var parsedData = JSON.parse(httpRequest.responseText);	    
	    displayResults(parsedData);
	    }
	    
	}



	function displayResults (gistArray)
	
	    {
	       
	        
	        var tableTop = document.getElementById("base");
            //clear old data
            tableTop.innerHTML = "";
	        var tbl     = document.createElement("table");
            tbl.border = "1";
            tbl.className="expensetable";
	        var tblBody = document.createElement("tbody");
            
            var hrow = document.createElement("tr");
            
            var h1= document.createElement("th");
            var h1t=document.createTextNode("Station");
            h1.appendChild(h1t);
            hrow.appendChild(h1);
            var h2= document.createElement("th");
            var h2t=document.createTextNode("PPG");
            h2.appendChild(h2t);
            hrow.appendChild(h2);
            var h3= document.createElement("th");
            var h3t=document.createTextNode("Address");
            h3.appendChild(h3t);
            hrow.appendChild(h3);
            var h4= document.createElement("th");
            var h4t=document.createTextNode("City");
            h4.appendChild(h4t);
            hrow.appendChild(h4);
            var h5= document.createElement("th");
            var h5t=document.createTextNode("State");
            h5.appendChild(h5t);
            hrow.appendChild(h5);
            var h6= document.createElement("th");
            var h6t=document.createTextNode("Zip");
            h6.appendChild(h6t);
            hrow.appendChild(h6);
            
            tblBody.appendChild(hrow);
            
	        
	        
	        for(var i =0;i<30;i++)
	        {
	            
	            //CHECK IF GAS PRICE IS AVAILABLE
                if (gistArray.stations[i].reg_price != "N/A")
                    {
                        
                        var row = document.createElement("tr");   
                       //station Name
                       var cell1 = document.createElement("td");
                       var cell1t = document.createTextNode(gistArray.stations[i].station);
                      
                       
                       //Price of Gas
                       var cell2 = document.createElement("td");
                       var cell2t = document.createTextNode("$  " + gistArray.stations[i].reg_price);
                   
                       
                       //Address
                       var cell3 = document.createElement("td");
                       var cell3t = document.createTextNode(gistArray.stations[i].address);
                       
                        //City
                       var cell4 = document.createElement("td");
                       var cell4t = document.createTextNode(gistArray.stations[i].city);
                       
                        //State
                       var cell5 = document.createElement("td");
                       var cell5t = document.createTextNode(gistArray.stations[i].region);
                       
                        //zip
                       var cell6 = document.createElement("td");
                       var cell6t = document.createTextNode(gistArray.stations[i].zip);
                       

          
                       //add text to cells
                       cell1.appendChild(cell1t);
                       cell2.appendChild(cell2t);
                       cell3.appendChild(cell3t);
                       cell4.appendChild(cell4t);
                       cell5.appendChild(cell5t);
                       cell6.appendChild(cell6t);
                                   
                       

                       
                       //add cells to row
                       row.appendChild(cell1);
                       row.appendChild(cell2);
                       row.appendChild(cell3);
                       row.appendChild(cell4);
                       row.appendChild(cell5);
                       row.appendChild(cell6);
                       
                       
                       tblBody.appendChild(row);
                    }
	        }
	        
	        //add rows to main table
	       
	        tbl.appendChild(tblBody);
	        tableTop.appendChild(tbl);     
	        
	        
	        
	    }


     function lookupGeoData() {            
            myGeoPositionGeoPicker({
                startAddress     : 'White House, Washington',
                returnFieldMap   : {
                                     'geoposition1a' : '<LAT>',
                                     'geoposition1b' : '<LNG>',
                                     'geoposition1c' : '<CITY>',   /* ...or <COUNTRY>, <STATE>, <DISTRICT>,
                                                                           <CITY>, <SUBURB>, <ZIP>, <STREET>, <STREETNUMBER> */
                                     'geoposition1d' : '<ADDRESS>'
                                   }
            });
        }









