<?php

namespace App\Http\Controllers;

use App\Mail\Report;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use App\Mail\ReportPost;
use App\Repositories\Post\PostRepository;
use App\Repositories\Post\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Repositories\SendMail\SendMailRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

class SendMailController extends Controller
{
    protected $postRepo;
    protected $userRepo;

    public function __construct(PostRepositoryInterface $postRepo, UserRepositoryInterface $userRepo)
    {
        $this->postRepo = $postRepo;
        $this->userRepo = $userRepo;
    }

    public function sendMail()
    {
        $users = $this->userRepo->getUserIsAdmin();
        $posts = $this->postRepo->getPostPending();

        foreach ($users as $user) {
            $mailable = new Report($user, $posts);
            Mail::to($user)->queue($mailable);
        }

        return true;
    }
}
