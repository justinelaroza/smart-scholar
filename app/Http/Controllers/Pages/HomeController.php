<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\FacebookService;

class HomeController extends Controller
{
    protected $facebookService;

    public function __construct(FacebookService $facebookService)
    {
        $this->facebookService = $facebookService;
    }

    public function index() 
    {
        return view('pages.home');
    }

    public function feedAjax()
    {
        $posts = $this->facebookService->fetchFacebookPosts();
        $html = $this->facebookService->renderPosts($posts);

        return response()->json(['html' => $html]);
    }
}
