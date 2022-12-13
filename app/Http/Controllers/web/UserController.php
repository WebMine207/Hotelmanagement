<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\web\UserRequest;
use App\Models\User;
use Carbon\Carbon;
use App\Models\PhoneCode;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $limit;

    /*For limit of pagination in the users module */
    public function __construct()
    {
        $this->limit = 10;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $query = User::select('*')
                ->where('role','!=',1);

         /*Search Filter */
        if($request->has('search_keyword') && $request->search_keyword != ""){
            $query = $query->where(function($q) use($request){
                $q->where('first_name', 'LIKE', '%'.$request->search_keyword.'%');
                $q->orWhere('last_name', 'LIKE', '%'.$request->search_keyword.'%');
                $q->orWhere('email', 'LIKE', '%'.$request->search_keyword.'%');
                $q->orWhere('mobile_number', 'LIKE', '%'.$request->search_keyword.'%');
            });
        }
        /* From & To Date filter */
        if ($request->get('fromdate')) {
            $from_date=Carbon::createFromFormat('m-d-Y',$request->get('fromdate'))->format('Y-m-d');
            $to_date=Carbon::createFromFormat('m-d-Y',$request->get('todate'))->format('Y-m-d');
            if ($request->get('fromdate') != 0) {
                $query->whereBetween('created_at', [$from_date . ' 00:00:00', $to_date . ' 23:59:59']);
            }
        }
        /**
         * User type filter
         */
        if($request->has('user_type') && $request->user_type != ""){
            $query = $query->where('role',$request->user_type);
        }
        /**
         * status filter
         */
        if($request->has('status') && $request->status != ""){
            $query = $query->where('status',$request->status);
        }

        $users = $query->paginate($this->limit)->appends($request->all());
        /* Ajax search*/
        if($request->ajax()){
            $view = view('components.users_table',compact('users'))->render();
            return response()->json(['status'=>200,'message','content'=>$view]);
        }
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('users.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */

    public function store(UserRequest $request)
    {
       abort('404');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id)
    {
        abort('404');
        try {
            $user=User::where('id',$id)->first();
            if(is_null($user)){
                return redirect()->route('users.index')->with('toast-error','User not found');
            }
            return view('users.show',compact('user'));
        }
        catch (\Exception $exception){
            return redirect()->route('users.index')->with('toast-error',"Something went wrong");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(int $id)
    {
        try {
            $user=User::where('id',$id)->first();
            $phoneCode = PhoneCode::where(function($q){
                $q->where('phone','!=','+1');
                $q->orWhere('code','US');
            })->get();
            if($user){
                return view('users.update',compact('user','phoneCode'));
            }
            return redirect()->route('users.index')->with('toast-error','User not found');
        }
        catch (\Exception $exception){
            return redirect()->route('users.index')->with('toast-error',"Something went wrong");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request,$id)
    {
        dd($request->all());
        $userId = Auth::user()->id;
        try {
            $userdata = $request->all();
            $user = User::where('role',3)->where('id',$id)->update($userdata);
            if($user){
                return redirect()->route('users.index')->with('toast-success',"Users updated successfully");
            }
            else{
                return redirect()->route('users.index')->with('toast-error',"Users not updated.Please try again");
            }
        }
        catch (\Exception $exception){
            return redirect()->route('users.index')->with('toast-error',"Something went wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id)
    {
        try {
            $user=User::where('id',$id)->delete();
            if($user){
                \Session::flash('toast-success', 'User deleted successfully');
                return response()->json(['status'=>"success",'message'=>"User deleted successfully."]);
            }
            else{
                return response()->json(['status'=>"fail",'message'=>"User not removed Please try again"]);
            }
        }
        catch (\Exception $exception){
            return redirect()->route('users.index')->with('toast-error',"Something went wrong");
        }
    }    

    public function update_status(Request $request)
    {
        try {
            $request_data=$request->all();
            $user=User::where('id',(int)$request_data['id'])->update(['status'=>(int)$request_data['status']]);
            if($user){
                return response()->json(['status'=>'success','message'=>"User status updated successfully."]);
            }
            else{
                return response()->json(['status'=>'success','message'=>"User status not updated Please try again."]);
            }
        }
        catch (\Exception $exception){
            return response()->json(['status'=>'fail','message'=>"Something wrong"]);
        }
    }
}
