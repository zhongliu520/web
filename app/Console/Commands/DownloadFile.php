<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Exception;

class DownloadFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download:file {url=null}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'download file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = $this->argument('url');

        try {

            $downloadFile = new \App\Services\Common\DownloadFile();
            logger($url);
            $downloadFile->down_images($url, "11342");
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
        $this->info("下载成功!");
    }
}
