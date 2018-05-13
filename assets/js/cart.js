window.onload = function(){
  let addToCartBtns = document.querySelectorAll('.home .products_list a');

  for(let i = 0; i < addToCartBtns.length; i++){
    let btn = addToCartBtns[i];

    btn.addEventListener('click', function(e){ addToCart(e) });
  }
}

function addToCart(e){
  e.preventDefault();

  let product_id = e.currentTarget.getAttribute("data-product-id");

  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let res = this.responseText.split("<main>")[1].split("</main>")[0];
      alert(res);
    }
  };
  xhr.open("GET", "index.php?page=cart&action=add&product_id=" + product_id, true);
  xhr.send();
}