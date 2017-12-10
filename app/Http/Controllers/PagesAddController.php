<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Validator;

class PagesAddController extends Controller
{
    public function execute(Request $request) {

        if ($request->isMethod('post')){ // если существует метод post
            $input = $request->except('_token'); // в перемеменную записываем данные их обьекта $request кроме except поля _token (служебное поле laravel)

            //создаем паравила валидации
            $validator = Validator::make($input,[
                    'name' => 'required|max:255', /* поле обязательно для заполнения, длинна не больее 255*/
                    'alias' => 'required|unique:pages|max:255',// unique уникальный в таблице pages
                    'text' => 'required',
                ]);
            if($validator->fails()){ // если валидация прошла с ошибкой
                return redirect()->route('pagesAdd')->withErrors($validator)->withInput(); // перенаправляем на страницу pagesAdd
                //записываем данные  валидации в сессию withErrors, withInput - сохраняем заполненными правильные поля
            }

            if($request->hasFile('images')){ // есть ли файл
                $file = $request->file('images'); // сохраняем в переменную информацию о загружаемом
                $input['images'] = $file->getClientOriginalName();// записываем в массив в поле images его реальное имя
                $file->move(public_path().'/assets/img',$input['images']); // сохраняем файл move в деректорию на сервере public_path().'/assets/img- путь к папке public далее /assets/img
            }

            $page = new Page();
            $page->fill($input);
            if($page->save()){
                return redirect('admin')->with('status','Страница добавлена');
            }

        }

        if(view()->exists('admin.pages_add')){

            $data = [
                'title' =>'Новая страница',
            ];
            return view('admin.pages_add',$data);

        }
        abort(404);

    }
}
