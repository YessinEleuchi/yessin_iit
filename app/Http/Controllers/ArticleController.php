<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try {

            $article = Article::with("scategorie")->get();
            return response()->json($article, 200);
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

            $article = new Article([

                "deignation" => $request->input("deignation"),
                "reference" => $request->input("reference"),
                "marque" => $request->input("marque"),
                "prix" => $request->input("prix"),
                "qtestock" => $request->input(key: "qtestock"),
                "imageart" => $request->input(key: "imageart"),
                'scategorieID' => $request->input("scategorieID")
            ]);
            $article->save();
            return response()->json("article", 200);
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
            $Article = Article::with("scategorie")->findOrFail($id);
            return response()->json($Article);
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
            $Article = Article::findOrFail($id);
            $Article->update($request->all());
            return response()->json($Article, 200);
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
            $Article = Article::findOrFail($id);
            $Article->delete();
            return response()->json();
        } catch (\Exception $e) {

            return response()->json($e->getMessage(), $e->getCode());
        }
    }
    public function showArticleBySCAT($id)
    {
        try {
            $Article = Article::where('scategorieID', $id)->with("scategorie")->get();

            return response()->json($Article);
        } catch (\Exception $e) {

            return response()->json($e->getMessage(), $e->getCode());
        }
    }
    public function articlesPaginate()
    {
        try {
            $perPage = request()->input('pageSize', '10');
            $Article = Article::with('scategorie')->paginate($perPage);

            return response()->json([
                'products' => $Article->items(),
                'totalPages' => $Article->lastPage(),



            ]);
        } catch (\Exception $e) {

            return response()->json($e->getMessage(), $e->getCode());
        }
    }
}
