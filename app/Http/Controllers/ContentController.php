<?php

namespace App\Http\Controllers;

use App\Models\RelationChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;
use RealRashid\SweetAlert\Facades\Alert;

class ContentController extends Controller
{
    public function showUser(Request $request)
    {
        $idUser = $request->attributes->get('id');

        $username = $request->attributes->get('name');

        $query = 'SELECT u.id AS id, 
        u.email,
        u.name,
        CASE WHEN r.uuid IS NOT NULL THEN true ELSE false END AS friend,
        u.online
        FROM tableusers u 
        LEFT JOIN relationchats r ON (u.id = r.userA AND r.userB = ?) OR (u.id = r.userB AND r.userA = ?)
        WHERE u.id != ?';

        $nameInput = $request->get('searchname');

        if ($nameInput !== null) {
            $query .= " AND LOWER(u.name) LIKE LOWER(?)"; 
    
            $searchPattern = strtolower($nameInput) . '%'; 
    
            $result = DB::select($query, [$idUser, $idUser, $idUser, $searchPattern]);
        } else {
            $result = DB::select($query, [$idUser, $idUser, $idUser]);
        }
        
        return view('contents.tableuser', ['userDatas' => $result, 'username' => $username, 'idUser' => $idUser]);
    }

    public function deleteUser(Request $request, AuthController $authservice)
    {

        $idUser = $request->attributes->get('id');

        $queryDelete = 'DELETE FROM relationchats
        WHERE userA = ? OR userB = ?';

        DB::delete($queryDelete, [$idUser, $idUser]);

        DB::table('tableusers')->where('id', $idUser)->delete();

        alert::success("SUCCESS", "DELETE USER");

        $authservice->logout($request);

        return redirect(route('auth.login'));
    }


    public function EditUserForm(Request $request)
    {
        $username = $request->attributes->get('name');

        $idUser = $request->attributes->get('id');

        $query = 'SELECT u.name, u.id FROM tableusers u WHERE u.id = :id';

        $result = DB::select($query, ['id' => $idUser]);

        return view('auths.editform', ['user_data' => $result, 'username' => $username, 'idUser' => $idUser]);
    }

    public function EditUser(Request $request)
    {
        $data_input = $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        Log::alert($data_input);

        $idRoutes = $request->route('id');

        $query = 'SELECT u.password FROM tableusers u WHERE u.id = :id';

        $result = DB::select($query, ['id' => $idRoutes]);

        $verifypass = password_verify($data_input['password'], $result[0]->password);

        if (!$verifypass) {
            Alert::error('ERROR', 'incorrect password');
            return back();
        }

        DB::table('tableusers')->where('id', $idRoutes)->update(["name" => $data_input['name']]);

        alert::success("success", "EDIT NAME");

        return redirect(route('content.showUser'));
    }

    public function addUserAsFriend(Request $request)
    {

        $idRoutes = $request->route('id');

        $idUser = $request->attributes->get('id');

        $data_input = [
            'userA' => (int)$idUser,
            'userB' => (int)$idRoutes,
            'uuid' => Uuid::uuid4()
        ];

        Log::alert($data_input);

        RelationChat::create($data_input);

        return redirect(route('content.showUser'));
    }
}
