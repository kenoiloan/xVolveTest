<?php


namespace App\Http\Controllers;

use App\Component\MatchComponent;
use App\Component\RatingComponent;
use Illuminate\Http\Request;
use App;
class MatchingController extends Controller
{
    /***
     * MatchingController constructor.
     */
    public function __construct()
    {

    }
    public function index(){


    }
    public function matching(){
        // Bind data example for test process
        $mMen = App\Users::where('gender', 'male')->get()->toArray();
        $wWomen = App\Users::where('gender', 'female')->get()->toArray();

        //Matrix rating base on User
        $rating = new RatingComponent();

        $menPref = $rating->rating($mMen,$wWomen); //array(array(8,4,6,2),array(4,6,8,2),array(6,8,2,4),array(8,2,4,6));
        //dd($menPref);
        $womenPref =  $rating->rating($wWomen,$mMen);//array(array(7,3,5,1),array(3,5,7,1),array(5,7,1,3),array(1,7,3,5));
        //dd($menPref);

        //Call Component
        $match = new MatchComponent($mMen,$wWomen,$menPref,$womenPref);
        $dataMatched = $match->calMatch();

        return view('match',['dataMatched' =>$dataMatched]);
    }
}
