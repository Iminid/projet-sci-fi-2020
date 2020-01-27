<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;

class AppType extends AbstractType{
     /**
     * La config d'un champ !
     *
     * @param string $label
     * @param array $options
     * @param string $placeholder
     * @return array
     */
    protected function getConfig($label, $placeholder, $options = [])
    {
        return array_merge_recursive([
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ], $options);
    }
}