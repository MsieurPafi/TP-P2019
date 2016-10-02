<?php
namespace AppBundle\Form\Type;

use AppBundle\Entity\Subject;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class SubjectType extends AbstractType
{
    //Create the question creation form
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('title', null, array(
                'required' => 'true',
                'attr' => array('class' => 'subjectTitle', 'placeholder' => 'My code doesn\'t work :\'(', 'height' => 15),
                'label' => 'Title'
            ))
            ->add('description', null, array(
                'required' => 'true',
                'attr' => array('class' => 'replyResponse', 'cols' => 40, 'placeholder' => 'Blabla...'),
                'label' => 'Your response'
            ))
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Subject::class,
            'method' => 'POST'
        ));
    }
}