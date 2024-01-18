<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\LinkStat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class MainController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $links = $user->links()->get();

        return view('dashboard', ['links' => $links]);
    }

    public function create()
    {
        return view('forms.new');
    }

    public function createShortLink(Request $request)
    {
        try {
            $request->validate([
                'original_url' => 'required|url',
                'short_url' => [
                    'required',
                    'alpha_dash',
                    'unique:links,short_url',
                    Rule::notIn($this->getReservedShortUrls()),
                ],
                'comment' => 'nullable|string',
            ]);
        } catch (ValidationException $e) {
            return redirect()->route('forms.new')->with('status', 'link-failed');
        }

        Link::create([
            'original_url' => $request->input('original_url'),
            'short_url' => $request->input('short_url'),
            'comment' => $request->input('comment'),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('forms.new')->with('status', 'link-created');

    }

    public function redirectToOriginalUrl($shortUrl)
    {
        $link = Link::where('short_url', $shortUrl)->first();

        if (!$link) {
            return abort(404);
        }

        LinkStat::create([
            'link_id' => $link->id,
            'ip_address' => request()->ip(),
        ]);

        return redirect()->away($link->original_url);
    }

    protected function getReservedShortUrls()
    {
        return config('reserved', []);
    }
}
