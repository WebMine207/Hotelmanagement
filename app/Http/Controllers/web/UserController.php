<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\web\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('users.index');
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
     * @throws \Exception
     */
    public function lists(Request $request)
    {
        try {
        $users = User::query();
        $users->where('role',3);
        if(!isset($request->order)){
            $users->orderBy('created_at','desc');
        }
        return DataTables::of($users)
            ->editColumn('status',function (User $user){
                $is_active=(int)$user->status==1?"checked":"";
                return "<div class='form-group'>
                                        <div class='custom-control custom-switch'>
                                            <input type='checkbox' class='custom-control-input update_status' value='$user->id' id='customSwitch$user->id' $is_active>
                                            <label class='custom-control-label' for='customSwitch$user->id'></label>
                                        </div>
                                    </div>";
            })
            ->addColumn('action',function (User $user){
                return '<a class="btn btn-primary btn-sm" href="'.route('users.show',$user->id).'">
                                        <i class="fas fa-folder">
                                        </i>
                                        View
                                    </a>
                                    <a class="btn btn-info btn-sm" href="'.route('users.edit',$user->id).'">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm button_user_delete" data-url="'.route('users.destroy',$user->id).'" href="#" >
                                        <i class="fas fa-trash">
                                        </i>
                                        Delete
                                    </a>';
            })
            ->escapeColumns([])
            ->make(true);
        }
        catch (\Exception $exception){
            return redirect()->route('users.index')->withError("Something wrong");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */

    public function store(UserRequest $request)
    {
        try {
            $status = [1,2];
            $input_data = $request->validated();
            $user = new User();
            $user->name=trim($input_data['username']);
            $user->email=trim($input_data['email']);
            $user->password=bcrypt($input_data['password']);
            $user->role=3;
            $user->status=in_array($input_data['status'],$status) ? $input_data['status'] : 1;
            if($user->save()){
                return redirect()->route('users.index')->withSuccess("Users added successfully.");
            }
            else{
                return redirect()->route('users.index')->withError("Users not added.Please try again.");
            }
        }
        catch (\Exception $exception){
            return redirect()->route('users.index')->withError("Something wrong");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id)
    {
        try {
            $user=User::where('id',$id)->first();
            if(is_null($user)){
                return redirect()->route('users.index')->withError("User not found.");
            }
            return view('users.show',compact('user'));
        }
        catch (\Exception $exception){
            return redirect()->route('users.index')->withError("Something wrong");
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
            if(is_null($user)){
                return redirect()->route('users.index')->withError("User not found.");
            }
            return view('users.edit',compact('user'));
        }
        catch (\Exception $exception){
            return redirect()->route('users.index')->withError("Something wrong");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UserRequest $request, int $id)
    {
        try {
            $status = [1,2];
            $input_data = $request->validated();
            $user = User::where('role',3)->where('id',$id)->first();
            $user->name=trim($input_data['username']);
            $user->email=trim($input_data['email']);
            $user->status=in_array($input_data['status'],$status) ? $input_data['status'] : 1;
            if($user->save()){
                return redirect()->route('users.index')->withSuccess("Users updated successfully.");
            }
            else{
                return redirect()->route('users.index')->withError("Users not updated.Please try again.");
            }
        }
        catch (\Exception $exception){
            return redirect()->route('users.index')->withError("Something wrong");
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
                return redirect()->route('users.index')->withSuccess("User deleted successfully.");
            }
            else{
                return redirect()->route('users.index')->withError("User not removed Please try again.");
            }
        }
        catch (\Exception $exception){
            return redirect()->route('users.index')->withError("Something wrong");
        }
    }

    public function update_status(Request $request)
    {
        try {
            $request_data=$request->all();
            $user=User::where('id',(int)$request_data['id'])->update(['status'=>(int)$request_data['status']]);
            if($user){
                return response()->json(['status'=>true,'message'=>"User status updated successfully."]);
            }
            else{
                return response()->json(['status'=>true,'message'=>"User status not updated Please try again."]);
            }
        }
        catch (\Exception $exception){
            return response()->json(['status'=>false,'message'=>"Something wrong"]);
        }
    }
}
