<?php

namespace App\Form;

use App\Entity\CSVFile;
use App\Service\FileUploader;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Class CSVFileType
 * @package App\Form
 */
class CSVFileType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $pattern = '/^(' . $options['data'][1] . ')\.csv$/';
        $builder
            // ...
            ->add('csvFile', FileType::class, [

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // The file need to be uploaded
                'required' => true,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes

                'constraints' => [

                    new Callback(function ($object, ExecutionContextInterface $context) use ($pattern) {
                        if (!preg_match($pattern, $object->getClientOriginalName())) {
                            $context->buildViolation('Changer le nom du fichier')
                                ->addViolation();
                        }
                    }),
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'text/csv',
                            'text/plain'
                        ],
                        'mimeTypesMessage' => 'Le fichier doit être un .csv',
                    ])
                ],

            ])
            ->add('Envoyer', SubmitType::class, ['label' => 'Envoyer']);
    }
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
