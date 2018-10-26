<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfileformRequest;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('profile.edit');
    }

    public function update(UpdateProfileformRequest $request)
    {
        $user = auth()->user();

        $data = $request->all();

        /*if ($data['password'] != null) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }*/

        if (is_null($data['password'])) {
            unset($data['password']);
        }

        $data['image'] = $user->image;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($user->image) {
                $name = $user->image;
            } else {
                // kebab_case = tirar espaços e caracteres especiais
                $name = $user->id . kebab_case($user->name);
            }

            $extenstion = $request->image->extension();
            $nameFile = "{$name}.{$extenstion}";

            $data['image'] = $nameFile;

            $upload = $request->image->storeAs('users', $nameFile);

            if (!$upload) {
                return redirect()
                ->back()
                ->with('error', 'Falha ao fazer o upload da imagem');
            }
        }

        $update = $user->update($data);
        if ($update) {
            return redirect()
                    ->route('profile')
                    ->with('success', 'Sucesso ao atualizar!');
        }

        return redirect()
                ->back()
                ->with('error', 'Falha ao atualizar o perfil...');
    }
}
