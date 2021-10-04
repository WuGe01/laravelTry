<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Total;

class TotalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all=Total::first();
        $cols=['進站總人數'];
        $rows=[
            [
                'tag'=>'',
                'text'=>$all->total,
            ],
            [
                'tag'=>'button',
                'type'=>'button',
                'color'=>'btn-info',
                'action'=>'edit',
                'text'=>"編輯",
                'id'=>$all->id,
            ]
        ];
        
        $this->view['header']="進站人數管理";
        $this->view['modal']='Total';
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
        $total=Total::first();
        
        $view=[
            'action'=>'/admin/total/'.$id,
            'modalHeader'=>'編輯進站人數',
            'method'=>'patch',
            'modalBody'=>[
                [
                    'label'=>'進站總人數',
                    'tag'=>'input',
                    'type'=>'number',
                    'name'=>'text',
                    'value'=>$total->total
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
        $total=Total::first();

        if($total->total != $request->input('text')){
            $total->total=$request->input('text'); 
        }
        $total->save();
        return redirect('/admin/total');
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
