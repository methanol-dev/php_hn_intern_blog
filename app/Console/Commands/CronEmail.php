<?php

namespace App\Console\Commands;

use App\Mail\Report;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\SendMailController;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

class CronEmail extends Command
{
    protected $postRepo;
    protected $userRepo;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'schedule task send email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(PostRepositoryInterface $postRepo, UserRepositoryInterface $userRepo)
    {
        parent::__construct();
        $this->postRepo = $postRepo;
        $this->userRepo = $userRepo;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
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
