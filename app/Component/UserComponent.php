<?php


namespace App\Component;


use App\DatingDetails;
use App\Users;
use Illuminate\Support\Facades\DB;

class UserComponent
{
    public function calUserMatch($userId){
        //Check this userId has been on date yet
        $dating = new DatingDetails;
        $count = $dating->checkExistUser($userId);
        if($count>0){
            return;
        }
        //get user information for match dating
        $user = Users::where('id',$userId)->first();
        $gender = $user->gender;
        $prefer = $user->prefer;
        //Get user difference gender and has same prefer for make partner with this user.
        //With one condition is not a partner with another user
        //Get first user for dating
        $sqlString = 'select id from xvolve.users L where L.gender <>? and L.prefer=? and L.id
                      not in(select D.user_id from xvolve.dating_details D)';
        $partner = DB::select($sqlString,[$gender,$prefer]);

        //Save information to dating detail
        $dating->user_Id =$userId;
        $dating->partner_Id = $partner[0]->id;
        $dating->save();
        return $dating;
    }
}
