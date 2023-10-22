<?php

namespace App\Http\Livewire\GestorTrabajos;

use App\Models\platform;
use App\Models\trabajo;
use App\Models\tutorial;
use Livewire\Component;

class TrabajoVideo extends Component
{
    public $trabajo;
    public $tutorial;
    public $platforms;
    public $title;
    public $platform_id = 1;
    public $url;

    protected $rules = [
        'tutorial.title' => 'required',
        'tutorial.platform_id' => 'required',
        'tutorial.url' => ['required', 'regex:%^ (?:https?://)? (?:www\.)? (?: youtu\.be/ | youtube\.com (?: /embed/ | /v/ | /watch\?v= ) ) ([\w-]{10,12}) $%x'],
    ];
    public function mount(trabajo $trabajo) {
        $this->trabajo = $trabajo;
        $this->tutorial = new tutorial();
        $this->platforms = platform::all();

    }

    public function render()
    {

        return view('livewire.GestorTrabajos.trabajo-video');
    }
    public function edit(tutorial $tutorial) {
        $this->resetValidation();
        $this->tutorial = $tutorial;
    }
    public function update() {

        if($this->tutorial->platform_id ==2) { // es VIMEO
            $this->rules['tutorial.url'] = ['required', 'regex:/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/'];
        }

        $this->validate();

        $this->tutorial->save();
        $this->tutorial = new tutorial();
        $this->trabajo = trabajo::find($this->trabajo->id);
    }
    public function cancel() {

        $this->tutorial = new tutorial();
    }
    public function store() {
        $rules = [
            'title' => 'required',
            'platform_id' => 'required',
            'url' => ['required', 'regex:%^ (?:https?://)? (?:www\.)? (?: youtu\.be/ | youtube\.com (?: /embed/ | /v/ | /watch\?v= ) ) ([\w-]{10,12}) $%x'],
        ];
        if($this->platform_id ==2) { // es VIMEO
            $rules['url'] = ['required', 'regex:/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/'];
        }

        $this->validate($rules);
        tutorial::create([
            'title' => $this->title,
            'platform_id' => $this->platform_id,
            'url' => $this->url,
            'trabajo_id' => $this->trabajo->id

        ]);
        $this->reset(['title','platform_id','url']);
        $this->trabajo = trabajo::find($this->trabajo->id);

    }
    public function destroy(tutorial $video) {
        $video->delete();
        $this->trabajo = trabajo::find($this->trabajo->id);
    }
}
