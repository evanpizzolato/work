<?php

class Locations {
    
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    
    // gets all location information for the map
    public function getLocations() {
        $db = $this->db;
        
        $query = "SELECT * FROM locations l, destinations d, location_categories lc, exp_levels el 
                  WHERE l.destinations_id = d.id AND l.location_categories_id = lc.id AND l.exp_levels_id = el.id";
        $statement = $db->prepare($query);
        $statement->execute();
        $loc = $statement->fetchAll();
        $statement->closeCursor();

        return $loc;
    }
    public function getLocation($id) {
        $db = $this->db;
        
        $query = "SELECT * FROM locations l, destinations d, location_categories lc, exp_levels el 
                  WHERE l.destinations_id = d.id AND l.location_categories_id = lc.id AND l.exp_levels_id = el.id AND l.id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $loc = $statement->fetchAll();
        $statement->closeCursor();

        return $loc;
    }
    public function getLocByType($dest, $loc, $exp) {
        $db = $this->db;
        
        $v_dest = (!empty($dest) || isset($dest)) ? true : false;
        $v_loc = (!empty($loc) || isset($loc)) ? true : false;
        $v_exp = (!empty($exp) || isset($exp)) ? true : false;
        
        $query = "SELECT * FROM locations WHERE";
        $query .= $v_dest ? " destinations_id = :d_id" : "";
        $query .= $v_loc ? " AND location_categories_id = :lc_id" : "";
        $query .= $v_exp ? " AND exp_levels_id = :e_id" : "";
        
        $statement = $db->prepare($query);
        
        if ($v_dest)
            $statement->bindValue(':d_id', $dest, PDO::PARAM_STR);
        if ($v_loc)
            $statement->bindValue(':lc_id', $loc, PDO::PARAM_STR);
        if ($v_exp)
            $statement->bindValue(':e_id', $exp, PDO::PARAM_STR);
        
        $statement->execute();        
        $locations = $statement->fetchAll();
        $statement->closeCursor();
        
        return $locations;
    }
    public function mapLocations($location, $mapxml) {
        $xml = simplexml_load_file("xml/$mapxml.xml");
        //deletes all previous data from xml
        foreach($xml->markers as $m) {
            unset($m[0]);
            break;
        }
        //adds new marker element
        $markers = $xml->addChild("markers");
        //adds individual markers to map
        foreach ($location as $l) {

            $lat = $l[4];
            $lng = $l[5];
            $address = $l["address"]." ".$l["zip"];
            
            //final check to see if lat and lng are set
            $lat = (isset($lat))? $lat : "" ;
            $lng = (isset($lng))? $lng : "" ;
            
            $marker = $markers->addChild("marker");
            $marker->addAttribute("id",$l[0]);
            $marker->addAttribute("name",$l[1]);
            $marker->addAttribute("address", $address);
            $marker->addAttribute("link", $l["website"]);
            $marker->addAttribute("lat", $lat);
            $marker->addAttribute("lng", $lng);
            $marker->addAttribute("type", $l[27]);
            $marker->addAttribute("imgPath", $l["filePath"]);
        }
        $xml->saveXML("xml/$mapxml.xml");
        //echo "<meta http-equiv='refresh' content='0'>";
    }
    public function newLocation($name, $address, $zip, $lat, $lng, $desc, $web, $phone, $cost, $file, $d_id, $lc_id, $el_id) {
        $db = $this->db;
        
        $query = "INSERT INTO locations (name, address, zip, lat, lng, description, website, cost, phone, filePath, destinations_id, location_categories_id, exp_levels_id) VALUES (:name, :address, :zip, :lat, :lng, :desc, :website, :cost, :phone, :file, :d_id, :lc_id, :el_id)";
        $addStmt = $db->prepare($query);

        $addStmt->bindValue(':name', $name, PDO::PARAM_STR);
        $addStmt->bindValue(':address', $address, PDO::PARAM_STR);
        $addStmt->bindValue(':zip', $zip, PDO::PARAM_STR);
        $addStmt->bindValue(':lat', $lat, PDO::PARAM_STR);
        $addStmt->bindValue(':lng', $lng, PDO::PARAM_STR);
        $addStmt->bindValue(':desc', $desc, PDO::PARAM_STR);
        $addStmt->bindValue(':website', $web, PDO::PARAM_STR);
        $addStmt->bindValue(':cost', $cost, PDO::PARAM_STR);
        $addStmt->bindValue(':phone', $phone, PDO::PARAM_STR);
        $addStmt->bindValue(':file', $file, PDO::PARAM_STR);
        $addStmt->bindValue(':d_id', $d_id, PDO::PARAM_INT);
        $addStmt->bindValue(':lc_id', $lc_id, PDO::PARAM_INT);
        $addStmt->bindValue(':el_id', $el_id, PDO::PARAM_INT);
        
        $addStmt->execute();
        $addStmt->closeCursor();
    }
    public function updateLocation($id, $name, $address, $zip, $lat, $lng, $desc, $web, $phone, $cost, $file, $d_id, $lc_id, $el_id) {
        $db = $this->db;
        
        //UPDATE locations SET name=:name, address=:address, zip=:zip, lat=:lat, lng=:lng, description=:desc, website=:website,`visible`=[value-9],`rating`=[value-10],`cost`=[value-11], phone=:phone,`filePath`=[value-13], destinations_id=:d_id, location_categories_id=:lc_id, exp_levels_id=:el_id WHERE id = :id
        
        $query = "UPDATE locations SET name=:name, address=:address, zip=:zip, lat=:lat, lng=:lng, description=:desc, website=:website, cost=:cost, phone=:phone, filePath=:file, destinations_id=:d_id, location_categories_id=:lc_id, exp_levels_id=:el_id WHERE id=:id";
        $addStmt = $db->prepare($query);

        $addStmt->bindValue(':id', $id, PDO::PARAM_INT);
        $addStmt->bindValue(':name', $name, PDO::PARAM_STR);
        $addStmt->bindValue(':address', $address, PDO::PARAM_STR);
        $addStmt->bindValue(':zip', $zip, PDO::PARAM_STR);
        $addStmt->bindValue(':lat', $lat, PDO::PARAM_STR);
        $addStmt->bindValue(':lng', $lng, PDO::PARAM_STR);
        $addStmt->bindValue(':desc', $desc, PDO::PARAM_STR);
        $addStmt->bindValue(':website', $web, PDO::PARAM_STR);
        $addStmt->bindValue(':cost', $cost, PDO::PARAM_STR);
        $addStmt->bindValue(':phone', $phone, PDO::PARAM_STR);
        $addStmt->bindValue(':file', $file, PDO::PARAM_STR);
        $addStmt->bindValue(':d_id', $d_id, PDO::PARAM_INT);
        $addStmt->bindValue(':lc_id', $lc_id, PDO::PARAM_INT);
        $addStmt->bindValue(':el_id', $el_id, PDO::PARAM_INT);
        
        $addStmt->execute();
        $addStmt->closeCursor();
    }
    public function deleteLocation($id) {
        $db = $this->db;
        $query = "DELETE FROM locations WHERE id = :id";
        
        $delStmt = $db->prepare($query);
        $delStmt->bindValue(':id', $id, PDO::PARAM_INT);
        $delStmt->execute();
        
        $delStmt->closeCursor();
    }
    public function getDestination() {
        $db = $this->db;

//        $query = "SELECT DISTINCT l.Destinations_id, d.city, d.country
//                  FROM Destinations d
//                  JOIN Locations l ON d.id = l.Destinations_id";
//        $statement = $this->db->prepare($query);

        $query = "SELECT * FROM destinations";
        $statement = $db->prepare($query);
        $statement->execute();
        $destination = $statement->fetchAll();
        $statement->closeCursor();

        return $destination;
    }
    public function getExp() {
        $db = $this->db;
        
        $query = "SELECT * FROM exp_levels";
        $statement = $db->prepare($query);
        $statement->execute();
        $exp_levels = $statement->fetchAll();
        $statement->closeCursor();
        
        return $exp_levels;
    }
    public function getCategory() {
        $db = $this->db;
        
        $query = "SELECT * FROM location_categories";
        $statement = $db->prepare($query);
        $statement->execute();
        $exp_levels = $statement->fetchAll();
        $statement->closeCursor();
        
        return $exp_levels;
    }
}
?>