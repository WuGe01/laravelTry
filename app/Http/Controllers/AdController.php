<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $all=Ad::all();
        $cols=['動態文字廣告','顯示','刪除'];
        $rows=[];
        foreach ($all as $a) {
            $tmp=[
                [
                    'tag'=>'',
                    'text'=>$a->text,
                ],
                [
                    'tag'=>'button',
                    'type'=>'button',
                    'color'=>'btn-success',
                    'action'=>'show',
                    'text'=>($a->sh==1)?"顯示":"隱藏",
                    'id'=>$a->id,
                ],
                [
                    'tag'=>'button',
                    'type'=>'button',
                    'color'=>'btn-danger',
                    'action'=>'delete',
                    'text'=>"刪除",
                    'id'=>$a->id,
                ]
            ];
            $rows[]=$tmp;
        }
        // dd($rows);

        $this->view['header']="動態文字廣告管理";
        $this->view['modal']='Ad';
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
        
        $view=[
            'action'=>'/admin/ad',
            'modalHeader'=>'新增動態廣告文字',
            'modalBody'=>[
                [
                    'label'=>'動態廣告文字',
                    'tag'=>'input',
                    'type'=>'text',
                    'name'=>'text',
                    'value'=>'請輸入文字',
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
        //

            $Ad=new Ad;
            $Ad->text=$request->input('text');
            $Ad->save();


        return redirect('/admin/ad');
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
        $Ad=Ad::find($id);
        
        $view=[
            'action'=>'/admin/ad/'.$id,
            'modalHeader'=>'編輯動態廣告',
            'method'=>'patch',
            'modalBody'=>[
                [
                    'label'=>'動態廣告文字',
                    'tag'=>'input',
                    'type'=>'text',
                    'name'=>'text',
                    'value'=>$Ad->text
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
        $Ad=Ad::find($id);
        if($Ad->text != $request->input('text')){
            $Ad->text=$request->input('text'); 
            $Ad->save();
        }
        return redirect('/admin/ad');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ad::destroy($id);
    }

    public function display($id)
    {
        $Ad=Ad::find($id);
       
        if($Ad->sh == 1){
            $Ad->sh=0;
        }else{
            $Ad->sh=1;
        }
        $Ad->save();
    }
}
