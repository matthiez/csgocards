<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function val(Request $request, $rules = []) {
        $validator = \Validator::make($request->all(), $rules);
        return $validator->fails() ? $validator->getMessageBag() : null;
    }

    protected function build($data, $success = false) {
        $success = false;
        if(typeOf($data) === 'String') $success = (bool)$success;
        return [
            'success' => (bool)$success
        ];
    }
}
