<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\web\HotelsRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Hotel;
use App\Models\User;
use App\Models\PhoneCode;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class HotelController extends Controller
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
        $owners = User::where('role',3)->get();
        $query = Hotel::select('*');
         /*Search Filter */
        if($request->has('search_keyword') && $request->search_keyword != ""){
            $query = $query->where(function($q) use($request){
                $q->where('name', 'LIKE', '%'.$request->search_keyword.'%');
                $q->orWhere('total_room', 'LIKE', '%'.$request->search_keyword.'%');
            });
        }
        /**
         * owner wise hotels filter
         */
        if($request->has('owner') && $request->owner != ""){
            $query = $query->where('user_id', $request->owner);
        }
        /**
         * hotel type filter
         */
        if($request->has('hotel_type') && $request->hotel_type != ""){
            $query = $query->where('hotel_type', $request->hotel_type);
        }
        
        /**
         * status filter
         */
        if($request->has('status') && $request->status != ""){
            $query = $query->where('status',$request->status);
        }

        $hotels = $query->orderBy('id', 'DESC')->paginate($this->limit)->appends($request->all());
        /* Ajax search*/
        if($request->ajax()){
            $view = view('components.hotels_table',compact('hotels'))->render();
            return response()->json(['status'=>200,'message','content'=>$view]);
        }
        return view('hotels.index',compact('hotels','owners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $phone_codes = PhoneCode::get();
        return view('hotels.create',compact('phone_codes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(HotelsRequest $request)
    {
        try {
            $data = $request->all();
            $userdata = [
                'email'          => $request->email,
                'first_name'     => $request->first_name,
                'last_name'      => $request->last_name,
                'phone_code'     => $request->phone_code,
                'mobile_number'  => $request->mobile_number,
                'role'           => 3,
                'password'       => Hash::make($request->password) ,
            ];
            $user = User::create($userdata);
            if($user){
                $data['user_id'] = $user->id;
            }
            if(Hotel::create($data)){
                return redirect()->route('hotels.index')->with('toast-success',"Hotel added successfully");
            }
        }
        catch (\Exception $exception){
            return redirect()->route('hotels.index')->with('toast-error',"Something went wrong");
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
            return redirect()->route('hotels.index')->withError("Something went wrong");
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
    public function destroy(int $id)
    {
        try {
            $hotel=Hotel::where('id',$id)->delete();
            if($hotel){
                \Session::flash('toast-success', 'Hotel deleted successfully');
                return response()->json(['status'=>"success",'message'=>"Hotel deleted successfully."]);
            }
            else{
                return response()->json(['status'=>"fail",'message'=>"Hotel not removed Please try again"]);
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
                return response()->json(['status'=>'success','message'=>"Hotel status updated successfully."]);
            }
            else{
                return response()->json(['status'=>'success','message'=>"Hotel status not updated Please try again."]);
            }
        }
        catch (\Exception $exception){
            return response()->json(['status'=>'fail','message'=>"Something wrong"]);
        }
    }
}
