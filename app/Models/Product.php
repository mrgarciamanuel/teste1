<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','price','category','description', 'image', 'category_id'];

    //relação entre as tabelas categorias e produtos
    //a relação é possível gração ao model da tabela categorias que foi importado em cima
    public function category(){
        //return $this->belongsTo('App\Models\Category');
        return $this->belongsTo(Category::class);
    }

    /*public function user(){
        return $this->belongsTo('App\Models\User');
    }*/
}
