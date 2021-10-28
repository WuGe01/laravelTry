<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showLoginForm(){
        return view('login',$this->view);
    }
    
    public function index()
    {

        $all=Admin::all();
        $cols=['帳號','密碼','刪除','編輯'];
        $rows=[];
        foreach ($all as $a) {
            $tmp=[
                [
                    'tag'=>'',
                    'text'=>$a->acc,
                ],
                [
                    'tag'=>'',
                    'text'=>$a->pw,
                ],
                [
                    'tag'=>'button',
                    'type'=>'button',
                    'color'=>'btn-danger',
                    'action'=>'delete',
                    'text'=>"刪除",
                    'id'=>$a->id,
                ],
                [
                    'tag'=>'button',
                    'type'=>'button',
                    'color'=>'btn-info',
                    'action'=>'edit',
                    'text'=>"編輯",
                    'id'=>$a->id,
                ]
            ];
            $rows[]=$tmp;
        }
        // dd($rows);
        $this->view['header']="管理者管理";
        $this->view['modal']='Admin';
        $this->view['cols']=$cols;
        $this->view['rows']=$rows;

        return view('backed.module', $this->view);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $view=[
            'action'=>'/admin/admin',
            'modalHeader'=>'新增管理者',
            'modalBody'=>[
                [
                    'label'=>'新增帳號',
                    'tag'=>'input',
                    'name'=>'acc',
                    'type'=>'text',
                ],
                [
                    'label'=>'新增密碼',
                    'tag'=>'input',
                    'name'=>'pw',
                    'type'=>'text',
                ],
            ],
        ];
        return view('modals.modal',$view);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Admin=new Admin;
        $Admin->acc=$request->input('acc');
        $Admin->pw=$request->input('pw');
        $Admin->save();


        return redirect('/admin/admin');
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
        $Admin=Admin::find($id);
        
        $view=[
            'action'=>'/admin/admin/'.$id,
            'modalHeader'=>'編輯管理帳號',
            'method'=>'patch',
            'modalBody'=>[
                [
                    'label'=>'帳號',
                    'tag'=>'input',
                    'name'=>'acc',
                    'type'=>'text',
                    'value'=>$Admin->acc
                ],
                [
                    'label'=>'密碼',
                    'tag'=>'input',
                    'name'=>'pw',
                    'type'=>'text',
                    'value'=>$Admin->pw
                ],
            ],
        ];
        return view('modals.modal',$view);
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

        $Admin=Admin::find($id);
        if($Admin->acc != $request->input('acc')){
            $Admin->acc=$request->input('acc'); 
        }
        if($Admin->pw != $request->input('pw')){
            $Admin->pw=$request->input('pw'); 
        }
        $Admin->save();
        return redirect('/admin/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::destroy($id);
    }
}
