<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Support\Facades\Validator;
use function foo\func;

class FormValidator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $modelForValidation)
    {


        $model = app($modelForValidation);
        $validate = Validator::make($request->all(), $model->rules());

        if ($validate->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validate->errors());
        }

        return $next($request);
    }
}
