<?php

namespace App\Console\Commands;

use App\Contracts\UrlShortenerContract;
use Illuminate\Console\Command;
use Validator;

class GenerateShortenUrlCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'url:short {url : The url you want to be shorten} {--hash= : Provide a custom hash}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a shorten URL';

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
        $url = $this->argument('url');
        $hash = $this->option('hash');

        $validator = Validator::make([
            'url' => $url,
            'hash' => $hash,
        ],
        [
            'url' => 'required|url',
            'hash' => 'nullable|unique:links,hash',
        ]);

        if ($validator->fails()) {
            $this->info('Links can\'t be shortened. See error messages below:');

            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return 1;
        }

        $shortenUrl = $this->urlShortener->make($url, $hash);

        $this->info('Url Shortened successfully');
        $this->info("URL: {$shortenUrl->url}");
        $this->info("Hash: {$shortenUrl->hash}");

        return 0;
    }
}
