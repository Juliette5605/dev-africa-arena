<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $query = Media::with('uploader')->latest();
        if ($request->filled('category')) $query->where('category', $request->category);
        $medias = $query->paginate(20)->withQueryString();
        return view('admin.media.index', compact('medias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file'     => 'required|file|mimes:jpg,jpeg,png,gif,webp,svg,pdf|max:5120',
            'category' => 'required|in:logo,hero,partenaire,general',
            'name'     => 'nullable|string|max:200',
        ], [
            'file.required'  => 'Veuillez sélectionner un fichier.',
            'file.mimes'     => 'Formats acceptés : JPG, PNG, GIF, WEBP, SVG, PDF.',
            'file.max'       => 'Taille maximum : 5 MB.',
            'category.required' => 'Veuillez choisir une catégorie.',
        ]);

        $file      = $request->file('file');
        $original  = $file->getClientOriginalName();
        $filename  = Str::slug(pathinfo($original, PATHINFO_FILENAME)).'-'.time().'.'.$file->getClientOriginalExtension();
        $path      = $file->storeAs('media/'.$request->category, $filename, 'public');

        $media = Media::create([
            'name'        => $request->name ?: $original,
            'filename'    => $filename,
            'path'        => $path,
            'type'        => $file->getMimeType(),
            'size'        => $file->getSize(),
            'category'    => $request->category,
            'uploaded_by' => Auth::guard('admin')->id(),
        ]);

        ActivityLog::log('uploadé', 'Média', $media->name.' ('.$media->category.')');
        return back()->with('success', '✅ Fichier "'.$media->name.'" uploadé avec succès.');
    }

    public function destroy(Media $media)
    {
        Storage::disk('public')->delete($media->path);
        $nom = $media->name;
        $media->delete();
        ActivityLog::log('supprimé', 'Média', $nom);
        return back()->with('success', 'Média supprimé.');
    }
}
