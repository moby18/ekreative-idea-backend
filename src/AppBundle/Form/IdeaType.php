<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class IdeaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description',null,[
                'required' => true
            ])
            ->add('price',null,[
                'required' => false
            ])
            ->add('category',null,[
                'required' => false
            ])
//            ->add('comments',null,[
//                'required' => false
//            ])
//            ->add('likes',null,[
//                'required' => false
//            ])
//            ->add('dislikes',null,[
//                'required' => false
//            ])
            ->add('status',null,[
                'required' => false
            ])
//            ->add('video',null,[
//                'required' => false
//            ])
//            ->add('audio',null,[
//                'required' => false
//            ])
            ->add('author',null,[
                'required' => true
            ])
//            ->add('user',null,[
//                'required' => false
//            ])
            ->add('file')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Idea'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_idea';
    }
}
