<?php

namespace App\Http\Controllers;

use App\Models\user_sombies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserSombiesController extends Controller
{

    public function index()
    {
        $user = user_sombies::all();//el numero de filas
        return view('UserZombie.viewZombie', compact("user"));
    }


    public function createZom()
    {
        return view('UserZombie.formZombie');
    }

    //Esta funcion esta utilizandose tanto en la web como en la api
    public function saveZom(Request $request)
    {
            $media = request()->except('_token');

            $user = $this->validate($request, [
                "name" => "required",
                "email" => "required|string|email",
                "password" => "required",

            ]);

            //Guardar la foto
            if ($request->hasFile('image')) {
                $media['image'] = $request->file("image")->store('uploads', 'public');
            }

            user_sombies::create([
                "name" => $user["name"],
                "points" => 0, //se inicializa con 0 el conteo
                "email" => $user["email"],
                "password" => $user["password"],
                "dateZ" => now(), //para la fecha
                "image"   => $media["image"],
            ]);

        if ($request->control=='api'){
            return response()->json([
                'Guardado exitosamente',
            ]);
        }else{
            return redirect('/home')->with('usuarioGuardado', "Guardado");
        }
    }

    public function editZom($id)
    {
        $user = user_sombies::findOrFail($id);
        return view('UserZombie.editZombie', compact('user'));
    }

    public function updateZom(Request $request,$id)
    {
        $dato = request()->except((['_token', '_method']));

        //Editar foto
        if($request->hasFile('image')){

            $user= user_sombies::findOrFail($id);
            Storage::delete('public/'.$user->image);
            $dato['image']=$request->file("image")->store('uploads', 'public');
        }

        user_sombies::where('id', '=', $id)->update($dato);

        return redirect('/home')->with('usuarioModificado', 'Modificado');

    }

    public function destroy($id)
    {
        $user= user_sombies::FindOrFail($id);

        //para eliminar foto
        if(Storage::delete('public/'.$user->image)){
            user_sombies::destroy($id);
        }

        return redirect('/home')->with('usuarioEliminado', 'Eliminado');
    }

    //api-visualizar tabla
    public function getAll()
    {
        $user =user_sombies::all();
        return $user;
    }

    //api-para editar los usuarios
    public function editUserApi($id, Request $request)
    {
        user_sombies::find($id)->fill($request->all())->save();

        return response()->json([
            'Editado exitosamente',
        ]);
    }

    //api-para eliminar usuario
    public function destroyUser($id)
    {
        user_sombies::destroy($id);
        return response()->json([
            'Eliminado exitosamente',
        ]);
    }

    //para la autencicacion en mi android
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = user_sombies::where('email', $credentials['email'])
            ->where('password', $credentials['password'])
            ->first();

        if ($user) {
            Auth::guard('web')->login($user); // Establece la sesión
            return response()->json([
                'message' => 'Inicio de sesión exitoso',
                'user' => $user,
            ]);
        } else {
            return response()->json(['message' => 'Inicio de sesión fallido'], 401);
        }
    }
}
