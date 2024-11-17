<?php
namespace App\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class UpdateCategory extends Component
{
    use WithFileUploads;
    
    #[Validate('required|min:5')]
    public $category;
    public $photo;
    public $image;
    public $id;
    public $data = [];

    public function mount(Category $id)
    {
        $this->id = $id->id;
        $this->category = $id->name;
        $this->photo = $id->image;
    }

    public function update()
{
    $this->validate();

    $category = Category::findOrFail($this->id);

    $data = [];

    if ($this->category) {
        $data['name'] = $this->category;
    }

    if ($this->image) {
        // Check the type of $this->photo
        if ($this->image instanceof \Illuminate\Http\UploadedFile) {
            $data['image'] = $this->image->store('category', 'public');
            if($category->image){
            $path=public_path('storage/').$category->image;
            if(file_exists($path)){
                @unlink($path);
            }
        }
        }
    }

    if (!empty($data)) {
        $category->update($data);

        session()->flash('status', 'Category successfully updated.');
    } else {
        session()->flash('status', 'No changes were made.');
    }

    return redirect('/category');
}

    public function render()
    {
        return view('livewire.admin.category.update-category');
    }
}