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

    /**
     * @var array<string, string>
     */
    protected array $messages = [
        'name.required' => 'Zadajte svoje meno.',
        'name.string' => 'Meno musí byť text.',
        'name.min' => 'Meno musí mať aspoň :min znaky.',
        'name.max' => 'Meno môže mať najviac :max znakov.',
        'email.required' => 'Zadajte e-mailovú adresu.',
        'email.email' => 'Zadajte platnú e-mailovú adresu.',
        'email.min' => 'E-mail musí mať aspoň :min znaky.',
        'email.max' => 'E-mail môže mať najviac :max znakov.',
        'message.required' => 'Napíšte nám správu.',
        'message.string' => 'Správa musí byť text.',
        'message.min' => 'Správa musí mať aspoň :min znaky.',
        'message.max' => 'Správa môže mať najviac :max znakov.',
        'photo.max' => 'Príloha môže mať najviac 1 MB.',
        'photo.uploaded' => 'Prílohu sa nepodarilo nahrať.',
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
                $session->flash('success', 'Správa bola odoslaná.');
                Storage::disk('public')->delete("attachments/$this->photoName");

            }
        } catch (Exception $exception) {
            if ($session) {
                report($exception);
                $session->flash('error', 'Správu sa nepodarilo odoslať. Skúste to prosím znova alebo nás kontaktujte telefonicky.');
            }
        }
        $this->reset();
    }

    public function render(): View
    {
        return view('livewire.contakt-form');
    }
}
