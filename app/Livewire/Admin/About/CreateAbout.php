<?php

namespace App\Livewire\Admin\About;

use Livewire\WithFileUploads;
use App\Models\About;
use Livewire\Component;
use Livewire\Attributes\Validate;

class CreateAbout extends Component
{
    use WithFileUploads;

    #[validate('required|string|max:255|min:5')]
    public $title;
    #[validate('nullable|string|max:255|min:5')]
    public $slogan;
    #[validate('required|string|max:2000')]
    public $description;
    #[validate('nullable|image|max:1024')]
    public $image;
    #[validate('nullable|string|max:255')]
    public $others;

    public function save()
    {
        $this->validate();
            About::create([
                'title' => $this->title,
                'slogan' => $this->slogan,
                'description' => $this->description,
                'image' => $this->image ? $this->image->store('about', 'public') : null,
                'others' => $this->others,
            ]);

        session()->flash('status', 'About Us created successfully!');

        return redirect('/about');
    }

    public function render()
    {
        return view('livewire.admin.about.create-about');
    }

    public function updated(){
        $this->skipRender();
    }
}