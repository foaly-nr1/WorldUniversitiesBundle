<?php

namespace FL\WorldUniversitiesBundle\Form\Type;

use FL\WorldUniversitiesBundle\Service\WorldUniversitiesService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorldUniversitiesType extends AbstractType
{
    /**
     * @var WorldUniversitiesService
     */
    private $worldUniversitiesService;

    public function __construct(WorldUniversitiesService $worldUniversitiesService)
    {
        $this->worldUniversitiesService = $worldUniversitiesService;
    }

    public function getParent()
    {
        return ChoiceType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $choices = [];
        foreach ($this->worldUniversitiesService->getReader() as $row) {
            if (!array_key_exists($row[0], $choices)) {
                $choices[$row[0]] = [];
            }

            $choices[$row[0]][$row[1]] = $row[1];
        }

        $resolver->setDefaults([
            'choices' => $choices,
        ]);
    }
}
