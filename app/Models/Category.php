<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    //relação entre as tabelas categorias e produtos
    //a relação é possível graças ao model da tabela Productos que foi importado em cima
    public function products(){
        //return $this->hasMany('App\Models\Product');
        return $this->hasMany(Product::class);
    }
}
