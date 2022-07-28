#here is ajax functionality that provide data for daft product like name, image,price etc. 

var product_final_price = document.querySelector('.product-right-pricecontent .product-price').getAttribute('data-finalprice'),
        productName =  document.querySelector('.product-title').textContent,
      product_prop =  document.querySelectorAll('.side-menu-items p'),
          product_img = 'https:'+'{{ product.featured_image | img_url : "master" }}';
  
    console.log(product_final_price);
    var uri = "http://ah-portfolio.cloudaccess.host/shopify-api/167-SD";
        $.ajax({
        type:"get",
        url:uri+"/create_product.php",
        data:{product_final_price:product_final_price,
             productName:productName,
             product_img:product_img
             },
        success: function(response){
         var response_date = JSON.parse(response);
          var property = [];
          product_prop.forEach((productProp, e) => {
            var prop = productProp.querySelector('input').getAttribute('value');
            property.push(prop);
          });
          var final_props = property.join(',');
          
          var newProduct_variant_id =response_date.product.variants[0].id;
                 $.ajax({
            type: 'POST', 
            url: '/cart/add.js',
            dataType: 'json', 
            data: {
                  id:newProduct_variant_id,
                  quantity:1,
                  properties: {final_props}},
                  success: function(data){
            window.location.href='/cart';
            }
         });          
        }
      });
