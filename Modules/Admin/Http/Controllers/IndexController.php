<?php

namespace Module\Admin\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('admin::home');
    }
}
