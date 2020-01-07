<?php


namespace App\Http\Controllers\WebService;

use App\Component\MatchComponent;
use App\Component\RatingComponent;
use App\Component\UserComponent;
use App\Http\Controllers\Controller;
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
    public function userDating($userId){
        $userComp = new UserComponent();
        $dating = $userComp->calUserMatch($userId);
            return response()->json($dating,200);
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

        return response()->json($dataMatched,200);
    }
}
