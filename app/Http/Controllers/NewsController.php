<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all=News::all();
        $cols=['最新消息','顯示','刪除','編輯'];
        $rows=[];
        foreach ($all as $a) {
            $tmp=[
                [
                    'tag'=>'textarea',
                    'value'=>$a->text,
                    'style'=>'width: 100%;',
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
        $this->view['header']="最新消息管理";
        $this->view['modal']='News';
        $this->view['cols']=$cols;
        $this->view['rows']=$rows;

        return view('backed.module',$this->view);
        //
    }

    public function create()
    {
        $view=[
            'action'=>'/admin/news',
            'modalHeader'=>'新增最新消息',
            'modalBody'=>[
                [
                    'label'=>'最新消息內容',
                    'tag'=>'textarea',
                    'style'=>'width: 100%;',
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
        $news=new News;
        $news->text=$request->input('text');
        $news->save();

        return redirect('/admin/news');
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
        $news=News::find($id);
        
        $view=[
            'action'=>'/admin/news/'.$id,
            'modalHeader'=>'編輯最新消息',
            'method'=>'patch',
            'modalBody'=>[
                [
                    'label'=>'最新消息內容',
                    'tag'=>'textarea',
                    'style'=>'width: 100%;',
                    'name'=>'text',
                    'value'=>$news->text
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
        $news=News::find($id);
        if($news->text != $request->input('text')){
            $news->text=$request->input('text'); 
        }
        $news->save();
        return redirect('/admin/news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        News::destroy($id);
    }

    public function display($id)
    {
        $news=News::find($id);
        
        if($news->sh == 1){
            $news->sh=0;

        }else{
            $news->sh=1;

        }
        $news->save();
    }
}
