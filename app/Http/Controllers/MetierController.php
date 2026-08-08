<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMetierRequest;
use App\Http\Requests\UpdateMetierRequest;
use App\Models\Metier;
use Illuminate\Http\Request;

class MetierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $metiers = Metier::latest()->paginate(10);

        return view('metiers.index', compact('metiers'));
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
    public function store(StoreMetierRequest $request)
    {

        Metier::create($request->validated());


        return redirect()
            ->route('metiers.index')
            ->with('success', 'Métier ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Metier $metier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Metier $metier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMetierRequest $request, Metier $metier)
    {

        $metier->update($request->validated());


        return redirect()
            ->route('metiers.index')
            ->with('success', 'Métier modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Metier $metier)
    {
        try {

            $metier->delete();

            return redirect()
                ->route('metiers.index')
                ->with(
                    'success',
                    'Métier supprimé avec succès.'
                );
        } catch (\Illuminate\Database\QueryException $e) {

            return redirect()
                ->route('metiers.index')
                ->with(
                    'error',
                    'Impossible de supprimer ce métier car il est utilisé par un ou plusieurs travailleurs.'
                );
        } catch (\Exception $e) {

            return redirect()
                ->route('metiers.index')
                ->with(
                    'error',
                    'Une erreur est survenue.'
                );
        }
    }
}
