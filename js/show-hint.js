
// SEARCH BAR FUNCTIONS --- ALL VERY ALIKE
// Everytime someone writes on search bar (onkeyup) there's one of these function that is called
// according to the file where it is called.

 function showUsersSearch(str) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // Where to write reponse
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  // Send info on URL (GET method) with parameter q = (word beeing written in search bar)
  xmlhttp.open("GET", "../actions/getUsersFiltered.php?q=" + str, true);
  // getUsersFiltered.php echoes data to be shown
  xmlhttp.send();
}

function showProductsSearch(str) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // Where to write reponse
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  // Send info on URL (GET method) with parameter q = (word beeing written in search bar)
  xmlhttp.open("GET", "../actions/getProductsFiltered.php?q=" + str, true);
  // getProductsFiltered.php echoes data to be shown
  xmlhttp.send();
}

function showOrdersSearch(str) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // Where to write reponse
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  // Send info on URL (GET method) with parameter q = (word beeing written in search bar)
  xmlhttp.open("GET", "../actions/getOrdersFiltered.php?q=" + str, true);
  // getOrdersFiltered.php echoes data to be shown
  xmlhttp.send();
}

function showUserProductsSearch(str) {
  // Get gender from url
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  var gender = urlParams.get('gender');

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // Where to write reponse
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  // If gender is Men, call getMenProductsFiltered.php, Else call getWomenProductsFiltered.php
  if(gender == "Men"){
    // Send info on URL (GET method) with parameter q = (word beeing written in search bar)
    xmlhttp.open("GET", "../actions/getMenProductsFiltered.php?q=" + str, true);
    // getMenProductsFiltered.php echoes data to be shown
    xmlhttp.send();
  }
  else{
    // Send info on URL (GET method) with parameter q = (word beeing written in search bar)
    xmlhttp.open("GET", "../actions/getWomenProductsFiltered.php?q=" + str, true);
    // getWomenProductsFiltered.php echoes data to be shown
    xmlhttp.send();
  }
  
  
}