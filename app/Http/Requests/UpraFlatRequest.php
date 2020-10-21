<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpraFlatRequest extends FormRequest
{

    public function authorize() {

      // se il Gate upra-manage-flat restituisce false,
      // ovvero se l'utente loggato è diverso dall'utente dell'appartamento,
      // non permetto il FlatRequest
      if (Gate::denies('upra-manage-flats')) {
        return false;
      }
      return true;

    }

     public function rules() {

         return [
           'title' => 'bail|required|string|max:255',
           'desc' => 'required|max:500',
           'rooms' => 'required|numeric',
           'beds' => 'required|numeric',
           'baths' => 'required|numeric',
           'img' => 'required|image'
         ];

     }

    public function messages() {

      return [
        'title.required' => 'Il campo Titolo è richiesto.',
        'desc.required' => 'Il campo Descrizione è richiesto.',
        'rooms.required' => 'Indicare il numero di stanze',
        'rooms.numeric' => 'Indicare il numero di stanze',
        'beds.required' => 'Indicare il numero di letti',
        'beds.numeric' => 'Indicare il numero di letti',
        'baths.required' => 'Indicare il numero di bagni',
        'baths.numeric' => 'Indicare il numero di bagni',
        'img.required' => "Inserire un'immagine"
      ];
    }
}
