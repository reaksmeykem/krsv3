<?php

namespace App\Livewire\Dashboard\Book;

use Livewire\Component;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use Illuminate\Support\Facades\Storage;
class Create extends Component
{

    use WithFileUploads;
    use LivewireAlert;

    public $editing = false;
    public $categories;
    public $users;
    public $title,
    $slug,
    $author,
    $publication_date,
    $pdf_path,
    $cover_image_path,
    $isbn, $language,
    $publisher,
    $genre,
    $page_count,
    $bookId,
    $price,
    $category,
    $state,
    $description;

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

        $this->alert('success','Book created successfully', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => null,
        ]);

        return redirect()->back();


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
        $this->editing = true;
    }

    public function update()
    {
        $this->validate();

        $book = Book::findOrFail($this->bookId);

        if ($this->pdf_path) {
            $pdfPath = $this->pdf_path->store('books/pdf', 's3');
            $book->pdf_path = Storage::disk('s3')->url($pdfPath);
        }

        if ($this->cover_image_path) {
            $coverImagePath = $this->cover_image_path->store('books/covers', 's3');
            $book->cover_image_path = Storage::disk('s3')->url($coverImagePath);
        }

        $book->update([
            'title' => $this->title,
            'slug' => $this->slug,
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
        ]);

        $this->resetFields();

        $this->alert('success', 'Book updated successfully', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => null,
        ]);

        return redirect()->route('book.index');

    }


    public function mount(){
        $this->categories = Category::latest()->get();
        $this->users = User::latest()->get();
    }
    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }
    public function render()
    {
        return view('livewire.dashboard.book.create')
        ->extends('dashboard.master')
        ->section('content');
    }
}
