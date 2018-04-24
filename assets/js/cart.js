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

  /*fetch('index.php?page=cart&action=add', {
    method: 'POST',
    headers: {
      'Accept': 'text/plain',
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({product_id : product_id}),
  })
  .then((res) => res.text())
  .then((response) => {
    if(response === 'server error'){
      alert("an error occurred on the server");
    }
    else{
      console.log("response", response);
      alert("success ", response);
    }
  })
  .catch((error) => console.log("an error occurred", error));*/


  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let res = this.responseText.split("<main>")[1].split("</main>")[0];
      alert(res);
    }
  };
  xmlhttp.open("GET", "index.php?page=cart&action=add&product_id=" + product_id, true);
  xmlhttp.send();
}