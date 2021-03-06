<?php


namespace App\Http\Controllers;

use App\Component\MatchComponent;
use App\Component\RatingComponent;
use App\Users;
class MatchingController extends Controller
{
    private $user;
    /***
     * MatchingController constructor.
     */
    public function __construct()
    {
        $this->user = new Users();
    }
    public function index(){

    }
    public function matching(){
        // Bind data example for test process
        $mMen = $this->user->getData('male');
        $wWomen = $this->user->getData('female');

        //Matrix rating base on Prefer attribute of User
        $rating = new RatingComponent();
        $menPref = $rating->rating($mMen,$wWomen);
        $womenPref =  $rating->rating($wWomen,$mMen);

        //Call Component
        $match = new MatchComponent($mMen,$wWomen,$menPref,$womenPref);
        $dataMatched = $match->calMatch();

        return view('match',['dataMatched' =>$dataMatched]);
    }
}
