<?php

namespace App\Livewire;

use App\Models\Site\Contact;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name = '';
    
    public string $email = '';
    
    public string $message = '';
    
    public function save() : void
    {
        $this->validate();
        
        Contact::create(
            $this->only(['name', 'email', 'message'])
        );
        
        session()->flash('status', "Thanks, $this->name! I\'ll get back to you soon.");
        
        $this->reset();
    }
    
    public function render() : View|Factory|Application
    {
        return view('livewire.contact-form');
    }
    
    public function rules() : array
    {
        return [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email:rfc,dns'],
            'message' => ['required', 'max:5000'],
        ];
    }
}
