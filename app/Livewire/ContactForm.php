<?php

namespace App\Livewire;

use App\Mail\ContactUsMail;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $message;
    protected $rules = [
        'name' => 'required|string|min:4|max:100',
        'email' => 'required|email|min:3|max:100',
        'message' => 'required|string|min:3|max:1000',
    ];

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function send(): void
    {
        $validatedData = $this->validate();
        try {
            Mail::to('jurajlopusek@gmail.com')->send(new ContactUsMail($validatedData));
            Session()->flash('success', 'Your message has been sent.');
        } catch (\Exception $exception) {
            Session()->flash('error', $exception->getMessage());
        }
        $this->reset();
    }

    public function render()
    {
        return view('livewire.contakt-form');
    }
}
