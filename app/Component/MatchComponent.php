<?php


namespace App\Component;

use App\DatingDetails;
use Illuminate\Support\Facades\DB;
use App\Users;

class MatchComponent
{
    protected $N;
    private $engagedCount;
    private $menPref, $womenPref;
    private $men, $women, $womenPartner, $menEngaged;

    public function __construct($pMen, $pWomen, $mp, $wp)
    {
        $this->N = count($wp);
        $this->engagedCount = 0;
        $this->men = $pMen;
        $this->women = $pWomen;
        $this->menPref = $mp;
        $this->womenPref = $wp;
        $this->menEngaged = array_fill(0,$this->N,false);
        $this->womenPartner = array_fill(0,$this->N,false);
    }

    public function calMatch()
    {
        while ($this->engagedCount < $this->N) {
            $free = 0;
            for ($free = 0; $free < $this->N; $free++) {
                if (!$this->menEngaged[$free]) {
                    break;
                }
            }
            for ($i = 0; $i < $this->N && !$this->menEngaged[$free]; $i++) {
                $index = $this->womenIndexOf($this->menPref[$free][$i]);
                if ($this->womenPartner[$index] == null) {
                        $this->womenPartner[$index] = $this->men[$free]["id"];
                        $this->menEngaged[$free] = true;
                        $this->engagedCount++;
                }else{
                        $currentPartner = $this->womenPartner[$index];
                        if ($this->morePreference($currentPartner, $this->men[$free]["id"], $index)) {
                            $this->womenPartner[$index] = $this->men[$free]["id"];
                            $this->menEngaged[$free] = true;
                            $this->menEngaged[$this->menIndexOf($currentPartner)] = false;
                        }
                }
            }
        }
       return  $this->printCouples();
    }

    /** function to check if women prefers new partner over old assigned partner *
     * @param $curPartner
     * @param $newPartner
     * @param $index
     * @return bool
     */
    private function morePreference($curPartner, $newPartner, $index)
    {
        for ($i = 0; $i < $this->N; $i++) {
            if ($this->womenPref[$index][$i]== $newPartner)
                return true;
            if ($this->womenPref[$index][$i]== $curPartner)
                return false;
        }
        return false;
    }

    /** get women index *
     * @param $str
     * @return int
     */
    private function womenIndexOf($str)
    {
        for ($i = 0; $i < $this->N; $i++)
            if ($this->women[$i]["id"] == $str)
                return $i;
        return -1;
    }

    /** get men index *
     * @param $str
     * @return int
     */
    private function menIndexOf($str)
    {
        for ($i = 0; $i < $this->N; $i++)
            if ($this->men[$i]["id"] == $str)
                return $i;
        return -1;
    }
    /**
     * printCouples()
     */
    private function  printCouples(){
        $arr = array($this->N);
        for ($i = 0; $i < $this->N; $i++)
        {
            $arr[$i] = "User #".($this->womenPartner[$i]." is matched with User #".$this->women[$i]["id"]);
        }
        return $arr;
    }
}


