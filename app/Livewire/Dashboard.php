<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Models\Tag;
use App\Models\PageVisit;

class Dashboard extends Component
{

    public $countPost;
    public $countCategory;
    public $countUser;
    public $countTag;
    public function mount(){
        $this->countPost = Post::count();
        $this->countCategory = Category::count();
        $this->countUser = User::count();
        $this->countTag = Tag::count();

        // $this->countVisitorMonth = PageVisit::whereDate('created_at', today())->count();
        $countVisitorToday = PageVisit::whereDate('created_at', today())->count();
        $countVisitorYesterday = PageVisit::whereDate('created_at', now()->subDay()->toDateString())->count();
        $countVisitorThisMonth = PageVisit::whereMonth('created_at', now()->month)->count();
        $countVisitorThisYear = PageVisit::whereYear('created_at', now()->year)->count();


        $this->updateChartData();
    }

    public array $myChart = [
        'type' => 'bar',
        'data' => [
            'labels' => ['Today', 'Yesterday', 'This Month', 'This Year', 'Total Visitors'],
            'datasets' => [
                [
                    'label' => 'Visitors',
                    'data' => [],
                ]
            ]
        ]
    ];

    public function updateChartData()
    {
        $this->myChart['data']['datasets'][0]['data'] = [
            PageVisit::whereDate('created_at', today())->count(),
            PageVisit::whereDate('created_at', now()->subDay()->toDateString())->count(),
            PageVisit::whereMonth('created_at', now()->month)->count(),
            PageVisit::whereYear('created_at', now()->year)->count(),
            PageVisit::count()
            // Post::count(),
            // Category::count(),
            // Tag::count(),
            // PageVisit::whereMonth('created_at', now()->month)->count(),
        ];
    }


    public function render()
    {
        return view('livewire.dashboard');
    }
}
