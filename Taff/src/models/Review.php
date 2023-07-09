<?php
class Review {
    private $rvw_id;
    private $prod_id;
    private $cus_id;
    private $rvw_review;
    private $rating;
    private $rvw_updated_at;

    public function __construct($rvw_id, $prod_id, $cus_id, $rvw_review, $rating, $rvw_updated_at) {
        $this->rvw_id = $rvw_id;
        $this->prod_id = $prod_id;
        $this->cus_id = $cus_id;
        $this->rvw_review = $rvw_review;
        $this->rating = $rating;
        $this->rvw_updated_at = $rvw_updated_at;
    }

    public function getReviewId() {
        return $this->rvw_id;
    }

    public function getProductId() {
        return $this->prod_id;
    }

    public function getCustomerId() {
        return $this->cus_id;
    }

    public function getReview() {
        return $this->rvw_review;
    }

    public function getRating() {
        return $this->rating;
    }

    public function getUpdatedAt() {
        return $this->rvw_updated_at;
    }

    public function setReviewId($rvw_id) {
        $this->rvw_id = $rvw_id;
    }

    public function setProductId($prod_id) {
        $this->prod_id = $prod_id;
    }

    public function setCustomerId($cus_id) {
        $this->cus_id = $cus_id;
    }

    public function setReview($rvw_review) {
        $this->rvw_review = $rvw_review;
    }

    public function setRating($rating) {
        $this->rating = $rating;
    }

    public function setUpdatedAt($rvw_updated_at) {
        $this->rvw_updated_at = $rvw_updated_at;
    }

    public function getReviewsByProduct($prod_id) {
        include("ConnexionBD.php");
    
        $query = "SELECT * FROM reviews WHERE prod_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $prod_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $reviews = array();
        while ($row = $result->fetch_assoc()) {
          $review = new Review( $rvw_id,$prod_id,$cus_id,$rvw_review,$rating,$rvw_updated_at);
          $review->setReviewId($row['rvw_id']);
          $review->setProductId($row['prod_id']);
          $review->setCustomerId($row['cus_id']);
          $review->setReview($row['rvw_review']);
          $review->setRating($row['rating']);
          $review->setUpdatedAt($row['rvw_updated_at']);
    
          $reviews[] = $review;
        }
    
        $stmt->close();
        $conn->close();
    
        return $reviews;
      }



  public function addReview($prod_id, $cus_id, $rvw_review, $rating) {
    include("ConnexionBD.php");
     
    $query = "INSERT INTO reviews (prod_id, cus_id, rvw_review, rating) VALUES (:prod_id, :cus_id, :rvw_review, :rating)";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':prod_id', $prod_id);
    $stmt->bindValue(':cus_id', $cus_id);
    $stmt->bindValue(':rvw_review', $rvw_review);
    $stmt->bindValue(':rating', $rating);

    $stmt->execute();
  }

  public function updateReview($id, $prod_id, $cus_id, $rvw_review, $rating) {
    include("ConnexionBD.php");
     
    $query = "UPDATE reviews SET prod_id = :prod_id, cus_id = :cus_id, rvw_review = :rvw_review, rating = :rating WHERE rvw_id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':prod_id', $prod_id);
    $stmt->bindValue(':cus_id', $cus_id);
    $stmt->bindValue(':rvw_review', $rvw_review);
    $stmt->bindValue(':rating', $rating);

    $stmt->execute();
  }


  public function deleteReview($id) {
    include("ConnexionBD.php");
        
    $sql = "DELETE FROM reviews WHERE rvw_id = ?";
    $stmt = $this->$conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }
  
}
