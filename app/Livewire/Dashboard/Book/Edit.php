<?php

namespace App\Livewire\Dashboard\Book;

use Livewire\Component;

use App\Models\Book;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Edit extends Component
{

    use WithFileUploads;
    use LivewireAlert;

    public $bookId;
    public $title;
    public $slug;
    public $author;
    public $publication_date;
    public $pdf_path;
    public $cover_image_path;
    public $isbn;
    public $language;
    public $publisher;
    public $genre;
    public $page_count;
    public $price;
    public $category;
    public $state;
    public $description;
    public $categories;

    protected $rules = [
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'publication_date' => 'required|date',
        'pdf_path' => 'nullable|file|mimes:pdf|max:10240', // Max 10MB
        'cover_image_path' => 'nullable|image|max:10240', // Max 10MB
        'isbn' => 'nullable|string|max:13',
        'language' => 'nullable|string|max:255',
        'publisher' => 'nullable|string|max:255',
        'page_count' => 'nullable|integer',
        'price' => 'nullable|numeric',
        'category' => 'nullable|integer|exists:categories,id',
    ];

    public function mount($bookId)
    {
        $this->bookId = $bookId;
        $this->loadBook();
        $this->categories = Category::latest()->get();
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
    }
    public function loadBook()
    {
        $book = Book::findOrFail($this->bookId);
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

    }

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function save()
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

        return redirect()->route('book.index');// To return to the list view
    }

    public function cancel()
    {
        $this->emit('editBook', null); // To return to the list view
    }

    public function render()
    {
        return view('livewire.dashboard.book.edit');
    }
}
