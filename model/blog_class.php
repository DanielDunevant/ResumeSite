<?php
class blog{
	private $BlogID;
	public function __construct(){ 
		global $db;
		$query="SELECT * FROM BlogIDTable";
		try {
        		$statement = $db->prepare($query);
        		$statement->execute();
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
        		$statement->closeCursor();
        		// Get the last product ID that was automatically generated
 			// Get the last product ID that was automaticallyp generated
			$this->BlogID=$result[0]["BlogID"];
    		} catch (PDOException $e) {
        		$error_message = $e->getMessage();
        		display_db_error($error_message);
    		}
       } 
	public function incrementBlogID(){
		global $db;
		$this->BlogID=$this->BlogID+1;
		 $query = 'UPDATE BlogIDTable
			   SET BlogID= :Blog_ID_New
			   WHERE BlogID = :Blog_ID_Old';			
 		$statement = $db->prepare($query);
                $statement->bindValue(':Blog_ID_Old',$this->BlogID-1);
                $statement->bindValue(':Blog_ID_New',$this->BlogID);
                $statement->execute();
                $statement->closeCursor();
	}
	/*public function incrementChronosID(){
		$ChronosID++;	
	}
	public function incrementChronosID(){
		$ChronosID=0;	
	}*/
	
	public function setBlogID($blogid){
		$this->BlogID=$blogid;
	}
	public function getBlogID(){
		return $this->BlogID;
	}
}

?>
