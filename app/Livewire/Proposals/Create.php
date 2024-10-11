<?php

namespace App\Livewire\Proposals;

use App\Models\Project;
use App\Models\Proposal;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
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

        $proposal = $this->project->proposals()->updateOrCreate(
            ['email' => $this->email],
            ['hours' => $this->hours]
        );

        $this->arrangePositions($proposal);

        $this->dispatch('proposal::created');

        $this->modal = false;
    }

    public function arrangePositions(object $proposal): void
    {

        $query = DB::select("
            SELECT *, row_number() over (order by hours asc) as newPosition
            FROM proposals
            WHERE project_id = :project_id
        ", ['project_id' => $proposal->project_id]);

        $position = collect($query)->where('id', '=', $proposal->id);

        $otherProposal = collect($query)->where('position', '=', $proposal->newPosition)->first();

        if ($otherProposal){
            $proposal->update(['position_status' => 'up']);
            Proposal::query()->where('id', '=', $otherProposal->id)->update(['position_status' => 'down']);
        }


    }
}
