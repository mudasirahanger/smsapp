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
    

    public function addCustomers($user_id,$group,$data){

        $customer =  DB::table('customers')->insert([
            'fname' => $data['firstname'],
            'lname' => $data['lastname'],
            'mobile' => $data['mobile'],
            'group_id' => (int)$group,
            'user_id' => $user_id,
            'date_added' => Carbon::now()
        ]);

        if(($customer)){
            return true;
        } else {
            return false;
        }
    }

    public function getCustomers($user_id){
        $customers = DB::table('customers')
        ->where('user_id',$user_id)
        ->orderBy('date_added', 'desc')
        // ->limit(5)
         ->get();

        if(!empty($customers)){
            return $customers->toArray();
        } else {
            return [];
        }
    }

    public function addCustomersGroups($user_id,$groupname){

        $customer_group =  DB::table('customers_groups')->insert([
            'name' => $groupname,
            'user_id' => $user_id,
            'date_added' => Carbon::now()
        ]);

        if(($customer_group)){
            return true;
        } else {
            return false;
        }
    }

    public function getGroups($user_id){
        $groups = DB::table('customers_groups')
        ->where('user_id',$user_id)
         ->get();

        if(!empty($groups)){
            return $groups->toArray();
        } else {
            return [];
        }
    }

}
