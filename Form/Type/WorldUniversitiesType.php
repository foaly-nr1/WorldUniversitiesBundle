<?php

namespace FL\WorldUniversitiesBundle\Form\Type;

use FL\WorldUniversitiesBundle\Service\WorldUniversitiesService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorldUniversitiesType extends AbstractType
{
    /**
     * @var WorldUniversitiesService
     */
    private $worldUniversitiesService;

    /**
     * @var string
     */
    private $locale;

    public function __construct(
        WorldUniversitiesService $worldUniversitiesService,
        RequestStack $requestStack
    ) {
        $this->worldUniversitiesService = $worldUniversitiesService;
        $this->locale = $requestStack->getCurrentRequest()->getLocale();
    }

    public function getParent()
    {
        return ChoiceType::class;
    }

    private function getCountryName(string $countryCode)
    {
        return \Locale::getDisplayRegion('-'.$countryCode, $this->locale);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $choices = [];
        foreach ($this->worldUniversitiesService->getReader() as $row) {
            $countryName = $this->getCountryName($row[0]);

            if (!array_key_exists($countryName, $choices)) {
                $choices[$countryName] = [];
            }

            $choices[$countryName][$row[1]] = $row[1];
        }

        $resolver->setDefaults([
            'choices' => $choices,
        ]);
    }
}
