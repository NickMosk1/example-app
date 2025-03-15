<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    // Страница аккаунта
    public function index()
    {
        $user = Auth::user();
        return view('customPages.accountPage.account', [
            'user' => $user,
            'colors' => config('app.colors') // Передача цветов в шаблон
        ]);
    }

    // Обновление данных
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|min:6|confirmed'
        ]);

        $user->update($request->only('name', 'email'));

        if ($request->password) {
            $user->update([
                'password' => bcrypt($request->password)
            ]);
        }

        return redirect()->back()->with('success', 'Данные обновлены!');
    }
}
