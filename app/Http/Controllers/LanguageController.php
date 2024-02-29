<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\LanguageRequest;
use App\Models\Language;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

/**
 * This controller handles updating a user's preferred language within the application.
 * @author Diego Maeda maeda.diego@gmail.com
 */
class LanguageController extends Controller
{
    /**
     * This method updates the user's preferred language based on the provided request.
     * @param LanguageRequest $request
     * @return RedirectResponse
     */
    public function update(LanguageRequest $request): RedirectResponse
    {
        $language = Language::updateOrCreate([
            'user_id' => auth()->user()->id
        ], [
            'language' => $request->language,
        ]);

        // This sets the language to be followed by the backend as well
        if($language->language == 'pt-br'){
            App::setLocale('pt_BR');
        } else {
            App::setLocale($language->language);
        }

        return to_route('profile');
    }
}
