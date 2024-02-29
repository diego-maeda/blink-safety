<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\SetAccessTokenRequest;
use App\Models\Lamp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Inertia\Response;


/**
 * This controller handles interactions with LIFX smart lights within a web application.
 * It primarily manages user authentication, lamp retrieval, and enabling/disabling blink-safety notifications.
 * @author Diego Maeda maeda.diego@gmail.com
 */
class DashboardController extends Controller
{
    /**
     * This method is responsible for returning the main dashboard for the user
     * If the user is already set up then we just send to the last screen of the process
     * otherwise he is sent to the beggining of the process
     * @return RedirectResponse|Response
     */
    public function index(): Response|RedirectResponse
    {
        $user = auth()->user();

        $token = $user->apiTokens()->where(['service' => 'lifx'])->first();

        // If the token is present we just send the user straight to the last screen
        if ($token) {
            return to_route('get-lamps');
        }

        return Inertia::render('Authenticated/Dashboard');
    }

    /**
     * Returns the screen where the user can add the access token for LIFX API connection
     * @return Response
     */
    public function getAccessToken(): Response
    {
        return Inertia::render('Authenticated/AccessToken');
    }

    /**
     * This method will allow the customer to set his access token
     * @param SetAccessTokenRequest $request
     * @return RedirectResponse
     */
    public function setAccessToken(SetAccessTokenRequest $request): RedirectResponse
    {
        $user = auth()->user();

        $token = $user->apiTokens()->where('service', 'lifx')
            ->first();

        if (is_null($token)) {
            $user->apiTokens()->create([
                'service' => 'lifx',
                'access_token' => $request->access_token,
            ]);

            return to_route('get-lamps');

        }

        $token->update([
            'access_token' => $request->access_token,
        ]);

        return to_route('get-lamps');

    }

    /**
     * We retrieve every single lamp that the user has and save it to the database
     * then we return the screen with all the lamps to show the customer where he can select multiple options
     * @return Response|RedirectResponse
     */
    public function getLamps(): Response|RedirectResponse
    {
        $user = auth()->user();

        $token = $user->apiTokens()->where(['service' => 'lifx'])->first();

        // If not token is present we should redirect back to the getAccessToken screen
        if (is_null($token)) {
            return to_route('get-access-token');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token->access_token,
        ])->get('https://api.lifx.com/v1/lights/all')->object();

        foreach ($response as $lamp) {
            Lamp::updateOrCreate([
                'lamp_id' => $lamp->id,
                'user_id' => auth()->user()->id,
            ], [
                'label' => $lamp->label,
                'power' => $lamp->power === 'on',
                'connected' => $lamp->connected,
            ]);
        }

        $lamps = $user->lamps;

        return Inertia::render('Authenticated/Lamps', [
            'lamps' => $lamps
        ]);
    }

    /**
     * If the customer wants to change his access token he will be able to.
     * We will disable the lamps as well otherwise it might throw an error because the key is no longer present.
     * @return RedirectResponse
     */
    public function deleteToken(): RedirectResponse
    {
        $user = auth()->user();

        $user->lamps()->where(['blink_safety_connected' => true])->update(['blink_safety_connected' => false]);

        $user->apiTokens()->where(['service' => 'lifx'])->delete();

        return to_route('dashboard');
    }

    /**
     * This method will enable the lamp to receive blink-safety notifications
     * @param $id
     * @return RedirectResponse
     */
    public function setLamp($id): RedirectResponse
    {
        $lamp = Lamp::where(['lamp_id' => $id])->first();

        $lamp->update(['blink_safety_connected' => true]);

        $user = auth()->user();

        $token = $user->apiTokens()->where(['service' => 'lifx'])->first();

        Http::withHeaders(
            ['Authorization' => 'Bearer ' . $token->access_token,]
        )->put('https://api.lifx.com/v1/lights/id:' . $lamp->lamp_id . '/state', [
            'power' => 'on',
            'color' => 'purple saturation:0.5',
            'brightness' => 0.5,
            'duration' => 10,
        ]);

        return to_route('get-lamps');
    }

    /**
     * This method will disable the lamp to receive blink-safety notifications
     * @param $id
     * @return RedirectResponse
     */
    public function unsetLamp($id): RedirectResponse
    {
        $lamp = Lamp::where(['lamp_id' => $id])->first();

        $lamp->update(['blink_safety_connected' => false]);

        $user = auth()->user();

        $token = $user->apiTokens()->where(['service' => 'lifx'])->first();

        Http::withHeaders(
            ['Authorization' => 'Bearer ' . $token->access_token,]
        )->put('https://api.lifx.com/v1/lights/id:' . $lamp->lamp_id . '/state', [
            'power' => 'off',
            'duration' => 1,
        ]);

        return to_route('get-lamps');
    }


}
