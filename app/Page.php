<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    protected $table='pages'; // если название модели отличаеться от названия таблицы, так привязываем таблицу к модели
    protected $fillable = ['name','alias','text','images']; // список полей разрешенных для авто заполнения
}
