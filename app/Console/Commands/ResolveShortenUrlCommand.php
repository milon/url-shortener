<?php

namespace App\Console\Commands;

use App\Contracts\UrlShortenerContract;
use Illuminate\Console\Command;

class ResolveShortenUrlCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'url:resolve {hash : Hash of the shorten url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the original URL from a hash.';

    /**
     * @var UrlShortenerContract
     */
    protected $urlShortener;

    /**
     * Create a new command instance.
     *
     * @param UrlShortenerContract $urlShortener
     */
    public function __construct(UrlShortenerContract $urlShortener)
    {
        $this->urlShortener = $urlShortener;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $hash = $this->argument('hash');

        $link = $this->urlShortener->byHash($hash);

        if (! $link) {
            $this->error('No Url found for this hash.');

            return 1;
        }

        $this->info('Hashed URL resolved successfully');
        $this->info("Hash: {$link->hash}");
        $this->info("URL: {$link->url}");

        return 0;
    }
}
