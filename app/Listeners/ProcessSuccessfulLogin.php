<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\BridgingSatuSehat;

class ProcessSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Login $event)
    {
        // Log
    \Log::info('ProcessSuccessfulLogin listener is triggered.');

    // Echo
    echo "ProcessSuccessfulLogin listener is triggered.";
    
        $idKlinik = $event->user->id_klinik;
        $satusehat = BridgingSatuSehat::where('id_klinik', $idKlinik)->first();
        $client_id = $satusehat->client_key;
        $client_secret = $satusehat->secret_key;
        if($client_id){
            $response = Http::asForm()->post('https://api-satusehat-stg.dto.kemkes.go.id/oauth2/v1/accesstoken?grant_type=client_credentials', [
                'client_id' => $client_id,
                'client_secret' => $client_secret,
            ]);
            $accessToken = $response->json()['access_token'];
            Session::put('access_token', $accessToken);
        } else {
            Session::put('access_token', '');
        }
    }
}
