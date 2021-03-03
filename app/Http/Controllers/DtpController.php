<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pengalaman;
use App\Models\Pendidikan;

class DtpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = User::latest()->paginate(5);

        return view('calon.index',compact('posts'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('calon.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required',
            'address'    => 'required',
            'ktp'        => 'required',
        ]);
        
        $users = User::create($request->all());
        foreach ($request->Perusahaan as $item => $v) {
            $data2 = array( 
                'user_id'    =>$users->id,
                'pt'         =>$request->Perusahaan[$item],
                'jabatan'    =>$request->Jabatan[$item],
                'tahun'      =>$request->Tahun[$item],
                'keterangan' => $request->Keterangan[$item],
            );
            Pengalaman::insert($data2);   
        }

        foreach ($request->Sekolah as $item => $v) {
            $data1 = array( 
                'user_id' =>$users->id,
                'nama'    =>$request->Sekolah[$item],
                'jurusan' =>$request->Jurusan[$item],
                'masuk'   =>$request->Masuk[$item],
                'lulus'   => $request->Lulus[$item],
            );
            Pendidikan::insert($data1);   
        }

        
        return redirect()->route('dtp.index')
        ->with('success','Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = User::find($id);
        return view('calon.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('dtf.modif',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        
        $post->update($request->all());
        
        return redirect()->route('calon.index')
        ->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = User::find($id);
        $post->delete();

        return redirect()->route('dtp.index')
        ->with('success','Post deleted successfully');
    }
}
