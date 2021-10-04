<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubMenu;

class SubMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($menu_id)
    {
        $all=SubMenu::where('menu_id',$menu_id)->get();
        $cols=['次選單名稱','次選單連結','刪除','編輯'];
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

        $this->view['header']="次選單管理";
        $this->view['modal']='SubMenu';
        $this->view['cols']=$cols;
        $this->view['rows']=$rows;
        $this->view['menu_id']=$menu_id;


        return view('backed.module',$this->view);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($menu_id)
    {
        $view=[
            'action'=>'/admin/submenu/'.$menu_id,
            'modalHeader'=>'新增次選單',
            'modalBody'=>[
                [
                    'label'=>'次選單名稱',
                    'tag'=>'input',
                    'type'=>'text',
                    'name'=>'text',
                    'value'=>'',
                ],
                [
                    'label'=>'次選單連結',
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
    public function store(Request $request ,$menu_id)
    {
        $submenu=new SubMenu;
        $submenu->text=$request->input('text');
        $submenu->href=$request->input('href');
        $submenu->menu_id=$menu_id;
        $submenu->save();


        return redirect('/admin/submenu/'.$menu_id);
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
        $submenu=SubMenu::find($id);

        $view=[
            'action'=>'/admin/submenu/'.$id,
            'modalHeader'=>'編輯主選單',
            'method'=>'patch',
            'modalBody'=>[
                [
                    'label'=>'主選單名稱',
                    'tag'=>'input',
                    'type'=>'text',
                    'name'=>'text',
                    'value'=>$submenu->text
                ],
                [
                    'label'=>'主選單連結',
                    'tag'=>'input',
                    'type'=>'text',
                    'name'=>'href',
                    'value'=>$submenu->href
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
        $submenu=SubMenu::find($id);
        if($submenu->text != $request->input('text')){
            $submenu->text=$request->input('text'); 
        }
        if($submenu->href != $request->input('href')){
            $submenu->href=$request->input('href'); 
        }
        $submenu->save();
        return redirect('/admin/submenu/'.$submenu->menu_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SubMenu::destroy($id);
    }

}
