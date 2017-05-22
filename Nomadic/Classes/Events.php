<?php

class Events {
    
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function getAllEvents() {
        $db = $this->db;
        $this->visibleCheck($db);
        
        $query = "SELECT e.*, l.name, l.lat, l.lng FROM events e, locations l WHERE e.locations_id = l.id AND e.visible != 0";
        $statement = $db->prepare($query);
        $statement->execute();
        $events = $statement->fetchAll();
        $statement->closeCursor();
        
        return $events;
    }
    public function getEvent($id) {
        $db = $this->db;
        $this->visibleCheck($db);
        
        $query = "SELECT e.*, l.name, MAX(ea.end) as end FROM events e, locations l, events_active ea WHERE e.locations_id = l.id AND ea.events_id = e.id AND e.id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $event = $statement->fetch();
        $statement->closeCursor();
        
        return $event;
    }
    public function getUserEvents($id) {
        $db = $this->db;
        $this->visibleCheck($db);
        
        $query = "SELECT e.*, l.name, l.lat, l.lng  FROM events e, locations l WHERE e.locations_id = l.id AND users_id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_STR);
        $statement->execute();
        $events = $statement->fetchAll();
        $statement->closeCursor();

        return $events;
    }
    public function mapEvents($events, $mapxml) {
        
        $mapxml = str_replace('"', "", $mapxml);
        $xml = simplexml_load_file("xml/".$mapxml.".xml");
        //deletes all previous data from xml
        foreach($xml->markers as $m) {
            unset($m[0]);
            break;
        }
        
        // Taken from http://php.net/manual/en/function.array-unique.php#116302
        function unique_multidim_array($array, $key) { 
            $temp_array = array(); 
            $i = 0; 
            $key_array = array(); 

            foreach($array as $val) { 
                if (!in_array($val[$key], $key_array)) { 
                    $key_array[$i] = $val[$key]; 
                    $temp_array[$i] = $val; 
                } 
                $i++; 
            } 
            return $temp_array; 
        } 

        $onlyLocations = unique_multidim_array($events, 'name');
        
        //adds new markers element
        $markers = $xml->addChild("markers");
        
        foreach ($onlyLocations as $l) {
            $lat = $l["lat"];
            $lng = $l["lng"];
            
            $lat = (isset($lat))? $lat : "" ;
            $lng = (isset($lng))? $lng : "" ;
            
            $marker = $markers->addChild("marker");
            
            $marker->addAttribute("name",$l["name"]);
            $marker->addAttribute("lat", $lat);
            $marker->addAttribute("lng", $lng);
            
            foreach ($events as $e) {
                if ($e["name"] == $l["name"]) {
                    $event = $marker->addChild("event");
                    $event->addAttribute("id", $e["id"]);
                    $event->addAttribute("name", $e[1]);
                    $event->addAttribute("link", $e["link"]);
                    $event->addAttribute("time", date("M j @ g:i A", strtotime($e['date'])));
                }
            }
        }
        
        $xml->saveXML("xml/$mapxml.xml");
    }
    public function createEvent($name, $date, $desc, $link, $u_id, $l_id) {
        $db = $this->db;
        
        $query = "INSERT INTO events (name, date, description, link, users_id, locations_id) VALUES (:name, :date, :desc, :link, :u_id, :l_id)";
        $statement = $db->prepare($query);
        
        $statement->bindValue(':name', $name, PDO::PARAM_STR);
        $statement->bindValue(':date', $date, PDO::PARAM_STR);
        $statement->bindValue(':desc', $desc, PDO::PARAM_STR);
        $statement->bindValue(':link', $link, PDO::PARAM_STR);
        $statement->bindValue(':u_id', $u_id, PDO::PARAM_STR);
        $statement->bindValue(':l_id', $l_id, PDO::PARAM_INT);
        
        $statement->execute();
        $statement->closeCursor();
    }
    public function updateEvent($id, $name, $date, $desc, $link, $l_id) {
        $db = $this->db;
                
        $query = "UPDATE events SET name = :name, date = :date, description = :desc, link = :link, locations_id = :l_id WHERE id = :id";
        $statement = $db->prepare($query);
        
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->bindValue(':name', $name, PDO::PARAM_STR);
        $statement->bindValue(':date', $date, PDO::PARAM_STR);
        $statement->bindValue(':desc', $desc, PDO::PARAM_STR);
        $statement->bindValue(':link', $link, PDO::PARAM_STR);
        $statement->bindValue(':l_id', $l_id, PDO::PARAM_INT);
        
        $statement->execute();
        $statement->closeCursor();
    }
    public function deleteEvent($id) {
        $db = $this->db;
        $query = "DELETE FROM events WHERE id = :id";
        
        $delStmt = $db->prepare($query);
        $delStmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        $delStmt->execute();
        $delStmt->closeCursor();
    }
    public function adPayment($img, $amt, $desc) {
        echo '<script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="pk_test_qx5rWHhOaOu2sdb5NUI7quCh" data-amount="'.$amt.'" data-name="Nomadic" data-description="'.$desc.'" data-image="'.$img.'" data-locale="auto" data-currency="cad"></script>';
    }
    public function adCharge($event, $token, $amount) {
        $db = $this->db;
        $this->visibleCheck($db);
        
        $query = "INSERT INTO events_active(events_id, token, amount, start, end) VALUES (:id,:token,:amt, NOW(), ";
        switch ($amount) {
            case 99:
                $query .= 'NOW() + INTERVAL 10 MINUTE)';
                break;
            case 500:
                $query .= 'NOW() + INTERVAL 1 HOUR)';
                break;
            case 11000:
                $query .= 'NOW() + INTERVAL 1 DAY)';
                break;
            case 20000:
                $query .= 'NOW() + INTERVAL 2 DAY)';
                break;
            default:
                $query .= 'NOW())';
                break;
        }
        
        $statement = $db->prepare($query);
        
        $statement->bindValue(':id', $event, PDO::PARAM_INT);
        $statement->bindValue(':token', $token, PDO::PARAM_STR);
        $statement->bindValue(':amt', $amount, PDO::PARAM_INT);
        
        $statement->execute();
        $statement->closeCursor();
    }
    private function visibleCheck($db) {
        $query = "UPDATE events INNER JOIN (SELECT events_id, MAX(end) as LatestDate FROM events_active GROUP BY events_id) ea ON events.id = ea.events_id SET events.visible = IF(ea.LatestDate < NOW(), 0, 1)";
        
        $stmt = $db->prepare($query);
        
        $stmt->execute();
        $stmt->closeCursor();
    }
}
?>