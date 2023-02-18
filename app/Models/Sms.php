<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Sms extends Model
{
    use HasFactory;
    
    protected $table_settings = 'settings';
    

    public function getAllSettings($user_id,$setting_type){
        $settings = DB::table('settings')
        ->where('user_id',$user_id)
        ->where('settings_type',$setting_type)
        ->orderBy('date_added', 'desc')
        // ->limit(5)
         ->get();

        if(!empty($settings)){
            return $settings->toArray();
        } else {
            return [];
        }
    }

    public function addSettings($user_id,$settings){

        $settings =  DB::table('settings')->insert([
            'name' => $settings->name,
            'keys' => $settings->keys ,
            'status' => $settings->status,
            'user_id' => $user_id,
            'settings_type' => $settings->settings_type,
            'date_added' => Carbon::now()
        ]);

        if(($settings)){
            return true;
        } else {
            return false;
        }
    }

    public function deleteSettingsByID($id){
        $settings = DB::table('settings')
        ->where('settings_id', $id)->delete();
        if(($settings)){
            return true;
        } else {
            return false;
        }
    }


}