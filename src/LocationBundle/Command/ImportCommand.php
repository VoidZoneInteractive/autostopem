<?php

namespace LocationBundle\Command;
use Doctrine\ORM\EntityManager;
use LocationBundle\Entity\City;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Routing\Router;


class ImportCommand extends ContainerAwareCommand
{

    /** @var OutputInterface $output */
    private $output;
    /** @var EntityManager $em */
    protected $em;
    /** @var  Router */
    protected $router;

    /**
     * @var string
     */
    protected $type;

    protected function configure()
    {
        $this->setName('location:import')
            ->setDescription(
                'Import data to Cities, Provinces, Countries and so on.'
            )
            ->addOption(
                'type',
                null,
                InputOption::VALUE_REQUIRED
            );
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->type = $input->getOption('type');
        $this->output = $output;
        $this->em = $this->getContainer()->get('doctrine')->getManager();
//        $this->notification_helper = $this->getContainer()->get('webgears.notification.helper');
        $this->router = $this->getContainer()->get('router');

        switch ($this->type) {
            default:
                $this->performCityImport();
                break;
        }
    }

    private function performCityImport()
    {
        $filename = '';

        $finder = new Finder();
        $finder->files()->name('city*.csv')->in('./assets');

        foreach ($finder as $file) {

            $filename = $file->getFilename();
            $filepath = $file->getRealpath();

            if (preg_match('/^city_list_([a-z]{2,2})_([a-z]{2,2})\.csv$/', $filename, $matches)) {
                $country = $matches[1];
                $locale = $matches[2];

                $fh = fopen($filepath, 'r');

                // skip first
                fgetcsv($fh, 2000, ',');

                $repository = $this->em->getRepository('Gedmo\Translatable\Entity\Translation');

                while($data = fgetcsv($fh, 2000, ',')) {
                    $city = new City();
                    $city->setLatitude(0);
                    $city->setLongitude(0);

                    $repository->translate($city, 'name', $locale, $data[0]);
                    $this->em->persist($city);
                }

                $this->em->flush();
            }
        }
    }
}