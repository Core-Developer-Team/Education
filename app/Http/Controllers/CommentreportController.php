<?php

namespace App\Http\Controllers;

use App\Models\Commentreport;
use Illuminate\Http\Request;

class CommentreportController extends Controller
{
    public function get($uid,$cid)
    {
        Commentreport::Create([
           'user_id' => $uid,
           'reqcomment_id' => $cid,
        ]);
      
        return back()->with('success', 'Report send Successfully');
    }
}
