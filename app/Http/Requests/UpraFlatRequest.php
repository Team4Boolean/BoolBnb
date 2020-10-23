<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Flat;

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

      // secono metodo
      // $flat = Flat::find($this -> route('id'));
      // return $flat && $this -> user() -> can('update', $flat);

    }

     public function rules() {

       return [
        'title' => 'bail|required|string|max:255',
        'desc' => 'required|max:500',

        'street_number' => '|required|string|max:8',
        'street_name' => '|required|string|max:85',
        'municipality'  => '|required|string|max:85',
        'subdivision' => '|required|string|max:50',
        'postal_code' => '|required|string|max:20',

        'rooms' => 'required|numeric',
        'beds' => 'required|numeric',
        'baths' => 'required|numeric',
        'sqm' => 'required|numeric',

        'img' => 'required|max:255'
       ];

     }

    public function messages() {

      return [
        'title.required' => 'Indicare un Titolo',
        'title.max' => 'Non sono consentiti più di 500 caratteri',
        'desc.required' => 'Inserire una Descrizione',
        'desc.max' => 'Non sono consentiti più di 500 caratteri',

        'street_number.required' => 'Inserisci il numero civico',
        'street_number.max' => 'Non sono consentiti più di 8 caratteri',
        'street_name.required' => 'Inserisci la via',
        'street_name.max' => 'Non sono consentiti più di 85 caratteri',
        'municipality.required' => 'Inserisci la città',
        'municipality.max' => 'Non sono consentiti più di 85 caratteri',
        'subdivision.required' => 'Inserisci la provincia',
        'subdivision.max' => 'Non sono consentiti più di 50 caratteri',
        'postal_code.required' => 'Inserisci il CAP',
        'postal_code.max' => 'Non sono consentiti più di 20 caratteri',


        'rooms.required' => 'Indicare il numero di stanze',
        'rooms.numeric' => 'Indicare il numero di stanze',
        'beds.required' => 'Indicare il numero di letti',
        'beds.numeric' => 'Indicare il numero di letti',
        'baths.required' => 'Indicare il numero di bagni',
        'baths.numeric' => 'Indicare il numero di bagni',
        'sqm.required' => 'Indicare la superficie',
        'sqm.numeric' => 'Indicare la superficie',

        'img.required' => "Inserire un'immagine"
      ];
    }
}
