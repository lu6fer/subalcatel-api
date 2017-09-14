<?php

namespace Api\Articles\Console;

use Api\Articles\Repositories\ArticleRepository;
use Api\Users\Services\UserService;
use Illuminate\Console\Command;

class AddArticleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:add {userSlug} {title} {body} {status}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds a new article';

    /**
     * User repository to persist user in database
     *
     * @var ArticleRepository
     */
    protected $articleRepository;

    /**
     * Create a new command instance.
     *
     * @param  ArticleRepository  $articleRepository
     * @return void
     */
    public function __construct(
        ArticleRepository $articleRepository,
        UserService $userService
    )
    {
        parent::__construct();

        $this->articleRepository = $articleRepository;
        $this->userService = $userService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = $this->userService->getbySlug($this->argument('userSlug'));
        $article = $this->articleRepository->create(
            $user,
            [
                'title' => $this->argument('title'),
                'body' => $this->argument('body'),
                'status' => $this->argument('status')
            ]
        );

        $this->info(sprintf('A article was created with ID %s', $user->id));
    }
}