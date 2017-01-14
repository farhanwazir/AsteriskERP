<?php

namespace Asterisk\Http\Controllers;

use Illuminate\Http\Request;

use Asterisk\Http\Requests;
use Asterisk\Http\Controllers\Controller;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('test');
    }
}
