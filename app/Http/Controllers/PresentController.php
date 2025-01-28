<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Present;

class PresentController extends Controller
{
    public function index() {
        $presents = Present::where('is_selected', false)->get();
        return view('index', compact('presents'));
    }
    
    public function select(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'presents' => 'required|array',
            'presents.*' => 'exists:presents,id',
        ]);
    
        $name = $request->input('name');
        $presents = $request->input('presents');
    
        foreach ($presents as $presentId) {
            $present = Present::findOrFail($presentId);
            $present->is_selected = true;
            $present->selected_by = $name;
            $present->save();
        }
    
        return redirect('/')->with('success', 'Presentes escolhidos com sucesso!');
    }
    
    
    public function admin() {
        $presents = Present::all();
        return view('admin', compact('presents'));
    }
    
    public function store(Request $request) {
        Present::create($request->only('name', 'description'));
        return redirect('/admin')->with('success', 'Presente adicionado com sucesso!');
    }

    public function delete($id)
    {
        $present = Present::findOrFail($id);
        $present->delete();

        return redirect()->route('admin')->with('success', 'Presente excluído com sucesso.');
    }

    public function removeDonor($id)
    {
        $present = Present::findOrFail($id);
        $present->is_selected = false;
        $present->selected_by = null; // Remove o nome do doador
        $present->save();

        return redirect()->route('admin')->with('success', 'Doador removido e presente liberado.');
    }

    
}
