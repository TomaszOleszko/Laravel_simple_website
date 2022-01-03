<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Software;
use Illuminate\Support\Facades\Auth;
class SoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $softwares = Software::paginate(10);
        return view('Softwares.software',[
            'softwares' => $softwares,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Softwares.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $icons = ['fas fa-file-archive', 'far fa-file-archive', 'fas fa-file', 'far fa-file'];

        $software = new Software();
        $software->user_id = auth()->user()->id;
        $software->title = $data['title'];
        $software->description = $data['description'];
        $software->link = $data['link'];
        $software->icon = $icons[array_rand($icons,1)];
        $software->licence = $data['licence'];
        if($software->save()){
            return redirect('/software')->with('success', 'Software saved.');
        }
        return view('/software');
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
        $software = Software::find($id);
        if($software == null || Auth::user()->id != $software->user_id){
            return back()->with(['success' => false, 'message_type' => 'danger']);
        }
        return view('Softwares.edit',['software'=>$software]);
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
        $deletedSoftware = Software::find($id);
        $deletedSoftware->delete();
        return redirect('/software')->with('success', 'Software removed.');
    }
}