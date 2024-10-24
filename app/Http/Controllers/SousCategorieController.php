<?php

namespace App\Http\Controllers;

use App\Models\SousCategorie;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class SousCategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $scategorie = SousCategorie::with("category")->get();
            return response()->json($scategorie);
        } catch (\Exception $e) {

            return response()->json($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $categories = new Souscategorie([
                'nomcategorie' => $request->input("nomcategorie"),
                'imagecategorie' => $request->input("imagecategorie"),
                'categorieID' => $request->input("categorieID")

            ]);
            $categories->save();
            return response()->json("categories", 200);
        } catch (\Exception $e) {

            return response()->json($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $categorie = SousCategorie::with("category")->findOrFail($id);
            return response()->json($categorie);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $categorie = SousCategorie::findOrFail($id);
            $categorie->update($request->all());
            return response()->json($categorie, 200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $categorie=SousCategorie::findOrFail($id);
            $categorie->delete();
            return response()->json();
        }
        catch (\Exception $e) {

            return response()->json($e->getMessage(), $e->getCode());
        }
    }
}
