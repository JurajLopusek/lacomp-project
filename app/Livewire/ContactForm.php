<?php

namespace App\Livewire;

use App\Mail\ContactUsMail;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ContactForm extends Component
{
    use WithFileUploads;

    public string $name;
    public string $email;
    public string $message;
    public $photo;
    public $photoName;

    /**
     * @var array<string, string>
     */
    protected array $rules = [
        'name' => 'required|string|min:4|max:100',
        'email' => 'required|email|min:3|max:100',
        'message' => 'required|string|min:3|max:1000',
        'photo' => 'nullable|max:1024',
    ];

    public function updatedPhoto(): void
    {
        $this->photoName = $this->photo->getClientOriginalName();
    }

    public function updated(string $propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function send(): void
    {
        $session = Session();
        $validatedData = $this->validate();
        $attachmentPath = null;
        if ($this->photo) {
            Storage::disk('public')->putFileAs('attachments', $this->photo, $this->photoName);
            $attachmentPath = "attachments/$this->photoName";
        }
        try {
            Mail::to('lacomp@lacomp.sk')->send(new ContactUsMail($validatedData, $attachmentPath));
            if ($session) {
                $session->flash('success', 'Your message has been sent.');
                Storage::disk('public')->delete("attachments/$this->photoName");

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
