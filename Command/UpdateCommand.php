<?php

namespace FL\WorldUniversitiesBundle\Command;

use FL\WorldUniversitiesBundle\DependencyInjection\FlWorldUniversitiesExtension;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class UpdateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('fl:world-universities:update')
            ->setDescription('Updates the world universities CSV file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $config = $this->getContainer()->getParameter(FlWorldUniversitiesExtension::CONFIG_KEY);

        $output->writeln(sprintf('Downloading %s... ', $config['source']));

        $io = new SymfonyStyle($input, $output);

        $tmpFile = $this->downloadFile($config['source']);
        if (false === $tmpFile) {
            $io->error('Error during file download occurred');

            return;
        }

        if (file_exists($config['path'])) {
            chmod($config['path'], 0777);
        } else {
            mkdir($config['path'], 0777, true);
        }

        if ((@rename($tmpFile, $config['pathname']))) {
            $io->success('Update completed');
        } else {
            $io->error('Update failed');
        }
    }

    /**
     * @param string $source
     *
     * @return null|string
     */
    private function downloadFile($source)
    {
        $tmpFile = tempnam(sys_get_temp_dir(), 'fl_world_universities');
        if (strpos($source, '.csv') !== false) {
            @rename($tmpFile, $tmpFile.'.csv');
            $tmpFile .= '.csv';
        }

        if (!@copy($source, $tmpFile)) {
            return;
        }

        return $tmpFile;
    }
}
