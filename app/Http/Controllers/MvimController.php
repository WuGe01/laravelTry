<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mvim;

class MvimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all=Mvim::all();
        $cols=['動畫圖片圖片','顯示','刪除','編輯'];
        $rows=[];
        foreach ($all as $a) {
            $tmp=[
                [
                    'tag'=>'img',
                    'src'=>$a->img,
                    'style'=>'width:100px;height:100px'
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

        $this->view['header']="動畫圖片管理";
        $this->view['modal']='Mvim';
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
            'action'=>'/admin/mvim',
            'modalHeader'=>'新增動畫圖片',
            'modalBody'=>[
                [
                    'label'=>'動畫圖片',
                    'tag'=>'input',
                    'type'=>'file',
                    'name'=>'img'
                ]
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
        if($request->hasFile('img') && $request->file('img')->isValid()){
            $fileName=$request->file('img')->getClientOriginalName();
            $request->file('img')->storeAs('public',$fileName);
            $mvim=new Mvim;
            $mvim->img=$fileName;
            $mvim->save();
        }

        return redirect('/admin/mvim');
    }

    public function edit($id)
    {
        $mvim=Mvim::find($id);
        
        $view=[
            'action'=>'/admin/mvim/'.$id,
            'modalHeader'=>'編輯動畫圖片',
            'method'=>'patch',
            'modalBody'=>[
                [
                    'label'=>'目前圖片',
                    'tag'=>'img',
                    'src'=>$mvim->img,
                    'style'=>'width:100px;height:68px;'
                ],
                [
                    'label'=>'變更圖片',
                    'tag'=>'input',
                    'type'=>'file',
                    'name'=>'img'
                ]
            ],
        ];
        return view('modals.modal',$view);
    }


    public function update(Request $request, $id)
    {
        $mvim=Mvim::find($id);
        if($request->hasFile('img') && $request->file('img')->isValid()){
            $fileName=$request->file('img')->getClientOriginalName();
            $request->file('img')->storeAs('public',$fileName);
            $mvim->img=$fileName;
        }

        $mvim->save();
        return redirect('/admin/mvim');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Mvim::destroy($id);
    }

    public function display($id)
    {
        $mvim=Mvim::find($id);
        
        if($mvim->sh == 1){
            $mvim->sh=0;
        }else{
            $mvim->sh=1;
        }
        $mvim->save();
    }
}
