<?php

namespace App\Livewire\Admin\About;

use App\Models\About;
use Livewire\Component;
use Livewire\WithPagination;


class Aboutus extends Component
{
    public function render()
    {
      $abouts=About::simplePaginate(10);
        return view('livewire.admin.about.about',compact('abouts'));
    }


    public function delete($id)
    {
       $about = About::findOrFail($id);
        $this->authorize('delete', $about);
        if($about->image){
            $path=public_path("storage/").$about->image;
            if(file_exists($path)){
                // dd($path);
                @unlink($path);
            }
        }
        $about->delete();
        session()->flash('delete', 'Aboutus Deleted Successfully.');
    }
}