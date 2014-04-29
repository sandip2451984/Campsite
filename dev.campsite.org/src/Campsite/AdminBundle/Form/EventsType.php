<?php

namespace Campsite\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Campsite\AdminBundle\Entity\Event;
class EventsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add( 'userId','text', array('read_only'=> true))
            ->add('name')
            ->add('description')
            ->add('fromDate')
            ->add('toDate')
            ->add('isActive')
            ->add('address')
            ->add('city')
            ->add('state')
            ->add('zipcode')
            ->add('country', 'text',array('attr'=> array('id'=>'autocomplete')))
            ->add('createdat')
            ->add('updatedat')
        ;
    }


  /**
   * 
   * get default options
   *
   * @param Array $options FormOptions
   *
   * @see Symfony\Component\Form.AbstractType::getDefaultOptions()
   * @return Array
   */
  public function getDefaultOptions(array $options)
  {
    return array(
      'csrf_protection' => false,
    );
  }

    public function getName()
    {
        return 'campsite_adminbundle_eventstype';
    }
}
