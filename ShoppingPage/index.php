<html>


<head>

<script src="js/ver3/aframe.min.js"></script>
<script src="js/ver3/aframe-text-component.min.js"></script>


</head>


<body>

<a-scene>

<a-assets>
	
<?php
  

// Loading Data for the Products

  $prod = array("drum", "dragonite", "luna", "object1"); // name of the product as an array
  $id = array ( 1, 2, 3, 4);
  $scaling = array ("1 1 1",".1 .1 .1",".1 .1 .1", ".1 .1 .1"); // since each object has a dimension
  $folder = array ("drum","dragonite","luna","object1"); 
  $position = array ("-15 5 -3","3 -5 -6","0 3 -6","3 6 -10");
  $title = array ("A Drum", "A Dragonite", "A Luna", "An Object");
  $desc = array ("this is an african drum", "nice dragonite", "nice luna", "a random object");
  $price = array (30, 20, 15.5, 9);


 $num_products = count($prod); // check number of products




/* LOADING STUFF in the CACHE */
  for ($x = 0; $x <= $num_products-1 ; $x++) {
    echo "<a-asset-item id=\"$prod[$x]-obj\" src=\"models/$folder[$x]/$prod[$x].obj\"></a-asset-item>
          <a-asset-item id=\"$prod[$x]-mtl\" src=\"models/$folder[$x]/$prod[$x].mtl\"></a-asset-item>";
  }
?>
</a-assets>

<!-- CURSOR WITH ANIMATION -->
  <a-entity position="0 2.2 4">
    <a-entity camera look-controls wasd-controls>
      <a-entity position="0 0 -3" geometry="primitive: ring; radiusOuter: 0.30;radiusInner: 0.20;" material="color: olive; shader: 
      flat" cursor="maxDistance: 30; fuse: true">
        <a-animation begin="click" easing="ease-in" attribute="scale"
             fill="backwards" from="0.1 0.1 0.1" to="1 1 1" dur="150"></a-animation>
        <a-animation begin="fusing" easing="ease-in" attribute="scale"

             fill="forwards" from="1 1 1" to="0.1 0.1 0.1" dur="1500"></a-animation>
      </a-entity>
    </a-entity>
  </a-entity>


<?php
  

  
// this is a PHP loop that will echo adding a-entity for each model 

for ($y = 0; $y <= $num_products-1 ; $y++) {

echo  "<a-entity bring-to-me id=$id[$y] obj-model=\"obj: #".$prod[$y]."-obj; mtl: #".$prod[$y]."-mtl\" rotation=\"0 0 0\" scale=\"".$scaling[$y]."\" position=\"".$position[$y]."\">
        <a-animation begin=\"click\" attribute=\"rotation\" to=\"0 360 0\" easing=\"linear\" dur=\"2000\" fill=\"backwards\"></a-animation> 
      </a-entity>" ;
}
?>


  <!-- Display some texts about the product-->

    <a-entity id="product_title" text="text: " position="4 2 -3"></a-entity>
    <a-entity id="description" text="text: " position="4 -2 -3"></a-entity>
    <a-entity id="price" text="text: price" position="10 2 -3"></a-entity>

 <!-- Image Buttons to Add to cart, Return and Checkout -->

    <a-image add_to_cart src="images/addtocart.jpg" position="4 4 0"></a-image>
    <a-image return-back src="images/return.jpg" position="6 4 0"></a-image>
    <a-image src="images/checkout.jpg" position="2 4 0" ></a-image>
  

<!-- Showroom Background --> 

<a-sky src="images/showroom.jpg"></a-sky>

</a-scene>

<script>



var selected = 0;                 // selected=0 means nothing is selected, otherwise selected gives the ID of the product selected
var orig_position = "0 0 0";      // This variable stores the origin position to know where to return the product  
var title =[] ;                   // JS variable for Title of products
var desc =[];                     // JS variable for Description of products
var price = [];                   // JS variable for Price of Products
var cart =[];                      // JS variable to store ID of products added to Cart

// Transfer PHP Data to JS

      <?php                  
            for ($i = 0; $i <= $num_products-1 ; $i++) {

              echo "desc.push(\"".$desc[$i]."\");";
               echo "title.push(\"".$title[$i]."\");";
               echo "price.push(\"".$price[$i]."\");";

            }
      ?>

   
console.log (desc);
console.log (title);


AFRAME.registerComponent('bring-to-me', {
  init: function () {
    this.el.addEventListener('click', function () {


      if (selected == 0) {
          orig_position = this.getAttribute('position');
          this.setAttribute('position', "0 0 0");
          selected = this.getAttribute('id');

          var mytitle = document.getElementById("product_title");
          mytitle.setAttribute('text',"text:" + title[selected-1]);
          
          var mydescrip = document.getElementById("description");
          mydescrip.setAttribute('text',"text:" + desc[selected-1]);

          var myprice = document.getElementById("price");
          myprice.setAttribute('text',"text:Price = $" + price[selected-1]);



    }
     
      console.log(selected);
    });
   
}
});


AFRAME.registerComponent('return-back', {
  init: function () {
    this.el.addEventListener('click', function () {
      //var thing = document.querySelector("#drag");
      //thing.setAttribute('position', "0 5 -3");
       if (selected > 0) {
          
          // Find which product is selected and return it to original position  
          var sel_prod_obj = document.getElementById(selected);
          sel_prod_obj.setAttribute ('position',orig_position);

          selected = 0; // This means nothing is selected
          
          // Change Product Title Text to Null
          var mytitle = document.getElementById("product_title");
          mytitle.setAttribute('text',"text:");

          // Change Description Text to Null
          var mydescrip = document.getElementById("description");
          mydescrip.setAttribute('text',"text:");

          // Change Price Text to Null
          var myprice = document.getElementById("price");
          myprice.setAttribute('text',"text:");

       } 


      console.log('you returned the thing!');
    });
   
}
});


AFRAME.registerComponent('add_to_cart', {
  init: function () {
    this.el.addEventListener('click', function () {
  
      if (selected != 0){

        cart.push(selected);

        console.log(cart);
        var jsonStr = JSON.stringify( cart );
        sessionStorage.setItem( "cart", jsonStr );

        console.log(cart);
      }
     

    });
   
}
});

</script>

</body>
</html>