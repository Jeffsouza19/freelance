<?php

namespace App\Livewire\Proposals;

use App\Models\Project;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Create extends Component
{

    public Project $project;
    public bool $modal = false;

    #[Rule(['required', 'email'])]
    public string $email = '';

    #[Rule(['required', 'numeric', 'gt:0'])]
    public int $hours = 0;

    public bool $agree = false;

    public function render(): View|Factory|Application
    {
        return view('livewire.proposals.create');
    }

    public function save(): void
    {

        $this->validate();
        if (!$this->agree) {
            $this->addError('agree','Você precisa concordar antes de prosseguir.');
            return;
        }

        $this->project->proposals()->updateOrCreate(
            ['email' => $this->email],
            ['hours' => $this->hours]
        );

        $this->dispatch('proposal::created');

        $this->modal = false;
    }
}
