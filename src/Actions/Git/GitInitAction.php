<?php

namespace MayMeow\Cloud\Sockets\Actions\Git;

use GitElephant\GitBinary;
use GitElephant\Repository;
use MayMeow\Cloud\Sockets\Actions\AbstractAction;
use MayMeow\Cloud\Sockets\Actions\ActionInterface;
use Symfony\Component\Filesystem\Filesystem;
use MayMeow\Cloud\Sockets\Log;
use Symfony\Component\Process\Process;


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

        //print_r($data);

        $fs = new Filesystem();
        if (!$fs->exists($data->path)) $fs->mkdir($data->path);

        $repo = new Repository($data->path, new GitBinary('git'));
        $repo->init(true);

        $this->createHooks($data->hooks, $data->path);

        // HADRCODED TOTO to change it
        Log::show("chown -R 1000 /var/opt/gitcity/git-data/");
        $process = new Process("chown -R 1000 /var/opt/gitcity/git-data/");
        $process->start();
        while ($process->isRunning()) {
            // waiting for process to finish
        }

        return true;
    }

    public function createHooks($hooksPath, $repoPath)
    {
        //Log::show("rm -r $repoPath/hooks");
        $command = "ln -fs $hooksPath $repoPath";
        Log::show($command);

        $process = new Process($command);
        $process->start();
        while ($process->isRunning()) {
            // waiting for process to finish
        }

        Log::show($process->getOutput());
    }
}
