<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlRequest;
use App\Models\Url;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function index(): Renderable
    {
        $urls = Url::all();
        return view('urls.index', compact('urls'));
    }

    public function create(): Renderable
    {
        return view('urls.create');
    }

    public function store(UrlRequest $request): RedirectResponse
    {
        $params = $request -> validated();
        $params['short_url'] = Url::getShortHash();
        $params['expires_at'] = now()->addDays(7);
        $params['user_id'] = auth() -> id();

        (new Url()) -> create($params);

        return redirect() -> route('urls.index');
    }

    public function edit(Url $url)
    {
        if (!auth() -> user() -> is_admin && auth() -> user() -> id != $url -> user_id) {
            return redirect() -> route('urls.index');
        }
        return view('urls.edit', compact('url'));
    }

    public function update(UrlRequest $request, Url $Url): RedirectResponse
    {
        $Url->update($request->validated());
        return redirect() -> route('urls.index');
    }

    public function destroy(Url $url): RedirectResponse
    {
        $url -> delete();
        return redirect() -> route('urls.index');
    }

    public function redirect($hash)
    {
        $url = Url::where('short_url', $hash) -> first();

        if (!$url || $url -> is_expired) {
            return redirect() -> route('urls.index');
        }

        if($url->is_secure) {

            if(!auth()->check()) {
                return redirect() -> route('urls.index');
            }

            if(auth()->user()->company_id !== $url->user->company_id) {
                return redirect() -> route('urls.index');
            }

//            LOGIKA ZA pracenje usera koji su posjetili url
            $url->users()->attach(auth()->user()->id);
        }

        $url->count++;
        $url->save();
        return redirect($url->url);
    }

    public function extendExpiry(Url $url): RedirectResponse
    {
        $url -> expires_at = now()->addDays(7);
        $url -> save();
        return redirect() -> route('urls.index');
    }
}
