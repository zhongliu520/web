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

            $rows = file_get_contents($url);

            preg_match_all("/<img([^\<\>]*?)src=[\"\'](.*?)[\"\']([^\<\>]*?)>/", $rows, $arr);

            $rows = $arr[2];
            $rowsCollect = collect($rows);
            $rowsCollect->map(function ($item, $key) {
                if(json_encode($item)) {
                    logger('App\Console\Commands\DownloadFile', [$item]);
                    $downloadFile = new \App\Services\Common\DownloadFile();
                    $downloadFile->down_images($item, (intval($key)+1), "my/img/");
                }
            });

        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
        $this->info("下载成功!");
    }
}
