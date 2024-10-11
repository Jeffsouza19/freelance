<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class Proposal extends Component
{
    public Project $project;
    public int $qtd = 5;

    #[On('proposal::created')]
    public function render(): View|Factory|Application
    {
        return view('livewire.projects.proposal');
    }

    #[Computed]
    public function proposals(): Paginator
    {
        return $this->project->proposals()
            ->orderBy('hours')
            ->paginate($this->qtd);
    }

    public function loadMore(): void
    {
        $this->qtd += 5;
    }

    #[Computed]
    public function lastProposalTime()
    {
        return $this->project->proposals()->latest()->first()->updated_at->diffForHumans();
    }
}
