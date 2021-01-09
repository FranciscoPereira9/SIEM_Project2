$(document).ready(function(){ 
    // Call functions to change price of single product
    change_price();
    // Call functions to change price of total products
    change_total_price();

    $('.common_selector').change(function(){
        // In case there's a change on .common_selector(input up and down prices) -> call functions to change price
        change_price();
        change_total_price();
    });
    
    function change_price() {
        var action = 'cart';
        var table = document.getElementById("table-left"); // Get HTML table with cart products

        for (var i = 0, row; row = table.rows[i]; i++) {
        //iterate through rows
        //rows would be accessed using the "row" variable assigned in the for loop
            for (var j = 0, col; col = row.cells[j]; j++) {
                //iterate through columns
                //columns would be accessed using the "col" variable assigned in the for loop
                if(j==2){
                    // Get the quantity element on column with index 2
                    n_products = document.getElementById('quantity'+i).value;
                }
                
            }
            // Send AJAX request
            $.ajax({
                url:"../actions/displayCartPrice.php",
                method:"POST",
                data:{action:action, item: i, quantity: n_products}, // JSON data to send
                async: false, // Set assynchronous to false -> wait for callback function
                success:function(data){
                    // Update price in single items 
                    document.getElementById('price_multiplied'+(i)).innerHTML = data;
                }
            });  

        }

    }

    function  change_total_price(){
        total = 0;
        var table = document.getElementById("table-left"); // Get HTML table with cart products

        for (var i = 0, row; row = table.rows[i]; i++) { 
            //iterate through rows
            //rows would be accessed using the "row" variable assigned in the for loop
            // Get the price of each single item
            str = document.getElementById('price_multiplied'+i).innerHTML;
            str = str.replace('<b>','');
            price = str.replace(' €</b>','');
            price= parseFloat(price);
            // Sum items price
            total += price;
        }
        total = Number((total).toFixed(2)); // Truncate float value to 2 decimal values
        document.getElementById('items_price').innerHTML = "<b>"+String(total)+" €</b>"; // Update total items price
        document.getElementById('total_price').innerHTML = "<b>"+String(total)+" €</b>"; // Update total price
    };
});
  