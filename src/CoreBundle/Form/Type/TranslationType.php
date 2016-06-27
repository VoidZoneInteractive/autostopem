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
use Gedmo\Translatable\TranslatableListener;

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

    private $translatableListener;

    /**
     * @param Registry $doctrine
     * @param TranslatableListener $translatableListener
     * @param $formTranslations
     */
    public function __construct(Registry $doctrine, TranslatableListener $translatableListener, $formTranslations)
    {
        $this->doctrine = $doctrine;
        $this->formTranslations = $formTranslations;
        $this->translatableListener = $translatableListener;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $this->doctrine->getManager();

        $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function (FormEvent $event) use ($em) {
                $data = $event->getData();
                $entity = $event->getForm()->getParent()->getData();

                $repository = $em->getRepository('Gedmo\Translatable\Entity\Translation');

                foreach ($data as $locale => $value) {
                    if ($locale == $this->translatableListener->getDefaultLocale()) {
                        $event->setData($value);
                    } else {
                        $repository->translate($entity, $event->getForm()->getName(), $locale, $value);
                    }
                }
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'translations' => array(),
            'locales' => $this->formTranslations,
            'default_locale' => null,
            'label' => false,
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
        $view->vars['default_locale'] = $this->translatableListener->getDefaultLocale();
    }
}