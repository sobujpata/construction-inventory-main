<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    function MessageSend(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'mobile' => 'required|numeric|digits:11',
            'email' => 'required|email',
            'message' => 'required|string|min:3',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $message = Message::create([
            'name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
            'email' => $request->input('email'),
            'discription' => $request->input('message'), // Correct field name
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully!',
            'data' => $message
        ]);
    }

}
