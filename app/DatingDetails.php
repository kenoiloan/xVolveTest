<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatingDetails extends Model
{
    private $user_Id;
    private $partner_Id;

    /**
     * @param $userId
     * @return bool
     */
    public function checkExistUser($userId):bool {
        $result = DatingDetails::where('user_id',$userId)->count();
        return $result > 0 ? true:false;
    }
    /**
     * @param $partnerId
     * @return bool
     */
    public function checkExistPartner($partnerId){
        $result = DatingDetails::where('partner_id',$partnerId)->count();
        return $result > 0 ? true:false;
    }

    /**
     * @param $userId
     * @return mixed
     */
    public function getDetail($userId){
        return DatingDetails::where('user_id',$userId)->first();
    }
}
