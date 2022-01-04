<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSoftwareRequest;
use App\Http\Requests\UpdateSoftwareRequest;
use Illuminate\Http\Request;
use App\Models\Software;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class SoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $filter = null;
        //jeśli jest wybrana jakaś licencja   /software?licences

        if(!empty($data['licences']))
        {
            $softwares = Software::where('licence', '=', $data['licences'])->paginate(10);
            Session::put('softwareFilter', $data['licences']);
            $filter = Session::get('softwareFilter');
            // session(['softwareFilter' => $data['licences']]);
        }
        //jeśli wyczyszczono filtr  /software/get?delete-filter
        else if(!empty($data['clicked']) && $data['clicked']=='delete-filter')
        {
            Session::forget('softwareFilter');
            $filter = null;
            $softwares = Software::paginate(10);
        }
        //   /software
        else
        {
            if(Session::get('softwareFilter'))
            {
                $softwares = Software::where('licence', '=', Session::get('softwareFilter'))->paginate(10);
            }
            else{
                $softwares = Software::paginate(10);
            }
        }

        return view('Softwares.software',[
            'softwares' => $softwares,
            'filter' => $filter,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('Softwares.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(StoreSoftwareRequest $request)
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(Software $software)
    {
        return view('Softwares.edit',['software'=>$software]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSoftwareRequest $request, Software $software)
    {
        $data = $request->all();
        $software->update($data);
        return redirect('/user-software')->with('success', 'Software updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Software $software)
    {
        $software->delete();
        return redirect('/user-software')->with('success', 'Software removed.');
    }

    public function filterSoftware(Request $request)
    {
        dd($request);
    }
}
