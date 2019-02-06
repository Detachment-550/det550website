<?php
class cadet {
    
    var $first;
    var $last;
    var $rank;
    var $rin;
    var $primEmail;
    var $secEmail;
    var $primPhone;
    var $secPhone;
    var $pass;
    var $bio;
    var $flight;
    var $position;
    var $groupMe;
    var $PGoals;
    var $AGoals;
    var $awards;
    var $admin;
    var $major;
    var $question;
    var $answer;
    
    
    /*
     * Finds and populates a cadet object based off of the rin.
     * 
     * @param rin - the id to find the cadet with 
     * @param $mysqli - the sql connection to be used to search with
     */
    public function __construct( $rin, $mysqli )
    {
        $sql = "SELECT * FROM cadet WHERE rin = (?)";
        $stmt = $mysqli->prepare($sql);
        if(!($stmt->bind_param( "i", $rin )))
        {
            echo "Prepared statement bind failed!";
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        $this->rin = $rin;
        $this->first = $row['firstName'];
        $this->last = $row['lastName'];
        $this->rank = $row['rank'];
        $this->primEmail = $row['primaryEmail'];
        $this->secEmail = $row['secondaryEmail'];
        $this->primPhone = $row['primaryPhone'];
        $this->secPhone = $row['secondaryPhone'];
        $this->pass = $row['password'];
        $this->bio = $row['bio'];
        $this->flight = $row['flight'];
        $this->position = $row['position'];
        $this->groupMe = $row['groupMe'];
        $this->AGoals = $row['AFGoals'];
        $this->PGoals = $row['PGoals'];
        $this->awards = $row['awards'];
        $this->admin = $row['admin'];
        $this->major = $row['major'];
        $this->question = $row['question'];
        $this->answer = $row['answer'];

        $stmt->close();
    }
    
    /*
     * This updates the cadet in sql to the objects current values.
     */
    function updateCadet( $mysqli )
    {
        $stmt = $mysqli->prepare("UPDATE cadet SET firstName = ?, lastName = ?, rank = ?, primaryEmail = ?, secondaryEmail = ?, primaryPhone = ?, secondaryPhone = ?, password = ?, bio = ?, flight = ?, position = ?, groupMe = ?, PGoals = ?, AFGoals = ?, awards = ?, admin = ?, major = ?, question = ?, answer = ? WHERE rin = ?");
        $stmt->bind_param( "sssssiissssssssisssi", $this->first, $this->last, $this->rank, $this->primEmail, $this->secEmail, $this->primPhone, $this->secPhone, $this->pass, $this->bio, $this->flight, $this->position, $this->groupMe, $this->PGoals, $this->AGoals, $this->awards, $this->admin, $this->major, $this->question, $this->answer, $this->rin );
        $stmt->execute();
        $stmt->close();
    }
    
    function setQuestion($question) { 
        $this->question = $question; 
    }

    function getQuestion() { 
        return $this->question; 
    }
    
    function setAnswer($answer) { 
        $this->answer = $answer; 
    }

    function getAnswer() { 
        return $this->answer; 
    }
    
    function setMajor($major) { 
        $this->major = $major; 
    }

    function getMajor() { 
        return $this->major; 
    }
    
    function setAdmin($admin) { 
        $this->admin = $admin; 
    }

    function getAdmin() { 
        return $this->admin; 
    }

    function setFirst($first) { 
        $this->first = $first; 
    }

    function getFirst() { 
        return $this->first; 
    }

    function setLast($last) { 
        $this->last = $last; 
    }

    function getLast() { 
        return $this->last; 
    }

    function setRank($rank) { 
        $this->rank = $rank; 
    }

    function getRank() { 
        return $this->rank; 
    }

    function setPrimEmail($primEmail) { 
        $this->primEmail = $primEmail; 
    }

    function getPrimEmail() { 
        return $this->primEmail; 
    }

    function setSecEmail($secEmail) { 
        $this->secEmail = $secEmail; 
    }

    function getSecEmail() { 
        return $this->secEmail; 
    }

    function setPrimPhone($primPhone) { 
        $this->primPhone = $primPhone; 
    }

    function getPrimPhone() { 
        return $this->primPhone; 
    }

    function setSecPhone($secPhone) { 
        $this->secPhone = $secPhone; 
    }

    function getSecPhone() { 
        return $this->secPhone; 
    }

    function setPass($pass) {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $this->pass = $hash; 
    }

    function getPass() { 
        return $this->pass; 
    }

    function setBio($bio) { 
        $this->bio = $bio; 
    }

    function getBio() { 
        return $this->bio; 
    }

    function setFlight($flight) { 
        $this->flight = $flight; 
    }

    function getFlight() { 
        return $this->flight; 
    }

    function setPosition($position) { 
        $this->position = $position; 
    }

    function getPosition() { 
        return $this->position; 
    }

    function setGroupMe($groupMe) { 
        $this->groupMe = $groupMe; 
    }

    function getGroupMe() { 
        return $this->groupMe; 
    }

    function setPersonalGoals($PGoals) { 
        $this->PGoals = $PGoals; 
    }

    function getPersonalGoals() { 
        return $this->PGoals; 
    }
    
    function setAirForceGoals($AGoals) { 
        $this->AGoals = $AGoals; 
    }

    function getAirForceGoals() { 
        return $this->AGoals; 
    }

    function setAwards($awards) { 
        $this->awards = $awards; 
    }

    function getAwards() { 
        return $this->awards; 
    }

}


?>