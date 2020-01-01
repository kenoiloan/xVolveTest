<?php


namespace App\Component;


class RatingComponent
{
    public function __construct()
    {

    }
    public function rating($men,$women){
        $arrayParent = array();
        $count = count($men) - 1;
        while($count >= 0){
            $arrayChild = array_fill(0,count($women),-1);
            //Assign first element of women
            //$arrayChild[0] = $women[0]["id"];
            $swapIndex = 0;
            for($i= 0 ; $i < count($women);$i++){
                if($men[$count]["prefer"] == $women[$i]["prefer"] ){
                            $temp = $arrayChild[$swapIndex];
                            $arrayChild[$i] = $temp;
                            $arrayChild[$swapIndex] = $women[$i]["id"];
                            $swapIndex++;
                }
                else{
                    $arrayChild[$i] = $women[$i]["id"];
                }
            }
            //assign to parent
            $arrayParent[$count] = $arrayChild;
            $count--;
        }
    return $arrayParent;
    }
    public function printMatrix($matrix){
        for($i = 0; $i< count($matrix) ;$i++){
            for ($j = 0; $j < count($matrix); $j++) {
                echo $matrix[$i][$j];
            }
            echo '\n';
        }
    }
}
//Test

/*$testMen  = array(array(1,'W'),array(3,'X'),array(5,'Y'),array(7,'Z'));
$tesWomen = array(array(2,'Z'),array(4,'X'),array(6,'Y'),array(8,'W'));

$rating = new RatingComponent();
$testResult = $rating->rating($testMen,$tesWomen);

$rating->printMatrix($testResult);

////
 $testMenw  = array(array(1,'W'),array(3,'X'),array(5,'Y'),array(7,'Z'));
 $tesWomentw = array(array(2,'W'),array(4,'X'),array(6,'Y'),array(8,'Z'));
//
$ratingw = new RatingComponent();
$testResultw = $ratingw->rating($tesWomentw,$testMenw);
//
$ratingw->printMatrix($testResultw);
**/
