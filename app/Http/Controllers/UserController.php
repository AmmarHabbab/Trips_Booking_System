<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('dashboard.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required'
        ]);

        $user->role = $request->role;
        $user->save();

        return redirect('/dashboard/users/all');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }

    public function allusersdatatables(Request $request)
    {
        return view('dashboard.users.all'); 
    }
    public function getusersdatatables(Request $request)
    {
        $users = User::all();
        return Datatables::of($users)
        ->addIndexColumn()
        ->addColumn('action',function($row){
            return $btn = '
            <form action="'.Route('dashboard.users.destroy',$row->id).'" method="POST">
            <button><a href="'.Route('dashboard.users.edit',$row->id).'">Change User Role</a></button>
            <button type="submit">Delete User</button>
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            </form>';
        })
        ->rawColumns(['name','email','role','trips_attended','action']) //,'action'
        ->make(true);
    }
}
