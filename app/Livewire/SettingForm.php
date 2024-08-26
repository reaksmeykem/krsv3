<?php

namespace App\Livewire;

use Livewire\Component;
use Mary\Traits\Toast;
use App\Models\Setting;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class SettingForm extends Component
{

    use WithFileUploads;
    use WithPagination;
    use Toast;

    public string $search = '';

    public bool $drawer = false;
    public bool $settingModal = false;
    public bool $settingModalConfirm = false;

    public array $sortBy = ['column' => 'key', 'direction' => 'asc'];

    public int $settingId = 0;
    public $key;
    public $value;
    public $description;
    public $category;
    public $file;
    public bool $editing = false;
    public $type;

    public function openModal(){
        $this->resetFields();
        $this->settingModal = true;
    }

    public function closeModal(){
        $this->settingModal = false;
        $this->resetFields();
    }

    public function resetFields(){
        $this->key = '';
        $this->value = '';
        $this->description = '';
        $this->settingId = 0;
        $this->file = null;
        $this->category = '';
        $this->editing = false;
        $this->type = '';
    }

    // Reset pagination when any component property changes
    public function updated($property): void
    {
        if (! is_array($property) && $property != "") {
            $this->resetPage();
        }
    }

    protected $rules = [
        'key' => 'required|unique:settings',
    ];

    public function create(){

        $this->validate();

        $filePath = null;
        if ($this->file && $this->file instanceof \Illuminate\Http\UploadedFile) {
            $fileName = time() . '_' . $this->file->getClientOriginalName();
            $filePath = $this->file->storeAs('public/settings', $fileName);
        }

        Setting::create([
            'key' => $this->key,
            'value' => $this->value,
            'description' => $this->description,
            'category' => $this->category,
            'file' => $filePath,
            'type' => $this->type
        ]);


        $this->closeModal();
        $this->resetFields();
        $this->success("Setting created successfully", position: 'toast-bottom');
    }

    // Clear filters
    public function clear(): void
    {
        $this->reset();
        $this->success('Filters cleared.', position: 'toast-bottom');
    }

    public function edit($id)
    {
        $this->settingModal = true;
        $this->editing = true;
        $setting = Setting::find($id);
        $this->settingId = $setting->id;
        $this->key = $setting->key;
        $this->value = $setting->value;
        $this->description = $setting->description;
        $this->category = $setting->category;
        $this->type = $setting->type;
        $this->file = Storage::url($setting->file);

    }

    public function update(){

        $this->validate([
            'key' => 'required',
        ]);

        $setting = Setting::find($this->settingId);

        $filePath = $setting->file;

        if ($this->file && $this->file instanceof \Illuminate\Http\UploadedFile) {
            if ($setting->file && Storage::exists($setting->file)) {
                Storage::delete($setting->file);
            }
            $fileName = time() . '_' . $this->file->getClientOriginalName();
            $filePath = $this->file->storeAs('public/settings', $fileName);
        }

        $setting->update([
            'key' => $this->key,
            'value' => $this->value,
            'description' => $this->description,
            'category' => $this->category,
            'file' => $filePath,
            'type' => $this->type
        ]);

        $this->closeModal();
        $this->resetFields();
        $this->success("Setting updated successfully", position: 'toast-bottom');

    }

    // Table headers
    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'file', 'label' => 'File', 'class' => 'w-32'],
            ['key' => 'key', 'label' => 'Key', 'class' => 'w-64'],
            ['key' => 'value', 'label' => 'Value', 'class' => 'w-64'],
            ['key' => 'description', 'label' => 'Description'],
            ['key' => 'type', 'label' => 'Type'],


            // ['key' => 'email', 'label' => 'E-mail', 'sortable' => false],
        ];
    }

    public function settings(): LengthAwarePaginator
    {

        return Setting::query()
            ->when($this->search, function (Builder $q) {
                $q->where('key', 'like', "%{$this->search}%");
            })
            ->orderBy('id', 'desc')
            ->orderBy($this->sortBy['column'], $this->sortBy['direction'])
            ->paginate(5);
    }

    // public function render()
    // {
    //     return view('livewire.category-form', [
    //         'categories' => $this->categories(),
    //         'parentCategories' => $this->parentCategories(),
    //         'headers' => $this->headers(),
    //     ]);
    // }

    public function render()
    {
        return view('livewire.setting-form', [
            'settings' => $this->settings(),
            // 'parentCategories' => $this->parentCategories(),
            'headers' => $this->headers(),
        ]);
    }
}
