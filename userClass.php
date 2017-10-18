<?php
class userClass{

    /* User Login */
    public function userLogin($username,$password){
        try{
            $db = getDB();
            $stmt = $db->prepare("SELECT * FROM tb_user WHERE (username=:username or email=:username) AND password=:password AND enable='Y' ");
            $stmt->bindParam("username", $username,PDO::PARAM_STR);
            $stmt->bindParam("password", $password,PDO::PARAM_STR);
            $stmt->execute();
            $count=$stmt->rowCount();
            $data=$stmt->fetch(PDO::FETCH_OBJ);
            $db = null;
            if($count){
                $_SESSION['userID']=$data->userID; // Storing user session value
                $_SESSION['level']=$data->level; // level of user
                $_SESSION['hotelID']=$data->hotelID; // level of user
                $_SESSION['Api_key']='59e0dd412hdrtgrdyhrtf51c'; // level of user
                $_SESSION['facebookID']=$data->facebookID; // Storing user session value
                return $_SESSION['level'];
            }else{
                return false;
            }
        }
        catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
        return true;
    }

    /*-------------------------------------------------------------------------*/

    /* User Registration */
    public function userRegistration($password,$facebookID,$email,$name,$lastName,$firstName,$hotelID,$creationDate) {
        try{
            $db = getDB();
            $st = $db->prepare("SELECT * FROM tb_user WHERE email=:email");
            $st->bindParam("email", $email,PDO::PARAM_STR);
            $st->execute();
            $count=$st->rowCount();
            if($count<1){

                $stmt = $db->prepare("INSERT INTO tb_user(facebookID,password,email,name,level,enable,lastName,firstName,hotelID,creationDate) VALUES (:facebookID,:password,:email,:name,'user','Y',:lastName,:firstName,:hotelID,:creationDate)");
                $stmt->bindParam("facebookID", $facebookID,PDO::PARAM_STR);
                $stmt->bindParam("password", $password,PDO::PARAM_STR);
                $stmt->bindParam("email", $email,PDO::PARAM_STR);
                $stmt->bindParam("name", $name,PDO::PARAM_STR);
                $stmt->bindParam("lastName", $lastName,PDO::PARAM_STR);
                $stmt->bindParam("firstName", $firstName,PDO::PARAM_STR);
                $stmt->bindParam("hotelID", $hotelID,PDO::PARAM_STR);
                $stmt->bindParam("creationDate", $creationDate,PDO::PARAM_STR);
                $stmt->execute();

                $userID=$db->lastInsertId(); // Last inserted row id
                $db = null;
                $_SESSION['userID']=$userID;
                if ($facebookID != 0){
                    $_SESSION['facebookID']=$facebookID; // Storing user session value
                }
                return true;

            }else{
                $db = null;
                return false;
            }

        }
        catch(PDOException $e){
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
        return false;
    }



    /* User Details */
   public function userDetails($userID){
        try{
            $db = getDB();
            $stmt = $db->prepare("SELECT * FROM tb_user WHERE userID=:userID");
            $stmt->bindParam("userID", $userID,PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_OBJ); //User data
            return $data;
        }
        catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
        return true;
    }

}
?>