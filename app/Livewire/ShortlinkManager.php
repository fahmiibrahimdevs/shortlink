<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Link;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ShortlinkManager extends Component
{
    public $original_url;

    protected $rules = [
        'original_url' => 'required|url|max:2048',
    ];

    public function createShortlink()
    {
        $this->validate();

        $shortCode = Str::random(6);
        while (Link::where('short_code', $shortCode)->exists()) {
            $shortCode = Str::random(6);
        }

        Link::create([
            'user_id' => Auth::id(),
            'original_url' => $this->original_url,
            'short_code' => $shortCode,
        ]);

        $this->reset('original_url');
        session()->flash('success', 'Shortlink created successfully!');
    }

    public function deleteLink($id)
    {
        $link = Link::findOrFail($id);
        
        if ($link->user_id === Auth::id()) {
            $link->delete();
            session()->flash('success', 'Shortlink deleted!');
        }
    }

    public function render()
    {
        $links = Link::where('user_id', Auth::id())->latest()->get();
        return view('livewire.shortlink-manager', [
            'links' => $links,
        ]);
    }
}
