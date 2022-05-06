<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{   
    //função responsável por mostar a rota dashboard
    public function dashboard(){
        $user = auth()->user();
        return view ('dashboard',['user'=>$user]);
    }

    public function edituser(){
        $user = auth()->user();
        return view ('edituser',['user'=>$user]);
    }

    public function udateUser(Request $pedido){
        User::findOrFail($pedido->id)->update($pedido->all());
        return redirect('dashboard');
    }

    /*public function useredit($id){
        //o findOrfail/firstOrFail vai buscar o model indicado, e se não for encontrado tal model, ele me retorna-ra uma exceção
        //outras opções seriam usar o find, first,, firstwhere
        $user = User::findOrFail($id);

    }*/                                                                                               
}
