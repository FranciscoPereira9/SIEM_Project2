$(document).ready(function(){ 
    change_price();
    change_total_price();

    $('.common_selector').change(function(){
        change_price();
        change_total_price();
    });
    
    function change_price() {
        var action = 'cart';
        var table = document.getElementById("table-left");

        for (var i = 0, row; row = table.rows[i]; i++) {
        //iterate through rows
        //rows would be accessed using the "row" variable assigned in the for loop
            for (var j = 0, col; col = row.cells[j]; j++) {
                //iterate through columns
                //columns would be accessed using the "col" variable assigned in the for loop
                if(j==2){
                    n_products = document.getElementById('quantity'+i).value;
                }
                
            }
            $.ajax({
                url:"../actions/displayCartPrice.php",
                method:"POST",
                data:{action:action, item: i, quantity: n_products},
                async: false,
                success:function(data){
                    document.getElementById('price_multiplied'+(i)).innerHTML = data;
                    
                }
            });  

        }

    }

    function  change_total_price(){
        total = 0;
        var table = document.getElementById("table-left");
        for (var i = 0, row; row = table.rows[i]; i++) { 
            str = document.getElementById('price_multiplied'+i).innerHTML;
            str = str.replace('<b>','');
            price = str.replace(' €</b>','');
            price= parseFloat(price);
            total += price;
        }
        total = Number((total).toFixed(2));
        document.getElementById('items_price').innerHTML = "<b>"+String(total)+" €</b>";
        document.getElementById('total_price').innerHTML = "<b>"+String(total)+" €</b>";
    };
});
  