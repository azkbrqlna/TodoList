<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $max = 5;
        if (request('search')) {
            $data = Todo::where('task', 'like', '%' . request('search') . '%')->paginate($max);
        } else {

            $data = Todo::latest()->paginate($max);
        }
        return view('todo.layout', [
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|min:3|max:255',
        ], [
            'task.required' => 'Task wajib diisi',
            'task.min' => 'Task harus minimal 3 karakter',
            'task.max' => 'Task harus maksimal 255 karakter',
        ]);

        Todo::create($request->only('task'));
        return redirect()->route('todo')->with('success', 'Task sukses ditambahkan ✅');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'task' => 'required|min:3|max:255',
            'completed' => 'required',
        ], [
            'task.required' => 'Task wajib diisi',
            'task.min' => 'Task harus minimal 3 karakter',
            'task.max' => 'Task harus maksimal 255 karakter',
        ]);
        Todo::find($id)->update($request->only('task', 'completed'));

        return redirect()->route('todo')->with('success', 'Task sukses diupdate ✅');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Todo::find($id)->delete();
        return redirect()->route('todo')->with('success', 'Task sukses dihapus ✅');
    }
}


