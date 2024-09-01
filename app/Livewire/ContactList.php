<?php

namespace App\Livewire;

use Livewire\Component;
use Mary\Traits\Toast;
use Spatie\Permission\Models\Permission;

use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Contact;

class ContactList extends Component
{


    use WithFileUploads;
    use WithPagination;
    use Toast;

    public string $search = '';

    public bool $drawer = false;

    public array $sortBy = ['column' => 'email', 'direction' => 'asc'];

    public string $firstName;
    public string $lastName;
    public string $email;
    public string $phone;
    public $message;
    public bool $contactModal = false;


    public function openModal(){
        $this->resetFields();
        $this->contactModal = true;
    }

    public function closeModal(){
        $this->contactModal = false;
    }

    // Reset pagination when any component property changes
    public function updated($property): void
    {
        if (! is_array($property) && $property != "") {
            $this->resetPage();
        }
    }

    public function show($id)
    {
        $this->contactModal = true;
        $contact = Contact::find($id);
        $this->firstName = $contact->first_name;
        $this->lastName = $contact->last_name;
        $this->email = $contact->email;
        $this->phone = $contact->phone;
        $this->message = $contact->message;
    }


    // Table headers
    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'first_name', 'label' => 'First Name', 'class' => 'w-64'],
            ['key' => 'last_name', 'label' => 'Last Name', 'class' => 'w-64'],
            ['key' => 'email', 'label' => 'Email', 'class' => 'w-64'],
            ['key' => 'phone', 'label' => 'Phone', 'class' => 'w-64'],
            ['key' => 'message', 'label' => 'Message', 'class' => 'w-64'],
        ];
    }

    public function contacts(): LengthAwarePaginator
    {

        return Contact::query()
            ->when($this->search, function (Builder $q) {
                $q->where('email', 'like', "%{$this->search}%");
            })
            ->orderBy('id', 'desc')
            ->orderBy($this->sortBy['column'], $this->sortBy['direction'])
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.contact-list', [
            'contacts' => $this->contacts(),
            'headers' => $this->headers(),
        ]);
    }
}
