<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Website</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
    <link 
       rel="stylesheet" 
       href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"
    />
</head>

<body>
    
<?php 

$conn = mysqli_connect("localhost","root","","jourya");


require_once("Product.php");

    $query = "SELECT prod_img FROM product WHERE prod_id = 25 ";
    $stmt = mysqli_query($conn,$query);
    
    $products = array(); 
    while ($row = mysqli_fetch_assoc($stmt)) {
      $prod = new Product($row['prod_id'], $row['prod_name'], $row['prod_desc'], $row['prod_price'], $row['prod_qte_dispo'], $row['prod_img'], $row['cat_id']);
      array_push($products, $prod);
    }
    
    mysqli_close($conn); 
    return $products;
    
 foreach ($produits as $prod) {?>                                
    <div class="products main flexwrap">
        <div class="item">
            <div class="media"> 
                <div class="thumbnail object-cover">
                    <a href="#"><img src="<?php echo $prod->getProdImg();?>" alt=""></a>
                </div>
                <div class="hoverable">
                    <ul>
                        <li class="active"><a href="#"><i class="ri-heart-line"></i></a></li>
                        <li><a href=""><i class="ri-eye-line"></i></a></li>
                    </ul>
                </div>
                <div class="discount circle flexcenter"><span>25%</span></div>
            </div>
            <div class="content">
                <div class="rating">
                    <div class="stars"></div>
                    <span class="mini-text"><?php echo $prod->getProdPrix();?></span>
                </div>
                <h3 class="main-links"><a href="#"><?php $prod->getProdName()?></a></h3>
                <div class="price">
                    <span class="current">$37.50</span>
                    <span class="normal mini-text">$45.50</span>
                </div>
                <!--  additional structure  -->
                <div class="footer">
                    <ul class="mini-text">
                        <li>Polyster, Cotton</li>
                        <li>Pull On closure</li>
                        <li>Fashion Personality</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php }?>
</body>   