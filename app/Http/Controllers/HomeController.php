<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Service;
use App\Model\Patient;
use App\Model\Doctor;
use App\Model\Department;
use App\Model\Invoice;
use App\User;


class HomeController extends Controller
{
    private $star;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->star='dashboard';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $star=$this->star;
        return view('home', compact('star'));
    }

    public function status_change(Request $request){
        $part=$request->part;
        $service_id=$request->service_id;
        $status=$request->status;
        switch ($part) {
            case 'service':
                $ob=Service::Find($service_id);
                break;
            case 'department':
                $ob=Department::Find($service_id);
                break;
            case 'doctor':
                $ob=Doctor::Find($service_id);
                break;
            case 'invoice':
                $ob=Invoice::Find($service_id);
                break;
            case 'patient':
                $ob=Patient::Find($service_id);
                break;
            case 'staff':
                $ob=User::Find($service_id);
                break;
            default:
                return redirect()->back();
                break;
        }
        $ob->status=$status;
        $ob->status_date=date('yy-m-d');
        $ob->save();
        return redirect()->back()->with('status','Successfully ',$status );
    }
}
