<?php
class event {
    
    var $name;
    var $mandatory;
    var $date;
    var $eventID;
    
    /*
     * Finds and populates a cadet object based off of the rin.
     * 
     * @param rin - the id to find the cadet with 
     * @param $mysqli - the sql connection to be used to search with
     */
    public function __construct( $eventID, $mysqli )
    {
        $sql = "SELECT * FROM cadetEvent WHERE eventID = (?)";
        $stmt = $mysqli->prepare($sql);
        if(!($stmt->bind_param( "i", $eventID )))
        {
            echo "Prepared statement bind failed!";
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        $this->eventID = $eventID;
        $this->name = $row['name'];
        $this->date = $row['date'];
        $this->mandatory = $row['mandatory'];
        
        $stmt->close();
    }
    
    /*
     * This updates the cadet in sql to the objects current values.
     */
    function updateCadet( $mysqli )
    {
        $stmt = $mysqli->prepare("UPDATE eventID SET name = ?, date = ?, mandatory = ? WHERE eventID = ?");
        $stmt->bind_param( "ssii", $this->name, $this->date, $this->mandatory, $this->eventID );
        $stmt->execute();
        $stmt->close();
    }

    function setName($name) { 
        $this->name = $name; 
    }

    function getName() { 
        return $this->name; 
    }

    function setDate($date) { 
        $this->date = $date; 
    }

    function getDate() { 
        return $this->date; 
    }

    function setEventID($eventID) { 
        $this->eventID = $eventID; 
    }

    function getEventID() { 
        return $this->eventID; 
    }

    function setMandatory($mandatory) { 
        $this->mandatory = $mandatory; 
    }

    function getMandatory() { 
        return $this->mandatory; 
    }
}


?>