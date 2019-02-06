<?php
class wiki {
    
    var $name;
    var $body;
    
    /*
     * Finds and populates a cadet object based off of the rin.
     * 
     * @param rin - the id to find the cadet with 
     * @param $mysqli - the sql connection to be used to search with
     */
    public function __construct( $name, $mysqli )
    {
        $sql = "SELECT * FROM wiki WHERE name = (?)";
        $stmt = $mysqli->prepare($sql);
        if(!($stmt->bind_param( "s", $name )))
        {
            echo "Prepared statement bind failed!";
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        $this->body = $row['body'];
        $this->name = $name;
        
        $stmt->close();
    }
    
    /*
     * This updates the cadet in sql to the objects current values.
     */
    function updateWiki( $mysqli )
    {
        $stmt = $mysqli->prepare("UPDATE wiki SET body = ? WHERE name = ?");
        $stmt->bind_param( "ss", $this->body, $this->name );
        $stmt->execute();
        $stmt->close();
    }

    function setName($name) { 
        $this->name = $name; 
    }

    function getName() { 
        return $this->name; 
    }

    function getBody() { 
        return $this->body; 
    }
    
    function setBody($body) { 
        $this->body = $body;
    }
}
?>