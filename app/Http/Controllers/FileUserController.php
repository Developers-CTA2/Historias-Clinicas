<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUserController extends Controller
{
    // Download the template file for the user
    public function downloadTemplate()
    {

        if (!Storage::disk('public')->exists('plantilla-carta-compromiso.pdf')) {
            abort(404);
        }

        $file = Storage::disk('public')->path('plantilla-carta-compromiso.pdf');

        return response()->download($file);
    }

    // Upload the template file for the user
    public function uploadTemplate(Request $request)
    {

        try {
            $request->validate([
                'file' => 'required|mimes:pdf|max:2048',
            ]);

            if ($request->file('file')->isValid()) {
                $file = $request->file('file')->store('public');
                return response()->json(['message' => 'Archivo subido correctamente', 'data' => $file], 200);
            }

            return response()->json(['message' => 'Error al subir el archivo', 'data' => null], 500);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Error al subir el archivo', 'data' => $e], 500);
        }
    }

    public function getUserFile($id_user){

        $user = User::findOrfail($id_user);

        // return response()->json(['file' => $user->file], 200);

        if($user->file == null){
            abort(404);
        }

        if (!Storage::exists($user->file)) {
            abort(404);
        }

        return Storage::download($user->file);

        
        
    }

}
