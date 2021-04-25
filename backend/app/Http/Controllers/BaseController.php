<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BaseController extends Controller
{

 /**
     *@OA\Info(title="Adware API Docs", version="1.0")
 */
    /** generate a unique account no recursively
     *   @return string account_no
     */
    public function generateAccountNo()
    {
        $randomNo = mt_rand(1000000, 9000000);
        $searchUser = User::where('account_no', $randomNo)->first();
        if (!empty($searchUser)) {
            return $this->generateAccountNo();
        } else {
            return $randomNo;
        }
    }
}
