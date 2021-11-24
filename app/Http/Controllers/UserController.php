<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Models\History;

use App\Models\Division;
use App\Models\Note_Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;

class UserController extends Controller
{
    public function index()
    {
        return view('user', [
            'users' => User::where('is_admin', false)->latest()->get(),
            'title' => 'Daftar User',
            'nav' => 'users',
        ]);
    }

    public function show(User $user)
    {
        // dd($user->note->pluck('id')->toArray());
        return view('singleuser', [
            'user' => $user,
            'notes' => $user->note,
            'readHistories' => History::where('user_id', $user->id)->where('status', 'telah membaca')->get(),
            'downloadHistories' => History::where('user_id', $user->id)->where('status', 'telah mendownload')->get(),
            'imageUpload' => Note_Image::whereIn('note_id', $user->note->pluck('id')->toArray())->get(),
            'title' => 'User',
            'nav' => 'users',
        ]);
    }

    public function formCreate()
    {
        return view('user.formcreate', [
            'title' => 'Buat User',
            'divisions' => Division::all(),
            'active' => 'users',
            'nav' => 'users',
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
            'password' => 'required|min:1|max:255|confirmed',
            'bidang' => '',
            'jabatan' => 'required',
            'level' => '',
        ]);

    //   User::create($validatedData);
        
        $validatedData['password'] = bcrypt($validatedData['password']);

        // User::create([
        //     'name' => $validatedData[('name')],
        //     'email' => $validatedData[('email')],
        //     'password' => $validatedData[('password')],
        //     'slug' => Str::random(20),
        // ]);

        $div = 1;

        $user = new User([
            'name' => $validatedData[('name')],
            'jabatan' => $validatedData[('jabatan')],
            'email' => $validatedData[('email')],
            'password' => $validatedData[('password')],
            'authorization_level' => (int)$validatedData[('level')],
            'division_id' => (int) $validatedData[('bidang')],
            'slug' => Str::random(20),
        ]);
        // dd($user->division_id);
        $user->save();

        $history = new History([
            'user_id' => $user->id,
            'status' => 'telah dibuat'
        ]);
        $history->save();

        $request->session()->flash('success', 'Berhasil menambahkan User');
        // return redirect('/users');
        return redirect()->action([UserController::class, 'index']);
    }

    public function edit(User $user)
    {
        // dd($user->id);
        return view('user.formedit', [
            'divisions' => Division::all(),
            'user' => $user,
            'title' => 'Edit User',
            'nav' => 'users',
        ]);
    }

    public function update(User $user, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
            'bidang' => '',
            'level' => '',
        ]);

        $user->name = $validatedData[('name')];
        $user->email = $validatedData[('email')];
        $user->division_id = $validatedData[('bidang')];
        $user->authorization_level = $validatedData[('level')];
        if ($request->password) {
            $validatedData = $request->validate([
                'password' => 'min:1|max:255|confirmed'
            ]);
            $validatedData['password'] = bcrypt($validatedData['password']);
            $user->password = $validatedData[('password')];
        }

        $user->save();

        $request->session()->flash('success', 'Berhasil mengubah Data User');

        return redirect()->action([UserController::class, 'index']);
    }

    public function delete(User $user)
    {
        // dd($user->id);
        $user->delete();

        return redirect()->action([UserController::class, 'index'])->with('success', 'User telah terhapus');
    }

    public function editPassword()
    {
        return view('user.form_edit_password', [
            'title' => 'Ubah Password',
            'nav' => 'users',
        ]);
    }
    
    public function updatePassword(User $user, Request $request)
    {
        // dd($user);
        $validatedData = $request->validate([
            'password' => 'required|min:1|max:255|confirmed'
        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);


        $user->password = $validatedData[('password')];
        $user->save();

        $request->session()->flash('success', 'Berhasil mengubah password');

        return redirect()->action([NoteController::class, 'listMyNote']);
    }

    public function editUserData()
    {
        return view('user.form_edit_user', [
            'title' => 'Ubah Data',
            'nav' => 'users',
        ]);
    }

    public function updateUserData(User $user, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
        ]);

        $user->name = $validatedData[('name')];
        $user->email = $validatedData[('email')];

        $user->save();

        $request->session()->flash('success', 'Berhasil mengubah Data Diri');

        return redirect()->action([NoteController::class, 'listMyNote']);
    }

}
