<?php
/**
 * Created by PhpStorm.
 * User: kukolos
 * Date: 11/9/2017
 * Time: 3:39 PM
 */

namespace MayMeow\Cloud\Sockets\Actions\Security;

use MayMeow\Cloud\Sockets\Actions\AbstractAction;
use MayMeow\Cloud\Sockets\Actions\ActionInterface;
use Symfony\Component\Filesystem\Filesystem;
use MayMeow\Cloud\Sockets\Log;
use Symfony\Component\Process\Process;

class WriteKeysAction extends AbstractAction implements ActionInterface
{
    const SSH_HOME_PATH = '/var/opt/cakeapp/data/git-data/.ssh';
    /**
     *
     */
    protected function configure()
    {
        $this
            ->setName('security:write:keys');
    }

    public function response($options = null)
    {
        $keysString = '';

        foreach ($options->keys as $key => $value) {
            $keysString .= 'command="' . $options->ssh_exec . ' key-' . $value->id . '",no-port-forwarding,no-x11-forwarding,no-agent-forwarding,no-pty ' . $value->public_key . "\n";
        }

        $fs = new Filesystem();
        if (!$fs->exists($options->path)) $fs->mkdir($options->path, 0755);

        Log::show('Writing authorized_keys for git user to ' . $options->path);
        file_put_contents($options->path . 'authorized_keys', $keysString);

        // HADRCODED TOTO to change it
        Log::show("chown -R git " . $options->path);
        $process = new Process("chown -R git " . $options->path);
        $process->start();
        while ($process->isRunning()) {
            // waiting for process to finish
        }
    }
}
