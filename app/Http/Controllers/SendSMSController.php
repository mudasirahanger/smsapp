<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class SendSMSController extends Controller
{
    //
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
       $data['title'] = 'Customer';
       return view('customer', $data);
    }

    public function settings() {
        $data = array();
        $data['title'] = 'Settings';
        return view('settings', $data);
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

}
