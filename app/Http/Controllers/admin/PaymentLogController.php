<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\PaymentLog;
use App\Models\Request as ModelsRequest;
use App\Models\User;
use App\Notifications\paymentApproved;
use App\Notifications\SolNotification;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PaymentLogController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data["model"] = new PaymentLog();
        $data["items"] = PaymentLog::get()->groupBy('pay_for');
        $step = 'requests';
        if (isset($_GET["step"])) {
            $step = $_GET["step"];
        }
        $data["collections"] = PaymentLog::with('fundBuyer')->where('pay_for', $step)->get();
        return view('admin.payment-log', $data);
    }

    public function payToSeller(Request $request, $id)
    {
        if ($request->ajax()) {
            $paymentData = PaymentLog::find($id);
            $payeeDetails = User::find($paymentData->pay_by);
            $data = [];
            $data["user_id"] = $paymentData->pay_by;
            $data["name"] = $payeeDetails->username;
            $data["image"] = $payeeDetails->image;
            $data["message"] = "Payment approved";
            $data["mesg"] = "Payment approved";
            $data["link"] = 'product.index';
            $data["request_id"] = $paymentData->request_id;

            $storeNotification = new Notification();
            $storeNotification->id = (string) Str::uuid();
            $storeNotification->type = 'App\Models\PaymentLog';
            $storeNotification->notifiable_id =  $paymentData->seller_id;
            $storeNotification->notifiable_type =  'App\Models\User';
            $storeNotification->data =  json_encode($data);
            // ::create([
            //     'id' => (string) Str::uuid(),
            //     "type" => 'App\Models\PaymentLog',
            //     "notifiable_id" => $paymentData->seller_id,
            //     'notifiable_type' => 'App\Models\User',
            //     "data" => json_encode($data)
            // ]);
            $storeNotification->save();
            // dd((string) Str::uuid());
            $req = ModelsRequest::where('id', 1)->first();
            $log = PaymentLog::first();
            $user = User::find(auth()->user()->id);
            $data = User::find(1);
            // dd($user);
            $data->notify(new paymentApproved($user, $log));
            // return 1;
            PaymentLog::find($id)->update(['status' => 1]);
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function checkB2C()
    {
        $client = new Client();
        $response = $client->request('POST', 'https://openfin.bka.sh/openfin/loanPayout/b2cPayment', [
            'headers' => [
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ],
        ]);

        // dd($response);
    }
}
