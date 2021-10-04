<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all=Image::all();
        $cols=['校園映像圖片','顯示','刪除','編輯'];
        $rows=[];
        foreach ($all as $a) {
            $tmp=[
                [
                    'tag'=>'img',
                    'src'=>$a->img,
                    'style'=>'width:100px;height:68px'
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

        $this->view['header']="校園映像圖片管理";
        $this->view['modal']='Image';
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
            'action'=>'/admin/image',
            'modalHeader'=>'新增校園映像圖片',
            'modalBody'=>[
                [
                    'label'=>'校園映像圖片',
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
            $image=new Image;
            $image->img=$fileName;
            $image->save();
        }

        return redirect('/admin/image');
    }

    public function edit($id)
    {
        $image=Image::find($id);
        
        $view=[
            'action'=>'/admin/image/'.$id,
            'modalHeader'=>'編輯校園映像',
            'method'=>'patch',
            'modalBody'=>[
                [
                    'label'=>'目前圖片',
                    'tag'=>'img',
                    'src'=>$image->img,
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
        $image=Image::find($id);
        if($request->hasFile('img') && $request->file('img')->isValid()){
            $fileName=$request->file('img')->getClientOriginalName();
            $request->file('img')->storeAs('public',$fileName);
            $image->img=$fileName;
        }

        $image->save();
        return redirect('/admin/image');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Image::destroy($id);
    }

    public function display($id)
    {
        $image=Image::find($id);
        
        if($image->sh == 1){
            $image->sh=0;
        }else{
            $image->sh=1;
        }
        $image->save();
    }
}
