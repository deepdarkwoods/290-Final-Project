

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
        document.getElementById("expenseform").appendChild(input);   

            
        }
    else
    {
      document.getElementById("expenseform").removeChild(input);         
        
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


















