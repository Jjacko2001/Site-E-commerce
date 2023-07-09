<?php

$conn = mysqli_connect("localhost", "root", "", "jourya");
$query = "SELECT prod_img FROM product WHERE cat_id = 24";
$stmt = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($stmt)) {
    $prodImg = $row['prod_img'];
    echo "<div style='display: inline-block; margin-right: 10px;'>
    <img src='$prodImg' alt='Product Image'></div>";
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .image-container {
      display: flex;
      flex-wrap: wrap;
    }
  
    .image-container img {
      flex: 0 0 25%;
      margin: 5px;
    }
  
    @media screen and (max-width: 768px) {
      .image-container img {
        flex: 0 0 50%;
      }
    }
  
    @media screen and (max-width: 480px) {
      .image-container img {
        flex: 0 0 100%;
      }
    }
  </style>
</head>
<body>
    
</body>
</html>
