<?php

namespace App\Http\Controllers;

use App\Events\MessageCreated;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class PusherController extends Controller
{
    public function index(Request $request)
    {
        $idUser = $request->attributes->get('id');

        $idRoutes = $request->route('id');

        Log::alert($idRoutes);

        Log::alert($idUser);

        if ((string)$idRoutes === (string)$idUser) {
            Alert::error('ERROR', "you can't chat yourself");
            return redirect('content.showUser');
        }

        $query = 'SELECT * FROM `relationchats` rc
        where (rc.userA = ? and rc.userB = ?) or (rc.userA = ? and rc.userB = ?)';

        $result = DB::select($query, [(int)$idUser, (int)$idRoutes, (int)$idRoutes, (int)$idUser]);

        $uidchat = $result[0]->uuid;

        Log::alert($result);

        $username = $request->attributes->get('name');

        $query = 'SELECT u.name FROM tableusers u WHERE u.id = :id';

        $result = DB::select($query, ['id' => $idRoutes]);

        $receiver = $result[0]->name;

        return view('pushers.index', [
            'sender' => $username,
            'receiver' => $receiver,
            'messageInput' => "pesan masuk",
            'messageOutput' => "pesan balasan",
            'idReceiver' =>  $idRoutes,
            'idUser' => $idUser,
            'uidchat' =>$uidchat
        ]);
    }

    public function broadcast(Request $request)
    {
        $sender = $request->attributes->get('name');

        $receiverUserId = $request->get('user_chat'); // Assuming you have a 'receiver_user_id' in your request

        broadcast(new MessageCreated($request->get('message'), $receiverUserId))->toOthers();

        return view('pushers.broadcast', ['message' => $request->get('message'), 'sender' => $sender]);
    }

    public function receive(Request $request)
    {
        $idRoutes = $request->route('id');

        $query = 'SELECT u.name FROM tableusers u WHERE u.id = :id';

        $result = DB::select($query, ['id' => $idRoutes]);

        $receiver = $result[0]->name;

        return view('pushers.receive', ['message' => $request->get('message'), 'receiver' => $receiver]);
    }
}
