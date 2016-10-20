<?php
    require_once('gateway.php');
    
    class Review {
        public function __construct() {
            $this->gateway = Gateway::getInstance();
        }
        
        // Post review
        public function postReview($userId, $vacId, $title, $body, $rating) {
            $sql = 'CALL post_review(:userId, :vacId, :title, :body, :rating)';
            $params = array(':userId'=>$userId, ':vacId'=>$vacId, ':title'=>$title,':body'=>$body, ':rating'=>$rating);
            
            try { $this->gateway->bindParams($sql, $params); }
            catch (Exception $e) { throw new Exception($e->getMessage()); }
            
        }
        
        // Get reviews for a vacation spot
        public function getVacationReviews($vacId) {
            $sql = 'CALL get_vacation_reviews(:vacId)';
            $params = array(':vacId'=>$vacId);
            
            try { $result = $this->gateway->bindParams($sql, $params); }
            catch (Exception $e) { throw new Exception($e->getMessage()); }
            
            return $result;
        }
        
        // Get user reviews 
        public function getUserReviews($userId) {
            $sql = 'CALL get_user_reviews(:userId)';
            $params = array(':userId'=>$userId);
            
            try { $result = $this->gateway->bindParams($sql, $params); }
            catch (Exception $e) { throw new Exception($e->getMessage()); }
            
            return $result;
        }
        
        public function editReview($id, $title, $body, $rating) {
            $sql = 'CALL edit_review(:id, :title, :body, :rating)';
            $params = array(':id'=>$id, ':title'=>$title, ':body'=>$body, 'rating'=>$rating);
            
            try { $result = $this->gateway->bindParams($sql, $params); }
            catch (Exception $e) { throw new Exception($e->getMessage()); }
        }
    }

// TESTING 

$rev = new Review();

//$rev->postReview(7719, 1, 'From model', 'body', 2.0);
//$r = $rev->getReviews(1);
//$r = $rev->getUserReviews(7719);
//$r = $rev->editReview(1, 'new title model', 'bodymodel', 2);


//print_r($r);

?>