<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bottom;

class BottomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
 
        $bottom=Bottom::first();
        $cols=['頁尾版權文字'];
        $rows=[
            [
                'tag'=>'',
                'text'=>$bottom->bottom,
            ],
            [
                'tag'=>'button',
                'type'=>'button',
                'color'=>'btn-info',
                'action'=>'edit',
                'text'=>"編輯",
                'id'=>$bottom->id,
            ]
        ];
        
        $this->view['header']="頁尾版權管理";
        $this->view['modal']='Bottom';
        $this->view['cols']=$cols;
        $this->view['rows']=$rows;

 
        return view('backed.module',$this->view);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        //
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
        $bottom=Bottom::first();
        
        $view=[
            'action'=>'/admin/bottom/'.$id,
            'modalHeader'=>'編輯頁尾版權',
            'method'=>'patch',
            'modalBody'=>[
                [
                    'label'=>'頁尾版權文字',
                    'tag'=>'input',
                    'type'=>'text',
                    'name'=>'text',
                    'value'=>$bottom->bottom
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
        $bottom=Bottom::first();

        if($bottom->bottom != $request->input('text')){
            $bottom->bottom=$request->input('text'); 
        }
        $bottom->save();
        return redirect('/admin/bottom');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
