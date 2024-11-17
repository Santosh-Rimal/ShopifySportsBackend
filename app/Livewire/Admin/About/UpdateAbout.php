<?php

namespace App\Livewire\Admin\About;

use App\Models\About;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class UpdateAbout extends Component
{
    use WithFileUploads;

    #[Validate('string|max:255|min:5')]
    public $title;

    #[Validate('string|max:255|min:5')]
    public $slogan;

    #[Validate('string|max:2000')]
    public $description;

    #[Validate('nullable|image|max:1024')]
    public $image;

    #[Validate('string|max:255')]
    public $others;

    public $photo;
    public $id;
    public $about;
    public $data = [];

    public function mount(About $id)
    {
        $this->id = $id->id;
        $this->title = $id->title;
        $this->slogan = $id->slogan;
        $this->description = $id->description;
        $this->photo = $id->image; // Assuming $about->image is a string path to the image
        $this->others = $id->others;
    }

  public function update()
{
    $this->validate();

    $about = About::findOrFail($this->id);

    // Initialize an empty data array
    $data = [];

    if ($this->title) {
        $data['title'] = $this->title;
    }
    if ($this->slogan) {
        $data['slogan'] = $this->slogan;
    }
    if ($this->description) {
        $data['description'] = $this->description;
    }
    if ($this->others) {
        $data['others'] = $this->others;
    }
 
  if ($this->image) {
            if ($this->image instanceof \Illuminate\Http\UploadedFile) {
            $data['image'] = $this->image->store('about', 'public');
            if($about->image){
            $path=public_path('storage/').$about->image;
            if(file_exists($path)){
                @unlink($path);
            }
        }
    }
}


    if (!empty($data)) {
        $about->update($data);
    }

    session()->flash('status', 'About section successfully updated.');

    return redirect('/about');
}



    public function render()
    {
        return view('livewire.admin.about.update-about');
    }
}