<?php
class adminViewDAO {
    private $database;
    
    function __construct($database) {
        $this->database = $database;
    }
    
    public function getNonUsedSchedules() {
        $dboutput = $this->database->query(
               "SELECT * FROM `Schedule` 
                WHERE `schedule_id` 
                NOT IN (
                    SELECT DISTINCT `schedule` FROM `Lectures`
                    UNION
                    SELECT DISTINCT `schedule` FROM `Posters`
                )")->fetchAll(PDO::FETCH_ASSOC);
        
        $schedules = array();
        
        foreach ($dboutput as $schedule) {
            array_push($schedules, new Schedule(
                    $schedule["schedule_id"],
                    $schedule["start"],
                    $schedule["end"],
                    $schedule["date"],
                    $schedule["type"]));
        }
        
        return $schedules;
    }
    
    public function getUsedSchedules() {
        $dboutput = $this->database->query(
               "SELECT * FROM `Schedule` 
                WHERE `schedule_id` 
                IN (
                    SELECT DISTINCT `schedule` FROM `Lectures`
                    UNION
                    SELECT DISTINCT `schedule` FROM `Posters`
                )")->fetchAll(PDO::FETCH_ASSOC);
        
                $schedules = array();
        
        foreach ($dboutput as $schedule) {
            array_push($schedules, new Schedule(
                    $schedule["schedule_id"],
                    $schedule["start"],
                    $schedule["end"],
                    $schedule["date"],
                    $schedule["type"]));
        }
        
        return $schedules;
    }
    
    public function getNonLectureAuthors() {
        $dboutput = $this->database->select("Authors", [
            "author_id",
            "fname",
            "sname",
            "email"
        ], [ 
            "lecture_id" => null
        ]);
        
        
        $authors = array();
        
        foreach ($dboutput as $author) {
            array_push($authors, new Author(
                    $author["author_id"],
                    $author["fname"], 
                    $author["sname"],
                    $author["email"]));
        }
        
        return $authors;
    }
    
    public function getNonPosterAuthors() {
        $dboutput = $this->database->select("Authors", [
            "author_id",
            "fname",
            "sname",
            "email"
        ], [ 
            "poster_id" => null
        ]);
        
        $authors = array();
        
        foreach ($dboutput as $author) {
            array_push($authors, new Author(
                    $author["author_id"],
                    $author["fname"], 
                    $author["sname"],
                    $author["email"]));
        }
        
        return $authors;
    }

    public function getLectures() {
        $dboutput = $this->database->select("Lectures", ["[>]Schedule" => ["schedule" => "schedule_id"]], [
            "Lectures.lecture_id",
            "Lectures.title",
            "Lectures.abstract",
            "Lectures.place",
            "Schedule.schedule_id",
            "Schedule.start",
            "Schedule.end",
            "Schedule.date"]);                
        
        $lectures = array();
        
        foreach ($dboutput as $lecture) {
            $relAuth = $this->database->select("Authors", [
                        "author_id",
                        "fname",
                        "sname",
                        "email"], [
                            "lecture_id" => $lecture["lecture_id"]
                            ]);
            
            $authors = array();
            
            foreach ($relAuth as $author) {
                array_push($authors, new Author(
                        $author["author_id"],
                        $author["fname"],
                        $author["sname"],
                        $author["email"]));
            }
                    
            array_push($lectures, new Lecture(
                    $lecture["lecture_id"],
                    $lecture["title"],
                    $lecture["abstract"],
                    $authors,
                    $lecture["date"],
                    $lecture["startTime"],
                    $lecture["endTime"],
                    $lecture["place"]));
        }
        
        return $lectures;
    }

    public function getPosters() {
        $dboutput = $this->database->select("Posters",
                ["[>]Schedule" => ["schedule" => "schedule_id"]],
                [
                    "Posters.poster_id",
                    "Posters.title",
                    "Posters.abstract",
                    "Posters.place",
                    "Schedule.schedule_id",
                    "Schedule.start",
                    "Schedule.end",
                    "Schedule.date"
                    ]);
        
        $posters = array();
        
        foreach ($dboutput as $poster) {
            $relAuth = $this->database->select("Authors", [
                    "author_id",
                    "fname",
                    "sname",
                    "email"], [
                        "poster_id" => $poster["poster_id"]
                        ]);
            
            $authors = array();
            
            foreach ($relAuth as $author) {
                array_push($authors, new Author(
                        $author["author_id"],
                        $author["fname"],
                        $author["sname"],
                        $author["email"]));
            }
            
            array_push($posters, new Poster(
                    $poster["poster_id"],
                    $poster["title"],
                    $poster["abstract"],
                    $authors,
                    $poster["date"],
                    $poster["startTime"],
                    $poster["endTime"],
                    $poster["place"]));
        }
        return $posters;        
    }      
      
    public function addPoster($title, $abstract, $schedule_id, $place, $auhors_id, $tags) {        
        $this->database->insert("Posters", [
            "title" => $title,
            "abstract" => $abstract,
            "schedule" => $schedule_id,
            "place" => $place
        ]);
        
        //update Authors table with recent data
        $newPosterID = $this->database->id();
        foreach ($authors_id as $id) {
            $this->database->update("Authors", [
                "poster_id" => $newPosterID
            ], [
                "author_id" => $id
            ]);
        }
        
        if (is_string($tags)) {
            $tags = explode(' ', $tags);
            foreach ($tags as $tag) {
                $this->database->insert("PosterTags", [
                    "poster" => $newPosterID,
                    "tag" => $tag
                ]);
            }
        }
    }
    
    public function removePoster($id) {
        return $this->database->delete("Posters", [
            'poster_id' => $id
        ]);
    }

    public function addLecture($title, $abstract, $schedule_id, $place, $auhors_id, $tags) {
        $this->database->insert("Lectures", [
            "title" => $title,
            "abstract" => $abstract,
            "schedule" => $schedule_id,
            "place" => $place
        ]);
        
        //update Authors table with recent data
        $newLectureID = $this->database->id();
        foreach ($authors_id as $id) {
            $this->database->update("Authors", [
                "lecture_id" => $newPosterID
            ], [
                "author_id" => $id
            ]);
        }
        
        if (is_string($tags)) {
            $tags = explode(' ', $tags);
            foreach ($tags as $tag) {
                $this->database->insert("LectureTags", [
                    "poster" => $newLectureID,
                    "tag" => $tag
                ]);
            }
        }
    }
    
    public function removeLecture($id) {
        return $this->database->delete("Lectures", [
            'lecture_id' => $id
        ]);        
    }
    
    public function addUser($fname, $sname, $code, $didVote, $isAdmin, $email) {
        return $this->database->insert("Users", [
            "fname" => $fname,
            "sname" => $sname,
            "code" => $code,
            "didVote" => $didVote,
            "isAdmin" => $isAdmin,
            "email" => $email
        ]);
    }
    
    public function removeUser($id) {
        return $this->database->delete("Users", [
            'user_id' => $id
        ]);
    }

    public function generateCode() {
        $newCode = $this->readableRandomString();
        $userData = $database->select("Users", [
            "user_id"], [
            "code" => $newCode]);
        if (is_null($userData)) {
            $this->generateCode();
        } else {
            return $newCode;
        }
    }
    
    private function readableRandomString($length = 6) {
        $string     = '';
        $vowels     = array("a","e","i","o","u");  
        $consonants = array(
            'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 
            'n', 'p', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z'
        );  
        // Seed it
        srand((double) microtime() * 1000000);
        $max = $length/2;
        for ($i = 1; $i <= $max; $i++)
        {
            $string .= $consonants[rand(0,19)];
            $string .= $vowels[rand(0,4)];
        }
        return $string;
    }
}