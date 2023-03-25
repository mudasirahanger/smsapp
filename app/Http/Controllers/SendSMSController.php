<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\libraries\textlocal\Textlocal;
use App\Models\Sms;

class SendSMSController extends Controller
{
    //
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function create()
    {
       $data = array();
       $Sms = new Sms;
       $user_id =  auth()->id();  
       $data['title'] = 'Bulk SMS';

       $data['templates'] =  $Sms->getAllSettings($user_id,3);
       $data['groups'] =  $Sms->getGroups($user_id);

       return view('sms', $data);
    }


    public function whatsapp()
    {
       $data = array();
       $data['title'] = 'Whatsapp';
       return view('sms', $data);
    }


    public function customer()
    {
       $data = array();
       $Sms = new Sms;
       $user_id =  auth()->id();  
       $total = $Sms->getCustomers($user_id);
       $data['title'] = 'Customer';
       $data['message'] = 'Total Customers : ' . count($total);
       $data['groups'] =  $Sms->getGroups($user_id);
       return view('customer', $data);
    }

    public function customerGroups()
    {
       $data = array();
       $Sms = new Sms;
       $user_id =  auth()->id();  
       $total = $Sms->getCustomers($user_id);
       $data['title'] = 'Customer Groups';
       return view('customergroups', $data);
    }
    
    public function AddcustomerGroup(Request $request)
    {
       $data = array();
       $Sms = new Sms;
       $user_id =  auth()->id();  
       $request->validate([
        'csvGroupName' => 'required',  
        ]);
        if ($request->input('csvGroupName')) {
            $groupname = $request->input('csvGroupName');
            $group = $Sms->addCustomersGroups($user_id,$groupname);
            if($group){
            Session::flash('message', 'Group Created Successfully !'); 
            return redirect('customerGroups');
            }
        } else {
        return redirect('customerGroups'); 
        }
    }


    public function addCustomer(Request $request)
    {
        $Sms = new Sms;
        $user_id =  auth()->id();  
        $dataarray = array();         
        $request->validate([
        'csvGroup' => 'required',
        'csvfile' => 'required',        
        ]);
        if ($request->file('csvfile')) {
            $file = $request->file('csvfile');
            $group = $request->input('csvGroup');
            $name = $file->getClientOriginalName();
            $fileName = time().'_'.$name;
            $request->file('csvfile')->storeAs('public/uploads',$fileName,'local');    
            $getpath = Storage::disk('local')->path('public/uploads/'.$fileName);  
            $dataarray = $this->csvToArray($getpath);      
            for ($i = 0; $i < count($dataarray); $i ++)
            {
                $Sms->addCustomers($user_id,$group,$dataarray[$i]);
            }
            Session::flash('success', 'Customer Created Successfully !');
            return redirect('Customer');
        } else {    
            return redirect('Customer');           
        }
        
    }

    public function settings() {
        $Sms = new Sms;
        $user_id =  auth()->id();
        $data = array();
        $data['title'] = 'Settings';
        $data['smsgateways'] =  $Sms->getAllSettings($user_id,2);
        $data['templates'] =  $Sms->getAllSettings($user_id,3);
        return view('settings', $data);
    }

    public function getDashboardAjax(){
        return '0';
    }
    
