$(document).ready(function(){ 
    // Call function on page start up
    filter_data();
    
    function filter_data() {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'orders_filter';
        var minimum_price = document.getElementById("min_hiden_price").value; // Get filter minimum price value
        var maximum_price = document.getElementById("max_hiden_price").value; // Get filter maximum price value
        var city = document.getElementById("city").value; // Get filter city value
        var order_status = document.getElementById("status").value; // Get filter status value
        // Send AJAX request
        $.ajax({
            url:"../actions/orders_filter.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, city:city, order_status:order_status}, // JSON data to send
            success:function(data){ //callback function
                // Update data on html orders table
                $('.filter_data').html(data);
            }
        });
    }
  
    $('.common_selector').change(function(){ 
        // In case there's a change on .common_selector(filter options) -> call function to filter
          filter_data();
    });
  
    $('#my_slider').slider({
        // Slider JS functionality
          range:true,
          min:0,
          max:5000,
          values:[0, 5000],
          step:10,
          stop:function(event, ui) // On slidding stop event
          {
              // Update price show field in HTML and min and max values
              $('#price_show').html(ui.values[0] + '€ - ' + ui.values[1]+'€');
              $('#min_hiden_price').val(ui.values[0]);
              $('#max_hiden_price').val(ui.values[1]);
              // Call filter data
              filter_data();
          }
    });
  });