<?php

namespace Campsite\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GroupsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add( 'userId','text', array('read_only'=> true))
           // ->add('community','text',array('read_only'=>true))
            ->add('city')
            ->add('location')
            ->add('isActive')
            ->add('createdat')
            ->add('updatedat')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Campsite\AdminBundle\Entity\Groups'
        ));
    }

    public function getName()
    {
        return 'campsite_adminbundle_groupstype';
    }
}
