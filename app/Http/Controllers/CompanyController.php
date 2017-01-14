<?php

namespace Asterisk\Http\Controllers;

use Illuminate\Http\Request;

use Asterisk\Http\Requests;
use Asterisk\Http\Controllers\Controller;

class CompanyController extends Controller
{
    /**
     * Company Profile
     *
     * @return Response
     */
    public function about()
    {
        /*return view('asterisk.company.about');*/
        return view('asterisk.dashboards.administrator');
    }

    /**
     * Software User Guide
     * @return Guide View
     */
    public function guide()
    {
        return view('asterisk.company.guide');
    }

    /**
     * Software Support
     * @return Support View
     */
    public function support()
    {
        return view('asterisk.company.support');
    }
}
