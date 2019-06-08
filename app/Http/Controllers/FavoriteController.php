<?php

namespace App\Http\Controllers;

use App\Reply;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Reply $reply, Request $request)
    {
        try {
            $reply->favorite();
        } catch (\Exception $e) {
            $this->fail('dont work');
        }

        return response(['status' => true]);
    }

    public function destroy(Reply $reply)
    {
        try {
            $reply->unfavorite();
        } catch (\Exception $e) {
            $this->fail('dont work');
        }

        return response(['status' => true]);
    }
}
