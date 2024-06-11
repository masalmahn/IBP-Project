<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaterialRequest;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialsController extends Controller
{
    public function show(Request $request)
    {
        if (Auth::user()->hasRole('Super-Admin')) {
            $data['materials'] = Material::latest();
        }
        else {
            $data['materials'] = Material::latest()->where('created_by', Auth::user()->id);
        }

        $name = $request->get('search_title');
        if ($name != '') {
            $data['materials'] = $data['materials']->filterByName($name);
        }

        $data['materials'] = $data['materials']->paginate(10);

        return view('pages.materials.materials', $data);
    }

    public function create()
    {
        return view('pages.materials.create');
    }

    public function store(MaterialRequest $request)
    {
        $data = $request->all();

        $aid = Material::updateOrCreate(['id' => 0], $data);

        return redirect()->route('materials.show');
    }

    public function edit($id)
    {
        $data['material'] = Material::find($id);

        return view('pages.materials.create', $data);
    }

    public function update(MaterialRequest $request)
    {
        $data = $request->all();

        $material = Material::updateOrCreate(['id' => $request->id], $data);

        return back()->with('succes', 'Material details succesfully updated!');
    }

    public function delete($id)
    {
        $material = Material::find($id);

        if (!$material) {
            return back()->with('error', 'Material not found!');
        }

        $material->delete();

        return back()->with('succes', 'Material deleted succesfully!');
    }
}
