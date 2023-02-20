<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
       $data['title'] = 'SMS';
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
       return view('customer', $data);
    }

    public function addCustomer(Request $request)
    {
        $Sms = new Sms;
        $user_id =  auth()->id();  
        $dataarray = array();         
        $request->validate([
        'csvfile' => 'required',        
        ]);
        if ($request->file('csvfile')) {
            $file = $request->file('csvfile');
            $name = $file->getClientOriginalName();
            $fileName = time().'_'.$name;
            $request->file('csvfile')->storeAs('public/uploads',$fileName,'local');    
            $getpath = Storage::disk('local')->path('public/uploads/'.$fileName);  
            $dataarray = $this->csvToArray($getpath);      
            for ($i = 0; $i < count($dataarray); $i ++)
            {
                $Sms->addCustomers($user_id,$dataarray[$i]);
            }
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

    
    




    public function send() {

        echo 'hello';
        // // Account details
        // $apiKey = urlencode('NGEzNzUzNDg0ODQ3NzE1OTc0NmY3NjUzNjM0OTM3Mzc=');
        // // Message details
        // $numbers = array(919818892457,919906745021);
        // $sender = urlencode('TXTLCL');
        // $message = rawurlencode('This is your message');
        
        // $numbers = implode(',', $numbers);
        
        // // Prepare data for POST request
        // $data = array('apikey' => $apiKey, 'numbers' => $numbers, 'sender' => $sender, 'message' => $message);
        // // Send the POST request with cURL
        // $ch = curl_init('https://api.textlocal.in/send/');
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $response = curl_exec($ch);
        // curl_close($ch);
        // // Process your response here
        // return $response;

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

}
