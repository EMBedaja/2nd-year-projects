<script>
function showResults(str) {
  if (str.length == 0) {
    document.getElementById("search-result").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("search-result").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "products-module/search.php?q=" + str, true);
    xmlhttp.send();
  }
}
</script>
Search <input type="text" id="search" name="search" onkeyup="showResults(this.value)" style="float:right;">
<div id="subcontent">
    <?php
      switch($action){
                case 'create':
                    require_once 'products-module/create-product.php';
                break; 
                case 'modify':
                    require_once 'products-module/modify-product.php';
                break; 
                case 'profile':
                    require_once 'products-module/view-product.php';
                break;
                case 'types':
                    require_once 'products-module/list-product-types.php';
                break;
                default:
                    require_once 'products-module/main.php';
                break; 
            }
    ?>
  </div>