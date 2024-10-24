<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $categories = Categorie::all();

            return response()->json($categories, 200);
        }  catch (\Exception $e) {

            return response()->json($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $categories = new categorie([
                'nomcategorie' => $request->input("nomcategorie"),
                'imagecategorie' => $request->input("imagecategorie")
            ]);
            $categories->save();
            return response()->json("categories", 200);
        }  catch (\Exception $e) {

            return response()->json($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $categorie=Categorie::findOrFail($id);
            return response()->json($categorie);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        try {
           // var_dump($request);
            $categorie=Categorie::findOrFail($id);
            $categorie->update($request->all());
            return response()->json($categorie,200);
        }
        catch (\Exception $e) {

            return response()->json($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $categorie=Categorie::findOrFail($id);
            $categorie->delete();
            return response()->json();
        }
        catch (\Exception $e) {

            return response()->json($e->getMessage(), $e->getCode());
        }
    }
}
