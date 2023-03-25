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
            'sms_status' => 'pending',
            'sms_send'   => 0,
            'user_id' => (int)$user_id,
            'date_added' =>  Carbon::now(),
            'sms_send_time' => Carbon::now()
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

    public function getCustomersByGroups($user_id,$group_id){
        $customers = DB::table('customers')
        ->where('user_id',$user_id)
        ->where('group_id',$group_id)
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

    public function getSMSQueue($user_id){
        $sms_queue = DB::table('sms_queue')
        ->where('user_id',$user_id)
         ->get();

        if(!empty($sms_queue)){
            return $sms_queue->toArray();
        } else {
            return [];
        }
    }


    public function sendSMS($user_id,$group_id,$template_id){

        $sms =  DB::table('sms_queue')->insert([
            'group_id' => $group_id,
            'template_id' => $template_id,
            'user_id' => $user_id,
            'date_added' => Carbon::now()
        ]);

        if(($sms)){
            return true;
        } else {
            return false;
        }
    }

    public function writesendSMSLog($user_id,$group_id,$template_id,$status,$total_cost){

        $sms =  DB::table('sms_log')->insert([
            'user_id' => $user_id,
            'group_id' => $group_id,
            'template_id' => $template_id,
            'status' => $status,
            'total_cost' => $total_cost,
            'date_added' => Carbon::now()
        ]);

        if(($sms)){
            return true;
        } else {
            return false;
        }
    }

    public function writeCustomerSMSLog($user_id,$mobile,$status){
        $customer = DB::table('customers')
        ->where('user_id', $user_id) 
        ->where('mobile', $mobile) // find your user by their email
        ->limit(1)  // optional - to ensure only one record is updated.
        ->update(array('sms_status'=> $status,'sms_send_time' => Carbon::now()));  // update the record in the DB

        if(($customer)){
            return true;
        } else {
            return false;
        }
    }

}
