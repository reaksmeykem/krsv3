<?php

namespace App\Livewire\Dashboard\Book;

use Livewire\Component;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;

class Index extends Component
{

    use WithFileUploads;
    use LivewireAlert;

    public $books;
    public $categories;
    public $users;
    public $title,
    $bookId,
    $slug,
    $author,
    $publication_date,
    $pdf_path,
    $cover_image_path,
    $isbn, $language,
    $publisher,
    $genre,
    $page_count,
    $exist_cover_image_path,
    $price,
    $category,
    $state,
    $description,
    $editing = false;


    public $isOpen = false;


    public function openModal()
    {
        $this->isOpen = true;

    }

    public function closeModal()
    {
        $this->resetFields();
        $this->isOpen = false;

    }

    public function mount(){
        $this->books = Book::latest()->get();
        $this->categories = Category::latest()->get();
        $this->users = User::latest()->get();
    }

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }
    // public function edit($id){
    //     $this->editing = true;
    //     $this->bookId = $id;
    // }

    protected $rules = [
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:books,slug',
        'author' => 'required|string|max:255',
        'publication_date' => 'required|date',
        'pdf_path' => 'file|mimes:pdf|max:10240', // Max 10MB
        'cover_image_path' => 'image|max:10240', // Max 10MB
        'isbn' => 'string|max:13',
        'language' => 'string|max:255',
        'publisher' => 'string|max:255',
        'page_count' => 'integer',
        'price' => 'numeric',
        'category' => 'nullable|integer|exists:categories,id',
    ];

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('books')->ignore($this->bookId),
            ],
            'author' => 'required|string|max:255',
            'publication_date' => 'required|date',
            'pdf_path' => 'nullable|file|mimes:pdf|max:10240', // Max 10MB
            'cover_image_path' => 'nullable|image|max:10240', // Max 10MB
            'isbn' => 'string|max:13',
            'language' => 'string|max:255',
            'publisher' => 'string|max:255',
            'page_count' => 'integer',
            'price' => 'numeric',
            'category' => 'nullable|integer|exists:categories,id',
        ];
    }

    public function resetFields()
    {
        $this->title = '';
        $this->slug = '';
        $this->author = '';
        $this->publication_date = '';
        $this->pdf_path = null;
        $this->cover_image_path = null;
        $this->isbn = '';
        $this->language = '';
        $this->publisher = '';
        $this->genre = '';
        $this->page_count = '';

        $this->price = '';
        $this->category = '';
        $this->state = '';
        $this->description = '';
        $this->editing = false;
    }

    public function save(){
        if($this->editing){
            $this->update();
        }else{
            $this->create();
        }
    }

    public function create(){
        $this->validate();

        $pdfPath = $this->pdf_path->store('books/pdf', 's3');
        $coverImagePath = $this->cover_image_path->store('books/covers', 's3');

        $book = Book::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'author' => $this->author,
            'publication_date' => $this->publication_date,
            'pdf_path' => Storage::disk('s3')->url($pdfPath),
            'cover_image_path' => Storage::disk('s3')->url($coverImagePath),
            'isbn' => $this->isbn,
            'language' => $this->language,
            'publisher' => $this->publisher,
            'genre' => $this->genre,
            'page_count' => $this->page_count,

            'price' => $this->price,
            'category_id' => $this->category,
            'state' => $this->state,
            'description' => $this->description,
        ]);

        $this->resetFields();
        $this->mount();
        $this->closeModal();

        $this->alert('success','Book created successfully', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => null,
        ]);


    }

    public function edit($bookId){
        $this->resetFields();

        $book = Book::findOrFail($bookId);
        $this->bookId = $book->id;
        $this->title = $book->title;
        $this->slug = $book->slug;
        $this->author = $book->author;
        $this->publication_date = $book->publication_date;
        $this->isbn = $book->isbn;
        $this->language = $book->language;
        $this->publisher = $book->publisher;
        $this->genre = $book->genre;
        $this->page_count = $book->page_count;
        $this->price = $book->price;
        $this->category = $book->category_id;
        $this->state = $book->state;
        $this->description = $book->description;
        $this->exist_cover_image_path = $book->cover_image_path;
        $this->editing = true;

        $this->openModal();
    }

    public function update()
    {
        $this->validate();

        $book = Book::findOrFail($this->bookId);

        if ($this->pdf_path) {
            $pdfPath = $this->pdf_path->store('books/pdf', 's3');
            $this->pdf_path = Storage::disk('s3')->url($pdfPath);
        }else{
            $this->pdf_path = $book->pdf_path;
        }

        if ($this->cover_image_path) {
            $coverImagePath = $this->cover_image_path->store('books/covers', 's3');
            $this->cover_image_path = Storage::disk('s3')->url($coverImagePath);
        }else{
            $this->cover_image_path = $book->cover_image_path;
        }

        $book->update([
            'title' => $this->title,
            'author' => $this->author,
            'publication_date' => $this->publication_date,
            'isbn' => $this->isbn,
            'language' => $this->language,
            'publisher' => $this->publisher,
            'genre' => $this->genre,
            'page_count' => $this->page_count,
            'price' => $this->price,
            'category_id' => $this->category,
            'state' => $this->state,
            'description' => $this->description,
            'cover_image_path' => $this->cover_image_path,
            'pdf_path' => $this->pdf_path,
        ]);

        $this->resetFields();
        $this->mount();
        $this->closeModal();

        $this->alert('success', 'Book updated successfully', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => null,
        ]);


    }


    public function render()
    {
        return view('livewire.dashboard.book.index')
        ->extends('dashboard.master')
        ->section('content');
    }
}