    public function AddSettings(Request $request){
        $Sms = new Sms;
        $user_id =  auth()->id(); 
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'keys' => 'required',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()->all()
                    ]);
        } else {      
            $SMS = $Sms->addSettings($user_id,$request);
            if($SMS){
                return response()->json(['success' => 'Post created successfully.']);
            } else {
                return response()->json([
                    'error' => 'something went wrong'
                ]);
            }
        }
    }
    public function getsettingsAjaxSMS(Request $request) {
        $Sms = new Sms;
        $user_id =  auth()->id(); 
        $table = '';
        if(isset($request->id) && !empty($request->id)){
         $setting_type = ($request->id);        
         $SMS = $Sms->getAllSettings($user_id,$setting_type);
         if(!empty($SMS)){
         foreach($SMS as $key => $values){
           $table .= '<tr>
                     <td>'.$values->name.'</td>
                     <td>'.$values->keys.'</td>';
           if($values->status){
            $table .='<td class="badge rounded-pill text-bg-success"> Enabled </td>';
           } else {
            $table .='<td class="badge rounded-pill text-bg-danger"> Disabled </td>';
           }
           $table .= '<td>'.$values->date_added.'</td>
                      <td><button class="btn btn-danger" onclick="deleteSettings('. $values->settings_id .')"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                      <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                      </svg> </button></td>
                     </tr>';
         }
         return response($table);
         
      
        } else {
            return response('<tr><td class="text-center">no records found</td></tr>');
        }
        } else {
            return response('<tr><td class="text-center">no records found</td></tr>');
        }    
    }
     

    public function deleteSettings(Request $request){
        $Sms = new Sms;
        $id = $request->id;
        if(isset($id) && !empty($id)){      
            $SMS = $Sms->deleteSettingsByID($id);
            if($SMS){
                return response(true);
            } else {
                return response(false);
            }
        }
    }

    public function send(Request $request) {
        $Sms = new Sms;
        $user_id =  auth()->id(); 
        $request->validate([
            'customer_group_id' => 'required',
            'template_id' => 'required',        
            ]);      
        if(!empty($request->input('customer_group_id'))){

            $group_id = $request->input('customer_group_id');
            $template_id = $request->input('template_id');
            $sms = $Sms->sendSMS($user_id,$group_id,$template_id);
            if($sms) {
            Session::flash('success', 'SMS Send Successfully !');
            } else {
                Session::flash('success', 'something went wrong');
            }
            return redirect('SendSMS');
            
        } else {
            Session::flash('success', 'something went wrong');
            return redirect('SendSMS');
        }
    }


    public function SMS_API_JOB() {
        $Sms = new Sms;
        $user_id =  auth()->id(); 
        // Account details
        $URL = 'https://api.textlocal.in/send/';
        $apiKey = urlencode('NGEzNzUzNDg0ODQ3NzE1OTc0NmY3NjUzNjM0OTM3Mzc=');
        
        $sms_queues = $Sms->getSMSQueue($user_id);

        foreach($sms_queues as  $queue){
          $group_id = $queue->group_id;
          $template_id = $queue->template_id;
          $customers = $Sms->getCustomersByGroups($user_id,$group_id);
        }
         for($i = 0; $i <= count($customers); $i ++){
            if(!empty($customers[$i]->mobile)){
           // $numbers[] =  $customers[$i]->mobile;
            }
         }

        // Message details
        $numbers = array(919906745021);
        $sender = urlencode('399582');
        $message = "Dear%20Students.%nUpgrade%20your%20Management/Coding%20Skills%20with%20Online%20MBA%20or%20MCA%20program%20from%20NAAC%20A%2B%20Universities.%20Call%409818892457%nBigEdge%20Consultant%20Pvt.Ltd.";
        $numbers = implode(',', $numbers);

	 $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message,"test" => 'true');   
     $resp =  $this->CurlSMS($URL,$data);
     if($resp){
     $Sms->writesendSMSLog($user_id,$group_id,$template_id,$resp['status'],$resp['balance']);
     echo $resp['status'];
    }             
    }

   public function csvToArray($filename = '', $delimiter = ',')
        {
            if (!file_exists($filename) || !is_readable($filename))
                return false;

            $header = null;
            $data = array();
            if (($handle = fopen($filename, 'r')) !== false)
            {
                while (($row = fgetcsv($handle, 100000, $delimiter)) !== false)
                {
                    if (!$header)
                        $header = $row;
                    else
                        $data[] = array_combine($header, $row);
                }
                fclose($handle);
            }

            return $data;
        }


    public function CurlSMS($url, $data)
    {
       
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response,true);
    }

}
