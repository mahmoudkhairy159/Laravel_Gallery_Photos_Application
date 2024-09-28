<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\CollaborationMessage;
use App\Repositories\CategoryRepository;
use App\Repositories\CollaborationMessageRepository;
use App\Repositories\ContactMessageRepository;
use App\Repositories\DashboardRepository;
use App\Repositories\JobOpeningRepository;
use App\Repositories\TaskRepository;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $_config;
    protected $DashboardRepository;
    protected $taskRepository;
    protected $categoryRepository;

    public function __construct(DashboardRepository $DashboardRepository,TaskRepository $taskRepository,CategoryRepository $categoryRepository)
    {
        $this->_config = request('_config');
        $this->middleware('auth');
        $this->DashboardRepository = $DashboardRepository;
        $this->taskRepository = $taskRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $statisticsCount = $this->DashboardRepository->getStatisticsCount();
        $userId=auth()->id();
        $items = $this->taskRepository->getByUserId($userId)->paginate();
        $categories = $this->categoryRepository->getByUserId($userId)->get();
        return view($this->_config['view'], compact('statisticsCount','items','categories'));
    }
}
