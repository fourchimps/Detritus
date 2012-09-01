<?php

namespace FourChimps\AdminBundle\Command;

use Doctrine\Bundle\DoctrineBundle\Mapping\MetadataFactory;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Sensio\Bundle\GeneratorBundle\Command\Helper\DialogHelper;
use Sensio\Bundle\GeneratorBundle\Command\Validators;
use FourChimps\AdminBundle\Generator\NavigationGenerator;
use Doctrine\Bundle\DoctrineBundle\Mapping\DisconnectedMetadataFactory;


class GenerateNavigationCommand extends ContainerAwareCommand
{
//    public function isEnabled()
//    {
//        return class_exists('Doctrine\\Bundle\\DoctrineBundle\\DoctrineBundle');
//    }
//
//    protected function parseShortcutNotation($shortcut)
//    {
//        $entity = str_replace('/', '\\', $shortcut);
//
//        if (false === $pos = strpos($entity, ':')) {
//            throw new \InvalidArgumentException(sprintf('The entity name must contain a : ("%s" given, expecting something like AcmeBlogBundle:Blog/Post)', $entity));
//        }
//
//        return array(substr($entity, 0, $pos), substr($entity, $pos + 1));
//    }
//
//    protected function getEntityMetadata($entity)
//    {
//        $factory = new MetadataFactory($this->getContainer()->get('doctrine'));
//
//        return $factory->getClassMetadata($entity)->getMetadata();
//    }

    protected function configure() {
        $this
            ->setDefinition(array(
                    new InputOption('bundle', '', InputOption::VALUE_REQUIRED, 'The Bundle your adding the CRUD actions to'),
                    new InputOption('format', '', InputOption::VALUE_REQUIRED, 'Use the format for configuration files (php, xml, yml, or annotation)', 'annotation'),
                ))
                ->setDescription('Generates a Sidebar view template based on annotations in an entity')
                ->setHelp('some help text here'
            )
            ->setName('fourchimps:admin:generate:navigation');
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {

        $dialog = $this->getDialogHelper();
        $dialog->writeSection($output, 'Welcome to the FourChimps Admin Navigation generator');

        // namespace
        $output->writeln(array(
            '',
            'This command helps you generate a Navigation controllers and templates.',
            '',
            'First, you need to give the bundle that contains your entities.',
            '',
            'You must use the shortcut notation like <comment>AcmeBlogBundle</comment>.',
            '',
        ));

        // bundle
        $bundle = $input->getOption('bundle');
        $output->writeln(array(
            '',
            'The FourChimps Admin Navigation generator creates navigation based on entities in a host or target bundle.',
            '',
        ));
        $bundle = $dialog->askAndValidate(
            $output,
            $dialog->getQuestion('The Entity bundle', $bundle),
            array('Sensio\Bundle\GeneratorBundle\Command\Validators', 'validateBundleName'),
            false,
            $bundle
        );
        $input->setOption('bundle', $bundle);

        // format
        $format = $input->getOption('format');
        $output->writeln(array(
            '',
            'Determine the format to use for the generated CRUD.',
            '',
        ));
        $format = $dialog->askAndValidate(
            $output,
            $dialog->getQuestion('Configuration format (yml, xml, php, or annotation)', $format),
            array('Sensio\Bundle\GeneratorBundle\Command\Validators', 'validateFormat'),
            false,
            $format
        );
        $input->setOption('format', $format);


        // summary
        $output->writeln(array(
            '',
            $this->getHelper('formatter')->formatBlock('Summary before generation', 'bg=blue;fg=white', true),
            '',
            sprintf("You are going to generate a Navigation controller for Entities in \"<info>%s</info>\"", $bundle),
            sprintf("using the \"<info>%s</info>\" format.", $format),

            '',
        ));
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dialog = $this->getDialogHelper();

        if (!$dialog->askConfirmation($output, $dialog->getQuestion('Do you confirm generation', 'yes', '?'), true)) {
            $output->writeln('<error>Command aborted</error>');

            return 1;
        }

        $bundleName = Validators::validateBundleName($input->getOption('bundle'));
        $format = Validators::validateFormat($input->getOption('format'));

        $dialog->writeSection($output, 'Reading Annotations...');

        $bundle      = $this->getContainer()->get('kernel')->getBundle($bundleName);
        $metadata    = $this->getBundleMetadata($bundleName);

        $dialog->writeSection($output, 'Controller generation');

        $generator = $this->getGenerator();
        $generator->generate($bundle, $metadata, $format);

        $output->writeln('Generating the CRUD code: <info>OK</info>');

        $errors = array();
        $runner = $dialog->getRunner($output, $errors);

        // routing
        if ('annotation' != $format) {
            $runner($this->updateRouting($dialog, $input, $output, $bundle, $format));
        }

        $dialog->writeGeneratorSummary($output, $errors);
    }

    protected function getDialogHelper()
    {
        $dialog = $this->getHelperSet()->get('dialog');
        if (!$dialog || get_class($dialog) !== 'Sensio\Bundle\GeneratorBundle\Command\Helper\DialogHelper') {
            $this->getHelperSet()->set($dialog = new DialogHelper());
        }

        return $dialog;
    }

    protected function getGenerator() {
        $generator = new NavigationGenerator(
            $this->getContainer()->get('filesystem'),
            __DIR__ . '/../Resources/skeleton/crud');

        return $generator;
    }

    protected function getBundleMetadata($bundleName) {
        $manager = new DisconnectedMetadataFactory($this->getContainer()->get('doctrine'));

//        try {
            $bundle = $this->getApplication()->getKernel()->getBundle($bundleName);
            $metadata = $manager->getBundleMetadata($bundle);
//        } catch (\InvalidArgumentException $e) {
//            $name = strtr($bundleName, '/', '\\');
//
//            if (false !== $pos = strpos($name, ':')) {
//                $name = $this->getContainer()->get('doctrine')->getEntityNamespace(substr($name, 0, $pos)).'\\'.substr($name, $pos + 1);
//            }
//
//            if (class_exists($name)) {
//                $output->writeln(sprintf('Generating entity "<info>%s</info>"', $name));
//                $metadata = $manager->getClassMetadata($name, $input->getOption('path'));
//            } else {
//                $output->writeln(sprintf('Generating entities for namespace "<info>%s</info>"', $name));
//                $metadata = $manager->getNamespaceMetadata($name, $input->getOption('path'));
//            }
//        }

//        use Doctrine\Common\Annotations\AnnotationReader;
//        use Acme\DataBundle\Conversion\StandardObjectConverter;
//        use Acme\DataBundle\Entity\Person;
//
//        $reader = new AnnotationReader();
//        $converter = new StandardObjectConverter($reader);
//
//        $person = new Person();
//        $standardObject = $converter->convert($person);


        return $metadata;
    }
}
