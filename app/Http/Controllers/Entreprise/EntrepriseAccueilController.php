<?php namespace App\Http\Controllers\Entreprise;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class EntrepriseAccueilController extends Controller {



    /**
     * Calculer le pourcentage de completion du profil de l'entreprise
     * @return mixed
     */
    public function getPourcentageProfil()
    {

        $entreprise=Auth::user()->user;

        $index=0;

        if($entreprise->logo)
            $index+=1;
        if($entreprise->description)
            $index+=1;
        if($entreprise->siret)
            $index+=1;
        if($entreprise->secteur)
            $index+=1;
        if($entreprise->lieu)
            $index+=1;
        if($entreprise->taille)
            $index+=1;
        if($entreprise->site)
            $index+=1;
        if($entreprise->sociaux)
            $index+=1;
        if($entreprise->fax)
            $index+=1;
        if($entreprise->telephone)
            $index+=1;
        $pourcentage=$index/11;

        return View::make('entreprise.home')->with('pourcentage',$pourcentage);
    }

}