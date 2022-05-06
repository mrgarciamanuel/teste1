<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delivery;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth;
use App\Models\Product;

class DeliveryController extends Controller
{
    
    //funcção que permite aceder aos dados de envio
    public function delivery(){
        return view ('delivery');
    }


    //função que permite adicionar dados do pedido
    public function addDeliveryInfo(Request $pedido){
        //instanciação do objeto Delivery através do Model Delivery que foi chamado em cima
        $delivery = new Delivery;

        //atributos do objeto criado
        $delivery->name = $pedido->name;
        $delivery->sobrenome = $pedido->sobrenome;
        $delivery->order_id = $pedido->order_id;
        $delivery->address = $pedido->address;
        $delivery->post_code = $pedido->post_code;
        $delivery->region = $pedido->regions;
        $delivery->email = $pedido->email;
        $delivery->phome = $pedido->phone;
        $delivery->observacoes = $pedido->observacoes;

        //salvando os dados na base de dados, todo objeto criado em laravel, por omissão tem um metodo save()
        $delivery->save();

        return redirect ('/'); 
    }

    public function showDelivers(){

   
        $user = auth()->user();//verificar autentificação do utilizador
        $userId = $user->id;//variavel userId recebe o identificador do
        $delivers = DB::table('delivers')
        ->join('orders','delivers.order_id','=','orders.id')
        ->where('orders.user_id', $userId);
        
       /* $orders = DB::table('orders')
        ->join('products','orders.product_id','=','products.id')
        ->where('orders.user_id',$userId)
        ->get();*/

        return view ('delivers',['delivers'=>$delivers]);
        //return view($delivers);    
    }
}
