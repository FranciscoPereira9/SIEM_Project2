function openSideBar(){
   // Set css stylling properties when side bar opens
    document.getElementById("menu").style.width="300px";
    document.getElementById("mainbox").style.marginLeft="300px";
    document.getElementById("mainbox").innerHTML="";
   }
function closeSideBar(){
   // Set css stylling properties when side bar closes
   document.getElementById("menu").style.width="0px";
   document.getElementById("mainbox").style.margin="0";
   document.getElementById("mainbox").innerHTML="&#9776;";
  }