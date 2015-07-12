<?php
/**
 * Created by PhpStorm.
 * User: Farhan Wazir
 * Date: 6/28/2015
 * Time: 10:52 AM
 */

namespace Asterisk\Http\Controllers;


class WelcomeController extends Controller
{

    //This is test msg
    protected $welcome_msg;

    function __construct($welcome_msg = 'hello brother')
    {
        $this->welcome_msg = $welcome_msg;
    }

    /**
     * @return welcome.blade.php
     */
    function index()
    {
        return view('welcome');
    }

    /**
     * @return mixed
     */
    public function getWelcomeMsg()
    {
        return $this->welcome_msg;
    }

    /**
     * @param mixed $welcome_msg
     */
    public function setWelcomeMsg($welcome_msg)
    {
        $this->welcome_msg = $welcome_msg;
    }
}