<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
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
            'phone' => 'required|string|max:20|regex:/^[0-9]{2}-[0-9]{5}-[0-9]{4}$/', // Valida formato 99-99999-9999
            'presents' => 'required|array',
            'presents.*' => 'exists:presents,id',
        ]);

        $name = $request->input('name');
        $phone = $request->input('phone');
        $presents = $request->input('presents');

        try {
            DB::transaction(function () use ($presents, $name, $phone) {
                foreach ($presents as $presentId) {
                    $present = Present::findOrFail($presentId);
                    if ($present->is_selected) {
                        throw new \Exception('Um ou mais presentes já foram escolhidos por outra pessoa.');
                    }
                    $present->is_selected = true;
                    $present->selected_by = $name;
                    $present->selected_by_phone = $phone;
                    $present->save();
                }
            });
            return redirect('/')->with('success', 'Presentes escolhidos com sucesso!');
        } catch (\Exception $e) {
            return redirect('/')->with('error', $e->getMessage());
        }
    }
    
    public function admin() {
        $presents = Present::all();
        return view('admin', compact('presents'));
    }
    
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);
        
        Present::create($request->only('name', 'description'));
        return redirect('/admin')->with('success', 'Presente adicionado com sucesso!');
    }

    public function delete($id) {
        try {
            $present = Present::findOrFail($id);
            $present->delete();
            return redirect()->route('admin')->with('success', 'Presente excluído com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('admin')->with('error', 'Erro ao excluir o presente.');
        }
    }

    public function removeDonor($id) {
        try {
            $present = Present::findOrFail($id);
            $present->is_selected = false;
            $present->selected_by = null;
            $present->selected_by_phone = null; // Limpa o telefone
            $present->save();
            return redirect()->route('admin')->with('success', 'Doador removido e presente liberado.');
        } catch (\Exception $e) {
            return redirect()->route('admin')->with('error', 'Erro ao liberar o presente.');
        }
    }
}