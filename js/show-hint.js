
 function showUsersSearch(str) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "../actions/getUsersFiltered.php?q=" + str, true);
  xmlhttp.send();
}

function showProductsSearch(str) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "../actions/getProductsFiltered.php?q=" + str, true);
  xmlhttp.send();
}

function showOrdersSearch(str) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "../actions/getOrdersFiltered.php?q=" + str, true);
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
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  if(gender == "Men"){
    xmlhttp.open("GET", "../actions/getMenProductsFiltered.php?q=" + str, true);
    xmlhttp.send();
  }
  else{
    xmlhttp.open("GET", "../actions/getWomenProductsFiltered.php?q=" + str, true);
    xmlhttp.send();
  }
  
  
}