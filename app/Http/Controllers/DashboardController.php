<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function statistics(){
        try {
            $userCount = User::where('email', '!=', 'adminayda@gmail.com')->count();
            $staffCount = Staff::count();
            return response()->json([
                'user_count' => $userCount,
                'staff_count' => $staffCount
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 500);
        }
    }
}
