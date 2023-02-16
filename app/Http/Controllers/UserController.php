<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\UserModel;


class UserController extends Controller {

    public function loginForm() {
        if ($this->isValid()) {
			return redirect('/home');
		}
        return view('login');
    }

    public function validar(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'pass' => 'required',
        ],[
            'email.required' => 'Por favor completa este campo',
            'pass.required' => 'Por favor completa este campo',
        ]);

        if ($validator->fails()) {
            return redirect('/login')
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = array(
            "usr_email" => $request->get('email'),
            "usr_pass"  => $request->get('pass')
        );

        $user = UserModel::login($data);

        
        if($user->exists()) {
            session()->put('usr_active', $user->usr_active);
            session()->put('usr_id', $user->usr_id);
            session()->put('usr_name', $user->usr_name);
            session()->put('usr_email', $user->usr_email);
            //actualizamos a sesion iniciada
            UserModel::updateUser(['usr_active' => '1'], $user->usr_id);
            return redirect('/home/')->with('success', 'Bienvenido ' . session()->get('usr_name'));
        } else {
            return redirect('/login')->with('message', 'Error: Usuario y contraseña erroneos.');
        }
    }

    public function logout() {

        UserModel::updateUser(['usr_active' => '0'], session()->get('usr_id'));

        session()->forget('usr_type');
        session()->forget('usr_id');
        session()->forget('usr_name');
        session()->forget('usr_email');
        session()->flush();
        return redirect('/login');
    }

    public function isValid() {

        if( session()->get('usr_active') == "1" ) {
            return true;
        } else {
            return false;
        }
    }
}