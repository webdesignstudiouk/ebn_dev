<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Users as EBNUsers;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Models\User;

class Users extends Controller
{
  protected $users;

  public function __construct()
  {
    $this->users = new EBNUsers;
  }

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $users = $this->users->all();
    return view('users.users')
    ->with('users', $users);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create(FormBuilder $formBuilder)
  {
    $form = $formBuilder->create(\App\Forms\Users\CreateUser::class, [
      'method' => 'POST',
      'url' => route('users.store')
    ], [
      'title' => "Create User"
    ]);

    return view('users.create', compact('form'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(FormBuilder $formBuilder, Request $request)
  {
    $form = $formBuilder->create(\App\Forms\Users\CreateUser::class);

    if (!$form->isValid()) {
      return redirect()->back()->withErrors($form->getErrors())->withInput();
    }

    $user = new EBNUsers;
    $user->first_name = $request->first_name;
    $user->second_name = $request->second_name;
    $user->email = $request->email;

    User::create([
      'first_name' => $request->first_name,
      'second_name' => $request->second_name,
      'email' => $request->email,
      'password' => bcrypt($request->password),
    ]);

    return redirect()->route('users');

  }

  /**
  * Display the specified resource.
  *
  * @param  \App\Users  $users
  * @return \Illuminate\Http\Response
  */
  public function show($user, FormBuilder $formBuilder)
  {
    $user = $this->users->find($user);
    dd($user);

    //return view('users.user', compact('form'))->with('user', $user);
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Users  $users
  * @return \Illuminate\Http\Response
  */
  public function edit($user, FormBuilder $formBuilder)
  {
    $user = $this->users->find($user);

    $updateForm = $formBuilder->create(\App\Forms\Users\UpdateUser::class, [
      'method' => 'POST',
      'url' => url('admin/users/'.$user->id),
      'model' => $user
    ]);

    return view('users.user.update_form')
    ->with('updateForm', $updateForm)
    ->with('user', $user);
  }

  public function delete($user, FormBuilder $formBuilder)
  {
    $user = $this->users->find($user);

    $deleteForm = $formBuilder->create(\App\Forms\Users\DeleteUser::class, [
      'method' => 'POST',
      'url' => url('admin/users/'.$user->id),
      'model' => $user
    ]);

    return view('users.user.delete_form')
    ->with('deleteForm', $deleteForm)
    ->with('user', $user);
  }

  public function prospects($user, FormBuilder $formBuilder)
  {
    $user = $this->users->find($user);

    return view('users.user.prospects')
    ->with('user', $user);
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Users  $user
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request)
  {
    $user = $this->users->find($request->id);
    $user->first_name = $request->first_name;
    $user->second_name = $request->second_name;
    $user->email = $request->email;
    $user->save();

    flash('User Updated', 'success');

    return back();
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\User  $user
  * @return \Illuminate\Http\Response
  */
  public function destroy($user)
  {
    $user = $this->users->find($user);
    $user->delete();

    flash('User Has Been Deleted', 'warning');

    return redirect()->route('users');
  }
}
