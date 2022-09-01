<?php

namespace App\Http\Controllers;

use App\Models\PaymentLog;
use App\Models\Request as MyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PaymentController extends Controller
{
    public $rid, $resource;
    // public function __construct()
    // {
    //     $this->rid = $rid;
    //     $this->resource = $resource;
    // }

    public function token()
    {
        // $data = "70VB4BU1661799484550?rid=1?resource=resource";
        // $dataarr = explode('?', $data);
        // dd($dataarr);

        session()->forget('bktoken');
        session_start();
        $request_token = $this->_bkash_Get_Token();
        $idtoken = $request_token['id_token'];
        session()->put('bktoken', $request_token["id_token"]);

        echo $idtoken;
    }

    protected function _bkash_Get_Token()
    {
        $post_token = array(
            'app_key' => env("BKASH_APP_KEY"),
            'app_secret' => env("BKASH_APP_SECRET")
        );

        $url = curl_init(env("BKASH_TOKEN_URL"));
        // $proxy = $array["proxy"];
        $posttoken = json_encode($post_token);
        $header = array(
            'Content-Type:application/json',
            'password:' . env("BKASH_PASSWORD"),
            'username:' . env("BKASH_USER_NAME")
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $posttoken);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        //curl_setopt($url, CURLOPT_PROXY, $proxy);
        $resultdata = curl_exec($url);
        curl_close($url);
        return json_decode($resultdata, true);
    }


    public function createpayment()
    {
        session_start();

        $amount = $_GET['amount'];
        $invoice = $_GET['invoice']; // must be unique
        $intent = "sale";
        // $proxy = $array["proxy"];
        $createpaybody = array('amount' => $amount, 'currency' => 'BDT', 'merchantInvoiceNumber' => $invoice, 'intent' => $intent);
        $url = curl_init(env("BKASH_CREATE_URL"));

        $createpaybodyx = json_encode($createpaybody);

        $header = array(
            'Content-Type:application/json',
            'authorization:' . session()->get('bktoken'),
            'x-app-key:' . env("BKASH_APP_KEY")
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $createpaybodyx);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        //curl_setopt($url, CURLOPT_PROXY, $proxy);

        $resultdata = curl_exec($url);
        curl_close($url);
        echo $resultdata;
    }

    public function executepayment(Request $request)
    {
        // dd($request->all());
        session_start();

        // $array = $this->_get_config_file();

        $paymentID = $_GET['paymentID'];

        // $rIdStr = explode('?', $paymentID);
        // $rIdarr = explode('=', $rIdStr[1]);
        // $resourcearr = explode('=', $rIdStr[2]);

        $this->rid = $request->rid; //$rIdarr[1];
        $this->resource = $request->resources; //$resourcearr[1];

        $url = curl_init(env("BKASH_EXECUTE_URL") . $paymentID);

        $header = array(
            'Content-Type:application/json',
            'authorization:' . session()->get('bktoken'),
            'x-app-key:' . env("BKASH_APP_KEY")
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        // curl_setopt($url, CURLOPT_PROXY, $proxy);

        $resultdatax = curl_exec($url);
        curl_close($url);

        $this->_updateOrderStatus($resultdatax);

        echo $resultdatax;
    }

    protected function _updateOrderStatus($resultdatax)
    {
        // dd($resultdatax);
        $resultdatax = json_decode($resultdatax);
        // dd($rid);
        if ($resultdatax) :
            if (isset($resultdatax->paymentID) && @$resultdatax->transactionStatus == 'Completed') {
                $additionalData = session()->get("bKadditional");
                DB::beginTransaction();
                // MyRequest::find($rId)->update(['payment_status' => 1]);
                if (
                    PaymentLog::create([
                        'request_id' => $additionalData["req_id"],
                        'amount' => $resultdatax->amount,
                        'payment_method' => "Bkash",
                        'payment_details' => json_encode($resultdatax),
                        'pay_by' => Auth()->id(),
                        'pay_for' => $additionalData["resource"],
                        'bid_id' => $additionalData["bid_id"]
                    ])
                ) {
                    if ($this->resource == 'requests') :
                        MyRequest::find($this->rId)->update(['payment_status' => 1]);
                    endif;
                    DB::commit();
                    return response()->json(['status' => 1, "message" => "Payment Success"]);
                } else {
                    DB::rollBack();
                    return response()->json(['status' => 0, "message" => "Payment Faild"]);
                }
            } else {
                return response()->json(['status' => 0, "message" => "Something went wrong please try again later."]);
            }
        endif;
    }

    public function paymentAdditional(Request $request)
    {
        session()->forget('bKadditional');
        session()->put('bKadditional', ["bid_id" => $request->bid_id, "amount" => $request->amount, "resource" => $request->resource, "req_id" => $request->req_id]);
        return response()->json(['status' => true, 'data' => session()->get('bKadditional')]);
    }
}
