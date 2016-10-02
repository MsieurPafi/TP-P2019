<?php
namespace AppBundle\Form\Type;

use AppBundle\Entity\Reply;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ReplyType extends AbstractType
{
    //Create the reply form
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('author', null, array(
                'attr' => array('class' => 'replyAuthor', 'placeholder' => 'John Doe', 'height' => 15),
                'label' => 'Author'
            ))
            ->add('email', EmailType::class, array(
                'label' => 'Email',
                'attr' => array('placeholder' => 'proutprout@roger.fr')
            ))
            ->add('replyText', null, array(
                'required' => 'true',
                'attr' => array('class' => 'replyResponse', 'cols' => 40, 'placeholder' => 'Blabla...'),
                'label' => 'Your response'
            ))
        ;

    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Reply::class,
            'method' => 'POST'
        ));
    }
}