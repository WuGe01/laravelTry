<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Title;

class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all=Title::all();
        $cols=['網頁標題','替代文字','顯示','刪除','編輯'];
        $rows=[];
        foreach ($all as $a) {
            $tmp=[
                [
                    'tag'=>'img',
                    'src'=>$a->img,
                    'style'=>'width:300px;height:30px'
                ],
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
    
        $this->view['header']="標題圖管理";
        $this->view['modal']='Title';
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
            'action'=>'/admin/title',
            'modalHeader'=>'新增標題圖文',
            'modalBody'=>[
                [
                    'label'=>'標題區圖片',
                    'tag'=>'input',
                    'type'=>'file',
                    'name'=>'img'
                ],
                [
                    'label'=>'標題區替代文字',
                    'tag'=>'input',
                    'type'=>'text',
                    'name'=>'text'
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
        if($request->hasFile('img') && $request->file('img')->isValid()){
            $fileName=$request->file('img')->getClientOriginalName();
            $request->file('img')->storeAs('public',$fileName);
            $text=$request->input('text');

            $title=new Title;
            $title->img=$fileName;
            $title->text=$text;
            $title->save();
        }

        return redirect('/admin/title');
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
        $title=Title::find($id);
        
        $view=[
            'action'=>'/admin/title/'.$id,
            'modalHeader'=>'編輯標題資料',
            'method'=>'patch',
            'modalBody'=>[
                [
                    'label'=>'',
                    'tag'=>'img',
                    'src'=>$title->img,
                    'style'=>'width:300px;height:30px;'
                ],
                [
                    'label'=>'標題區圖片',
                    'tag'=>'input',
                    'type'=>'file',
                    'name'=>'img'
                ],
                [
                    'label'=>'標題區替代文字',
                    'tag'=>'input',
                    'type'=>'text',
                    'name'=>'text',
                    'value'=>$title->text
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
        $title=Title::find($id);
        if($request->hasFile('img') && $request->file('img')->isValid()){
            $fileName=$request->file('img')->getClientOriginalName();
            $request->file('img')->storeAs('public',$fileName);
            $title->img=$fileName;
        }

        if($title->text != $request->input('text')){
            $title->text=$request->input('text'); 
        }
        $title->save();
        return redirect('/admin/title');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Title::destroy($id);
    }

    public function display($id)
    {
        $title=Title::find($id);
        
        if($title->sh == 1){
            $title->sh=0;
            $findTitle=Title::where('sh',0)->first();
            $findTitle->sh=1;
            $findTitle->save();
        }else{
            $title->sh=1;
            $findTitle=Title::where('sh',1)->first();
            $findTitle->sh=0;
            $findTitle->save();
        }
        $title->save();
    }
}
