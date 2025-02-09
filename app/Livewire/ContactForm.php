<?php

namespace App\Livewire;

use App\Mail\ContactUsMail;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name;
    public string $email;
    public string $message;

    /**
     * @var array<string, string>
     */
    protected array $rules = [
        'name' => 'required|string|min:4|max:100',
        'email' => 'required|email|min:3|max:100',
        'message' => 'required|string|min:3|max:1000',
    ];

    public function updated(string $propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function send(): void
    {
        $session = Session();
        $validatedData = $this->validate();
        try {
            Mail::to('jurajlopusek@gmail.com')->send(new ContactUsMail($validatedData));
            if ($session) {
                $session->flash('success', 'Your message has been sent.');
            }
        } catch (Exception $exception) {
            if ($session) {
                $session->flash('error', $exception->getMessage());
            }
        }
        $this->reset();
    }

    public function render(): View
    {
        return view('livewire.contakt-form');
    }
}
