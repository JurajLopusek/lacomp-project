<?php

namespace App\Livewire;

use Livewire\Component;

class Menu extends Component
{
    public $open = false;

    public function toggleMenu(): void
    {
        $this->open = !$this->open;
    }

    public function closeMenu(): void
    {
        $this->open = false;
    }
    public function render()
    {
        return view('livewire.menu');
    }
}
