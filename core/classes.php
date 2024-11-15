<?php

class player{
    public $name, $point, $set;

    function set_name($nev){
        $this->name = $nev;
    }

    function set_point($point){
        $this->point = $point;
    }

    function set_set($set){
        $this->set = $set;
    }
    //Játékos objektum definiálása az eredménytáblához
}

class game{
    public $compName, $score, $groupCount, $playerCount, $date, $type;

    function __construct($compName, $score, $groupCount, $playerCount, $date, $type)
    {
        $this->compName = $compName;
        $this->score = $score;
        $this->groupCount = $groupCount;
        $this->playerCount = $playerCount;
        $this->date = $date;
        $this->type = $type;
    }

    //Csoportbeosztás objektum

    //compName = versenynév;
    //score = veseny pontszáma;
    //groupCount = csoportok száma;
    //date = verseny dátuma;
    //type = verseny típusa(szeparált, vegyes);
}

class groups{
    public $groupA, $groupB, $groupC, $groupD, $groupE, $groupF, $groupG, $groupH;

    function __construct($groupA, $groupB, $groupC, $groupD, $groupE, $groupF, $groupG, $groupH){
        $this->groupA = $groupA;
        $this->groupB = $groupB;
        $this->groupC = $groupC;
        $this->groupD = $groupD;
        $this->groupE = $groupE;
        $this->groupF = $groupF;
        $this->groupG = $groupG;
        $this->groupH = $groupH;
    }

    public function getGroups() {
        return [
            '1' => $this->groupA,
            '2' => $this->groupB,
            '3' => $this->groupC,
            '4' => $this->groupD,
            '5' => $this->groupE,
            '6' => $this->groupF,
            '7' => $this->groupG,
            '8' => $this->groupH
        ];
    }

    //Csoportok definiálása objektumban
}

class response{
    public $result, $log, $dataset;
    
    function __construct($result, $log = null, $dataset = null)
    {
        $this->result = $result;
        $this->log = $log;
        $this->dataset = $dataset;
    }
    //Response object for APIs
}


?>