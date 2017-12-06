<?php

namespace MayMeow\Cloud\Sockets\Actions\Git;

use GitElephant\GitBinary;
use GitElephant\Repository;
use MayMeow\Cloud\Sockets\Actions\AbstractAction;
use MayMeow\Cloud\Sockets\Actions\ActionInterface;
use Symfony\Component\Filesystem\Filesystem;
use MayMeow\Cloud\Sockets\Log;


class GitInitAction extends AbstractAction implements ActionInterface
{
     /**
     *
     */
    protected function configure()
    {
        $this
            ->setName('git:init:bare');
    }

    /**
     * @param null $what
     * @return string
     *
     * On input is simple string
     */
    public function response($data = null)
    {
        $command = 'git init --bare ' . $data->path;

        Log::show($command);

        $fs = new Filesystem();

        if (!$fs->exists($data->path)) $fs->mkdir($data->path);

        $repo = new Repository($data->path, new GitBinary('git'));
        $repo->init(true);

        return true;
    }
}
