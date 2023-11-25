<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Users/Index', [
            'users' => User::when($request->termo, function ($query, $termo) {
                $query->where('nome', 'like', '%' . $termo . '%')
                    ->OrWhere('dni', 'like', '%' . $termo . '%');
            })
                ->orderBy('num_socia')
                ->paginate(
                    10
                )->through(function ($item) {
                    return [
                        'id' => $item->id,
                        'num_socia' => $item->num_socia,
                        'nome' => $item->nome,
                        'dni' => $item->dni,
                    ];
                })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
