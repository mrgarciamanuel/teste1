<?php

namespace App\Http\Controllers;
use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{

    //função que permite guardar os formulários feitos no site
    public function store(Request $pedido){
        $form = new Form;

        $form->name = $pedido->name;
        $form->sobrenome = $pedido->sobrenome;
        $form->pais = $pedido->pais;
        $form->provincia = $pedido->provincia;
        $form->endereco = $pedido->endereco;
        $form->sms = $pedido->sms;

        $form->save();

        return redirect ('/');
    }
    public function contact(){
        return view ('contact');
    }
}
