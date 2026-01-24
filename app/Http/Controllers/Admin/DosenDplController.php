<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DosenDpl;
use Illuminate\Http\Request;

class DosenDplController extends Controller
{
    public function index(Request $request)
    {
        $query = DosenDpl::query();

        if (request()->filled('search')) {
            $search = request()->search;
            $query->where(function ($q) use ($search) {
                $q->where('nuptk', 'like', "%$search%")
                    ->orWhere('nama_dosen', 'like', "%$search%")
                    ->orWhere('prodi', 'like', "%$search%")
                    ->orWhere('bidang_keahlian', 'like', "%$search%")
                    ->orWhere('no_hp', 'like', "%$search%");
            });
        }

        $dosendpls = $query->orderBy('created_at', 'desc')->paginate(5)->withQueryString();

        if ($request->ajax()) {
            return view('admin.partials.dosen-dpl-table', compact('dosendpls'))->render();
        }
        
        return view('admin.dosen-dpl', [
            'dosendpls' => $dosendpls
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nuptk' => 'string|required|max:20|unique:dosen_dpl,nuptk',
            'nama_dosen' => 'string|required|max:100',
            'prodi' => 'string|required|max:100',
            'bidang_keahlian' => 'string|required|max:50',
            'no_hp' => 'string|required|max:15',
        ], [
            'nuptk.unique' => 'Nuptk sudah ada.'
        ]);

        DosenDpl::create($data);

        return redirect()->route('admin.dosen-dpl')->with('success', 'Dosen DPL berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $dosenDpl = DosenDpl::findOrFail($id);

        $data = $request->validate([
            'nuptk' => 'string|required|max:20|unique:dosen_dpl,nuptk,' . $dosenDpl->id,
            'nama_dosen' => 'string|required|max:100',
            'prodi' => 'string|required|max:100',
            'bidang_keahlian' => 'string|required|max:50',
            'no_hp' => 'string|required|max:15',
        ]);

        $dosenDpl->update($data);

        return redirect()->route('admin.dosen-dpl')->with('success', 'Dosen DPL berhasil diubah');
    }

    public function delete($id)
    {
        $dosenDpl = DosenDpl::findOrFail($id);
        $dosenDpl->delete();
        return redirect()->route('admin.dosen-dpl')->with('success', 'Dosen DPL berhasil dihapus');
    }
}
