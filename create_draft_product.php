<?php

header("Access-Control-Allow-Origin: *");


  $product_final_price =trim($_GET['product_final_price']);
  $productName =trim($_GET['productName']);
  $product_img =trim($_GET['product_img']);

    //$product_name = $product_title.' '.'installation');

        $product = array(
                "product"=>array(
                "title"=> $productName,
                "status"=> "active",
                "tags" => "draft",
                "variants"=>array(
                    array(  
                    "price" => $product_final_price
                    )
                    ),
                    "images"=> array(
                      array(  
                      "src" => $product_img
                      )
                  
                  )
                )
            );
    // Add new product.
    $add_cus = add_new_product($product);   
   


// Add product API(API version: 2020-10)
 function add_new_product($product)
 {
     $data_string = json_encode($product);
     $url= "https://88a63178ccad61f69cb5ab1fdc6eea54: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@tribuscard.myshopify.com/admin/api/2022-01/products.json";
        // print_r($url);

     $ch = curl_init($url);
     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
             'Content-Type: application/json',
             'Content-Length: ' . strlen($data_string))
     );

     curl_setopt($ch, CURLOPT_POST, 1);
     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
     curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     $result = curl_exec($ch);
     curl_close($ch);

 	echo $result;
 }
 
?>	
