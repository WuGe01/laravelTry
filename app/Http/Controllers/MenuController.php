<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $all=Menu::all();
        $cols=['主選單名稱','選單連結','次選單數量','顯示','刪除','編輯','次選單管理'];
        $rows=[];
        foreach ($all as $a) {
            $tmp=[
                [
                    'tag'=>'',
                    'text'=>$a->text,
                ],
                [
                    'tag'=>'',
                    'text'=>$a->href,
                ],
                [
                    'tag'=>'',
                    'text'=>$a->subs->count(),
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
                ],
                [
                    'tag'=>'button',
                    'type'=>'button',
                    'color'=>'btn-warning',
                    'action'=>'sub',
                    'text'=>"次選單編輯",
                    'id'=>$a->id,
                ],
            ];
            $rows[]=$tmp;
        }
        // dd($rows);

        $this->view['header']="選單管理";
        $this->view['modal']='Menu';
        $this->view['cols']=$cols;
        $this->view['rows']=$rows;

        return view('backed.module',$this->view);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view=[
            'action'=>'/admin/menu',
            'modalHeader'=>'新增主選單',
            'modalBody'=>[
                [
                    'label'=>'主選單名稱',
                    'tag'=>'input',
                    'type'=>'text',
                    'name'=>'text',
                    'value'=>'',
                ],
                [
                    'label'=>'主選單連結',
                    'tag'=>'input',
                    'type'=>'text',
                    'name'=>'href',
                    'value'=>'',
                ],
            ],
        ];
        return view('modals.modal',$view);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menu=new Menu;
        $menu->text=$request->input('text');
        $menu->href=$request->input('href');
        $menu->save();


        return redirect('/admin/menu');
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
        $menu=Menu::find($id);

        $view=[
            'action'=>'/admin/menu/'.$id,
            'modalHeader'=>'編輯主選單',
            'method'=>'patch',
            'modalBody'=>[
                [
                    'label'=>'主選單名稱',
                    'tag'=>'input',
                    'type'=>'text',
                    'name'=>'text',
                    'value'=>$menu->text
                ],
                [
                    'label'=>'主選單連結',
                    'tag'=>'input',
                    'type'=>'text',
                    'name'=>'href',
                    'value'=>$menu->href
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
        $menu=Menu::find($id);
        if($menu->text != $request->input('text')){
            $menu->text=$request->input('text'); 
        }
        if($menu->href != $request->input('href')){
            $menu->href=$request->input('href'); 
        }
        $menu->save();
        return redirect('/admin/menu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Menu::destroy($id);
    }

    public function display($id)
    {
        $menu=Menu::find($id);
       
        if($menu->sh == 1){
            $menu->sh=0;
        }else{
            $menu->sh=1;
        }
        $menu->save();
    }
}
