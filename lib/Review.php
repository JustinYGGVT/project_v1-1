<?php
class Review {
    public $db = null;

    public function __construct(Database $db) {
        if (!isset($db->con)) return null;
        $this->db = $db;
    }

    public function getReviews($product_id) {

        $result = $this->db->con->query("
            SELECT * FROM reviews 
            INNER JOIN users
            ON reviews.user_id = users.user_id 
            WHERE reviews.product_id = $product_id
        ");

        $resultArray = array();

        while ($review = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArray[] = $review;
        }

        return $resultArray;
    }

    public function addReview($data) {
        $product_id = $this->db->con->real_escape_string($data['product_id']);
        $rating = $this->db->con->real_escape_string($data['rating']);
        $review = $this->db->con->real_escape_string($data['review']);

        $result = $this->db->con->query("
            INSERT INTO reviews (product_id, rating, review) VALUES('$product_id', '$rating', '$review')
        ");

        if ($result) echo 'success';
        else echo 'fail review';

    }

}


?>

