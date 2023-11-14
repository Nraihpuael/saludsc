<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class OCRController extends Controller
{
    public function index()
    {
        return view('archivo.index');
    }


    public function imageOCR(Request $request)
    {

        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed
        ]);
        $imageFile = $request->file('file');

        // Set the path to your service account key JSON file
        putenv('GOOGLE_APPLICATION_CREDENTIALS=D:/Nodriza/Nahuel/Conocimiento/Universidad/Taller de Grado/Documentos/Credenciales/credencial.json');

        // Create an ImageAnnotatorClient
        $imageAnnotator = new ImageAnnotatorClient();
        // Read the image file
        $image = file_get_contents($imageFile->getPathname());

        // Perform text detection
        $response = $imageAnnotator->textDetection($image);

        // Get the text annotations
        $texts = $response->getTextAnnotations();

        $wordInfo = [];

        foreach (iterator_to_array($texts) as $index => $text) {
            if ($index === 0) {
                continue;
            }
            $description = $text->getDescription();
            $vertices = $text->getBoundingPoly()->getVertices();
            $wordInfo[] = [
                'word' => $description,
                'boundingBox' => [
                    'x' => $vertices[0]->getX(),
                    'y' => $vertices[0]->getY(),
                ],
                'check_value' => 1,
            ];
        }

        $userData = [];

        foreach ($wordInfo as $index => $wordData) {
            if ($wordInfo[$index]['check_value'] == 1) {
                $wordInfo[$index]['check_value'] = 0;
                $currentY = $wordData['boundingBox']['y'];
                $concatenatedWord = $wordData['word'];

                foreach ($wordInfo as $otherIndex => $otherWordData) {
                    if ($otherWordData['check_value'] == 1) {
                        $otherY = $otherWordData['boundingBox']['y'];
                
                        if ($otherY >= $currentY - 35 && $otherY <= $currentY + 35) {
                            $concatenatedWord .= ' ' . $otherWordData['word'];
                            $wordInfo[$otherIndex]['check_value'] = 0; // Set check_value to 0 for concatenated words
                        }
                    }
                }
                $userData[] = $concatenatedWord;     
            }
        }
        $this->newUser($userData);
        $imageAnnotator->close();

        return redirect()->route('users.index')->with('success', 'Usuario editado exitosamente.');
    }




    public function newUser($userData) {
        $desiredKeys = [
            "Nombre",
            "Apellidos",
            "Sexo",
            "Edad",
            "CI",
            "Direccion",
            "Telefono",
        ];
        
        // Use array_filter and array_intersect_key to filter the array based on keys
        $filteredUserData = array_filter($userData, function ($item) use ($desiredKeys) {
            // Extract the key from each item
            $key = explode(" : ", $item, 2)[0];
        
            // Check if the key is in the desiredKeys array
            return in_array($key, $desiredKeys);
        });
        
        // Reset the array keys
        $filteredUserData = array_values($filteredUserData);

        $nombre='';
        $ci=null;
        $telefono=null;
        $apellido='';
        $sexo=null;
        $direccion=null;

        foreach ($filteredUserData as $item) {
            if (strpos($item, 'Nombre') !== false) {
                $nombre = str_replace('Nombre : ', '', $item);
                continue;
            }
            if (strpos($item, 'Apellidos') !== false) {
                $apellido = str_replace('Apellidos : ', '', $item);
            }
            if (strpos($item, 'CI') !== false) {
                $ciValue = str_replace('CI : ', '', $item);
                $ci = intval($ciValue) !== 0 ? intval($ciValue) : $ciValue;            
            }
            if (strpos($item, 'Telefono') !== false) {
                $telefono = str_replace('Telefono : ', '', $item);
            }
            if (strpos($item, 'Sexo') !== false) {
                $sexoValue = str_replace('Sexo : ', '', $item);
                $sexo = (strtolower(substr($sexoValue, 0, 1)) == 'm') ? 'M' : ((strtolower(substr($sexoValue, 0, 1)) == 'f') ? 'F' : null);
            }
            if (strpos($item, 'Direccion') !== false) {
                $direccion = str_replace('Direccion : ', '', $item);
            }
        }

        $email = strtolower(str_replace(' ', '', $nombre) . str_replace(' ', '', $apellido).'@gmail.com');

        try {
            $user = new User();
            $user->ci = $ci;
            $user->name = $nombre;
            $user->email = $email;
            $user->ap_paterno = $apellido;
            $user->telefono = $telefono;
            $user->barrio = $direccion;
            $user->genero = $sexo;
            $user->password = bcrypt('password');

            $user->save();
            $role = 'Paciente';
            $user->assignRole($role);
        } catch (\Exception $e) {
        
        }
    }
}
