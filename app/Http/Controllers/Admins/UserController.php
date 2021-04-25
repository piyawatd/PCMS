<?php
/**
 * Created by IntelliJ IDEA.
 * User: piyawat
 * Date: 21/6/2020 AD
 * Time: 19:04
 */

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller; //เรียกใช้ Controller หลักของ Laravel 5.0
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('Admins.user.index', ['navsel' => 'user']);
    }

    public function new()
    {
        $user = new User();
        $user->role = 'staff';
        return view('Admins.user.form', ['navsel' => 'user', 'mode' => 'new', 'user' => $user]);
    }

    public function edit($id)
    {
        return view('Admins.user.form', ['navsel' => 'user', 'mode' => 'edit', 'user' => User::find($id)]);
    }

    public function profile()
    {
        return view('Admins.user.profile', ['navsel' => 'profile', 'user' => User::find(Auth::id())]);
    }

    public function create(Request $request)
    {
        $user = new User();
        $this->updateDatabase($user, $request);
        return redirect()->route('userindex')->with('success', 'user saved!');
    }

    public function checkUsername(Request $request)
    {
        $check = User::where('username', $request->input('username'))->count();
        $result['result'] = false;
        if ($check > 0) {
            $result['result'] = true;
        }
        return $result;
    }

    public function update($id, Request $request)
    {
        $user = User::find($id);
        $this->updateDatabase($user, $request);
        return redirect()->route('userindex')->with('success', 'user updated!');
    }

    public function updateprofile(Request $request)
    {
        $user = User::find(Auth::id());
        $this->updateDatabase($user, $request);
        return redirect()->route('userindex')->with('success', 'Profile updated!');
    }

    public function updateDatabase(User $user, Request $request)
    {
        if (!empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->username = $request->input('username');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->save();
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        $result['result'] = true;
        return $result;
    }

    public function list(Request $request)
    {
        // https://shareurcodes.com/blog/laravel%20datatables%20server%20side%20processing
        $columns = array(
            0 => 'username',
            1 => 'name',
            2 => 'email',
        );

        $totalData = User::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $users = User::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $users = User::where('username', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = User::where('username', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->count();
        }

        $data = array();
        if (!empty($users)) {
            foreach ($users as $user) {
                $edit = route('useredit', $user->id);
                $nestedData['username'] = $user->username;
                $nestedData['name'] = $user->name;
                $nestedData['email'] = $user->email;
                $nestedData['role'] = $user->role;
                $nestedData['options'] = "<a href=" . $edit . " title=\"แก้ไข\" class=\"btn btn-info btn-circle\"><i class=\"fas fa-edit\"></i></a>&emsp;<a href=\"javascript:deleteitem('" . $user->id . "','" . $user->username . "');\" title=\"ลบ\" class=\"btn btn-danger btn-circle\"><i class=\"fas fa-trash\"></i></a>";
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);
    }
}
