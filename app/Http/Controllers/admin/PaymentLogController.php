<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentLog;
use Illuminate\Http\Request;

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
            PaymentLog::find($id)->update(['status' => 1]);
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }
}
