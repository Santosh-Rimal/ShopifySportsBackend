<?php

namespace App\Livewire\Admin\Inquiry;

use App\Models\Contact;
use Livewire\Component;
use App\Events\InquiryEvent;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Inquiry extends Component
{
    use WithPagination;

    #[On('echo:contact,InquiryEvent')]
    public function refreshInquiries()
    {
        $this->render(); // Re-renders to update the list
    }

    public function render()
    {
        $inquiries = Contact::with('user')->paginate(10);
        // sleep(5);

        return view('livewire.admin.inquiry.inquiry', compact('inquiries'));
    }

    public function broadcastInquiry()
    {
        broadcast(new InquiryEvent(Contact::with('user')->get()));
    }

   public function delete($id)
    {
        // dd($id);
        $inquiry = Contact::findOrFail($id);
        $this->authorize('delete', $inquiry);
        $inquiry->delete();
        session()->flash('delete', 'Contact Deleted Successfully.');
        sleep(2);
        $this->broadcastInquiry();
    }
}