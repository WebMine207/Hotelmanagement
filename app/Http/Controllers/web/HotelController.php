<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\web\HotelsRequest;
use App\Models\Hotel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('hotels.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('hotels.create');
    }

    /**
     * @throws \Exception
     */
    public function lists(Request $request)
    {
        try {
            $hotels = Hotel::query();
            if(!isset($request->order)){
                $hotels->orderBy('created_at','desc');
            }
            return DataTables::of($hotels)
                ->editColumn('status',function (Hotel $hotel){
                    $is_active=(int)$hotel->status==1?"checked":"";
                    return "<div class='form-group'>
                                        <div class='custom-control custom-switch'>
                                            <input type='checkbox' class='custom-control-input update_status' value='$hotel->id' id='customSwitch$hotel->id' $is_active>
                                            <label class='custom-control-label' for='customSwitch$hotel->id'></label>
                                        </div>
                                    </div>";
                })
                ->addColumn('action',function (Hotel $hotel){
                    return '<a class="btn btn-primary btn-sm" href="'.route('hotels.show',$hotel->id).'">
                                        <i class="fas fa-folder">
                                        </i>
                                        View
                                    </a>
                                    <a class="btn btn-info btn-sm" href="'.route('hotels.edit',$hotel->id).'">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm button_user_delete" data-url="'.route('hotels.destroy',$hotel->id).'" href="#" >
                                        <i class="fas fa-trash">
                                        </i>
                                        Delete
                                    </a>';
                })
                ->escapeColumns([])
                ->make(true);
        }
        catch (\Exception $exception){
            return redirect()->route('hotels.index')->withError("Something wrong");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(HotelsRequest $request)
    {
        DB::beginTransaction();
        try {
            $status = [1,2];
            $input_data = $request->validated();
            $user=new User;
            $user->name=trim($input_data['hotel_name']);
            $user->email=trim($input_data['email']);
            $user->password=bcrypt($input_data['password']);
            $user->role=2;
            $user->status=1;
            $user->save();
            $hotel = new Hotel();
            $hotel->name=trim($input_data['hotel_name']);
            $hotel->user_id=$user->id;
            $hotel->thumbnail_image="default.jpg";
            $hotel->status=in_array($input_data['status'],$status) ? $input_data['status'] : 1;
            if($hotel->save()){
                DB::commit();
                return redirect()->route('hotels.index')->withSuccess("Hotels added successfully.");
            }
            else{
                DB::rollback();
                return redirect()->route('hotels.index')->withError("Hotels not added.Please try again.");
            }
        }
        catch (\Exception $exception){
            DB::rollback();
            return redirect()->route('hotels.index')->withError("Something wrong");
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
            $hotel=Hotel::where('id',$id)->first();
            if(is_null($hotel)){
                return redirect()->route('hotels.index')->withError("Hotel not found.");
            }
            return view('hotels.show',compact('hotel'));
        }
        catch (\Exception $exception){
            return redirect()->route('hotels.index')->withError("Something wrong");
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
            $hotel=Hotel::where('id',$id)->first();
            if(is_null($hotel)){
                return redirect()->route('hotels.index')->withError("Hotel not found.");
            }
            return view('hotels.edit',compact('hotel'));
        }
        catch (\Exception $exception){
            return redirect()->route('hotels.index')->withError("Something wrong");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return Response
     */
    public function update(HotelsRequest $request, int $id)
    {
        try {
            $status = [1,2];
            $input_data = $request->validated();
            $user = Hotel::where('id',$id)->first();
            $user->name=trim($input_data['hotel_name']);
            $user->status=in_array($input_data['status'],$status) ? $input_data['status'] : 1;
            if($user->save()){
                return redirect()->route('hotels.index')->withSuccess("Hotel updated successfully.");
            }
            else{
                return redirect()->route('hotels.index')->withError("Hotel not updated.Please try again.");
            }
        }
        catch (\Exception $exception){
            return redirect()->route('hotels.index')->withError("Something wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {

        try {
            $hotel=Hotel::where('id',$id)->delete();
            if($hotel){
                return redirect()->route('hotels.index')->withSuccess("Hotel deleted successfully.");
            }
            else{
                return redirect()->route('hotels.index')->withError("Hotel not removed Please try again.");
            }
        }
        catch (\Exception $exception){
            return redirect()->route('hotels.index')->withError("Something wrong");
        }
    }


    public function update_status(Request $request)
    {
        try {
            $request_data=$request->all();
            $hotel=Hotel::where('id',(int)$request_data['id'])->update(['status'=>(int)$request_data['status']]);
            if($hotel){
                return response()->json(['status'=>true,'message'=>"Hotel status updated successfully."]);
            }
            else{
                return response()->json(['status'=>true,'message'=>"Hotel status not updated Please try again."]);
            }
        }
        catch (\Exception $exception){
            return response()->json(['status'=>false,'message'=>"Something wrong"]);
        }
    }
}
