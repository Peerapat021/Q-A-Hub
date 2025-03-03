<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

use function Ramsey\Uuid\v1;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('dashboard.dashboard');
    }
}
