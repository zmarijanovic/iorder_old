<?php

class UsersController extends \BaseController {

public function index()
    {
        $users=User::paginate(15);
        return View::make('users.index')->with('users', $users);
    
    }
    
    public function create()
    {
        
        $level=AccessLevel::all()->lists('type','id');
        return View::make('users.create')->with('level',$level);
        
    }
    
    public function show($id)
    {
        
        $user=User::find($id);
        $level=AccessLevel::all()->lists('type','id');
        return View::make('users.show')->with(array('user'=>$user,'level'=>$level));
    
    }
    
    public function edit($id)
    {
        $user=User::find($id);
        return View::make('users.edit')->with('user',$user);
    
    }
    
    public function update($id)
    {
        if(! User::isValid(Input::all()))
        {
            
            return Redirect::back()->withInput()->withErrors(User::$messages);
            
        }
        
        
        $user=User::find($id);
        $user->permissions_fk=Input::get('permissions_fk');
        $user->username=Input::get('username');
        $user->password=Input::get('password');
        $user->email=Input::get('email');
        $user->phone=Input::get('phone');
        $user->mobile=Input::get('mobile');
        $user->fname=Input::get('fname');
        $user->lname=Input::get('lname');
        $user->save();
        
        // redirect
        Session::flash('message', 'Successfully updated user!');        
        return Redirect::to('users');

    }
    
    
    public function store()
    {
        if(! User::isValid(Input::all()))
        {
    
            return Redirect::back()->withInput()->withErrors(User::$messages);
    
        }
    
    
        $user= new User;
        $user->permissions_fk=Input::get('permissions_fk');
        $user->username=Input::get('username');
        $user->password=Input::get('password');
        $user->email=Input::get('email');
        $user->phone=Input::get('phone');
        $user->mobile=Input::get('mobile');
        $user->fname=Input::get('fname');
        $user->lname=Input::get('lname');
        $user->save();
    
        // redirect
        Session::flash('message', 'Successfully created user!');
        return Redirect::to('users');
    
    }
}
