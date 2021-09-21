<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Customer\RegisterRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pages.customer.index');
       
    }
    public function getCustomers(Request $request)
    {
        $customers = User::all();
        return Datatables::of($customers)
            ->addIndexColumn()
            ->make(true);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        $data = $request->except('_token');
        if($data['status'] =='active'){
            $status =true;
        }else{
            $status =false;
        }
        $data['user_name'] = \Str::slug($data['name']);
        $data['password'] = Hash::make($data['password']);
        $data['is_active'] = $status;
        $store = User::create($data);
        return Redirect::back()->with('success','Customer Create successfully');
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = User::findOrFail($id);
        return view('pages.customer.edit',compact('customer'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'name'=>'required',
            'status'=>'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id),
            ]
        ]);
        if($request->status =='active'){
            $status =true;
        }else{
            $status =false;
        }
        $customer = User::findOrFail($id);
        $customer->name = $request->name;
        $customer->user_name = \Str::slug($request->name);
        $customer->email = $request->email;
        $customer->is_active = $status;
        $customer->save();
        return Redirect::back()->with('success','Customer update successfully');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $customer =  User::find($id);
       $customer->delete();
       return redirect()->route('admin.customers.index')->with('success', 'Customer Delete successfully');
    }
}
