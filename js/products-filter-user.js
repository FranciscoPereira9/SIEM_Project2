$(document).ready(function(){ 
  
  function filter_data() {
      $('.filter_data').html('<div id="loading" style="" ></div>');
      var action = 'products_filter';
      var minimum_price = document.getElementById("min_hiden_price").value;
      var maximum_price = document.getElementById("max_hiden_price").value;
      var category = document.getElementById("category").value;
      var color = document.getElementById("color").value;
      var brand = document.getElementById("brand").value;
      // Get gender from url
      const queryString = window.location.search;
      const urlParams = new URLSearchParams(queryString);
      var gender = urlParams.get('gender');
      console.log(gender);
      $.ajax({
          url:"../actions/products_filter_user.php",
          method:"POST",
          data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, category:category, color:color, brand:brand, gender: gender},
          success:function(data){
              $('.filter_data').html(data);
          }
      });
  }

  $('.common_selector').change(function(){
        filter_data();
  });

  $('#my_slider').slider({
        range:true,
        min:0,
        max:1000,
        values:[0, 1000],
        step:10,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#min_hiden_price').val(ui.values[0]);
            $('#max_hiden_price').val(ui.values[1]);
            filter_data();
        }
  });
});