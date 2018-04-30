/*
   JavaScript & AJAX
   Developed By: Anita Mirshahi, Suim Park, Valini Rangasamy
   Developed Date:   21 April, 2018

*/

/**
 * 
 */

function click_checkbox(category_count, brand_count){
    var categories = "";
    for(var i=1; i <= category_count; i++){
        var ckb = document.getElementById("formCheck-"+i);

        if (ckb.checked == true){
            if (categories !== "")
                categories += "+";
            categories+=document.getElementById("formCheck-"+i).title;
        }
    }

    var brands = "";
    for(var i=category_count+1; i <= brand_count; i++){
        var ckb = document.getElementById("formCheck-"+i);

        if (ckb.checked == true){
            if (brands !== "")
                brands += "+";
            brands += document.getElementById("formCheck-"+i).title;
        }
    }

    window.alert("Category:" + categories + ", Brand:" + brands);
    
    
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("filter_list").innerHTML = this.responseText;
        }
    };
    //xhttp.open("GET", "../index.php?content=catalog_page&category=&brand=&page=2", true);
    xhttp.open("GET", "contents/catalog_sidebar_filter_div.php?content=catalog_page&category=" + categories +"&brand=" + brands + "&page=1", true);

    xhttp.send();
    
//    sleep(1000);
   
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("product_list").innerHTML = this.responseText;
        }
    };
    //xhttp.open("GET", "../index.php?content=catalog_page&category=&brand=&page=2", true);
    xhttp.open("GET", "contents/catalog_products_div.php?content=catalog_page&category=" + categories +"&brand=" + brands + "&page=1", true);

    xhttp.send();
    
}