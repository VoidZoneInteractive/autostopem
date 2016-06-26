<?php

namespace CoreBundle\Form\Type;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TranslationType extends AbstractType
{
    /**
     * @var Registry
     */
    private $doctrine;

    /**
     * @var array
     */
    private $formTranslations;

    /**
     * @param Registry $doctrine
     * @param $formTranslations
     */
    public function __construct(Registry $doctrine, $formTranslations)
    {
        $this->doctrine = $doctrine;
        $this->formTranslations = $formTranslations;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'translations' => array(),
            'locales' => $this->formTranslations
        ));
    }

    public function getParent()
    {
        return TextType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $em = $this->doctrine->getManager();
        $entity = $form->getParent()->getData();


        $repository = $em->getRepository('Gedmo\Translatable\Entity\Translation');

        $translations = array();

        if ($entity && null !== $entity->getId()) {
            $translations = $repository->findTranslations($entity);
        }

        $view->vars['locales'] = $options['locales'];
        $view->vars['translations'] = $translations;
    }
}