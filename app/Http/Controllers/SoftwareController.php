<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSoftwareRequest;
use App\Http\Requests\UpdateSoftwareRequest;
use Illuminate\Http\Request;
use App\Models\Software;
use App\Services\SoftwareService;
use Illuminate\Support\Facades\Auth;
class SoftwareController extends Controller
{

    /**
     * @var softwareService
     */
    protected $softwareService;

    public function __construct(SoftwareService $softwareService) //dependency injection
    {
        $this->softwareService = $softwareService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $softwares = $this->softwareService->getSoftware($request->all());

        return view('Softwares.software',[
            'softwares' => $softwares,

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
        $data = $request->only([
            'title',
            'description',
            'link',
            'licence',
        ]);
        $software = $this->softwareService->saveSoftwareData($data);

        return redirect('/software')->with('success', 'Software saved.');

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(UpdateSoftwareRequest $request, $id)
    {
        $data = $request->only([
            'title',
            'description',
            'link',
            'licence',
        ]);

        $software = $this->softwareService->updateSoftwareData($data, $id);
        return redirect('/user-software')->with('success', 'Software updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $software = $this->softwareService->deleteById($id);
        return redirect('/user-software')->with('success', 'Software removed.');
    }
}
