<?php

namespace App\Http\Traits;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;


trait HasResponses
{
    public function noContent(Request $request, $message = '', $location = '')
    {
        return $this->commonResponse($request, ['message' => $message], $location, 204);
    }

    public function ok(Request $request, $data = [], $location = '')
    {
        return $this->commonResponse($request, $data, $location);
    }

    public function created(Request $request, $data = [], $location = '')
    {
        return $this->commonResponse($request, $data, $location, 201);
    }

    private function commonResponse(Request $request, $data = [], $location = '', $status = 200)
    {
        if($request->ajax()){
            $headers = !empty($location) && !($location instanceof View)? ['Location' => $location]: [];
            return response()->json($data, $status, $headers);
        }

        if(empty($location)){
            return response($data, $status);
        } else {
            if($location instanceof View){
                return $location->with((array) $data);
            }

           return $this->baseRedirect($location, $data, $status);
        }
    }

    private function baseRedirect($location, $data = [], $status)
    {
        $redirect = redirect($location);

        if($status >= 400){
            return $redirect->withErrors($data);
        }

        $message = $this->extractMessage($data);
        if(!empty($message)){
            $redirect->withSuccess($message);
        }
        return $redirect;
    }

    private function extractMessage($data)
    {
        if(is_string($data)){
           return $data;
        }

        return $data['message'] ?? '';
    }
}